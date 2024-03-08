<?php

namespace App\Livewire\Movements;

use App\Models\Movement;
use App\Models\Product;
use App\Models\Warehouse;
use Closure;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Get;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class MovementsList extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Movement::query())
            ->columns([
                TextColumn::make('product')
                    ->label(__('Product'))
                    ->sortable()
                    ->searchable()
                    ->state(fn (Movement $movement): string => "{$movement->product->name}"),
                TextColumn::make('type')
                    ->label(__('Type'))
                    ->formatStateUsing(fn (Movement $movement) => Str::replace('-', ' ',  $movement->type))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('warehouse.name')
                    ->label(__('Warehouse'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('quantity')
                    ->label(__('Quantity'))
                    ->numeric(decimalPlaces: 2),
                TextColumn::make('lot_code')
                    ->label(__('Lot Code'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->state(fn (Movement $record): string => $record->created_at->toDateString())
                    ->label(__('Creation date'))
                    ->sortable()

            ])
            ->filters([
                SelectFilter::make('product_id')
                    ->label(__('Product'))
                    ->relationship('product', 'name'),
                SelectFilter::make('type')
                    ->label(__('Type'))
                    ->options([
                        'input' => __('Input'),
                        'output' => __('Output'),
                        'initial-stock' => __('Initial stock')
                    ]),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->label(__('From')),
                        DatePicker::make('created_until')
                            ->label(__('To')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->headerActions([
                CreateAction::make()
                    ->model(Movement::class)
                    ->form($this->inputsForm())
                    ->modalAlignment(Alignment::Start)
                    ->modalWidth(MaxWidth::ThreeExtraLarge)
                    ->successNotificationTitle(__('Movement saved successfully.'))
                    ->icon('heroicon-m-plus')
                    ->color('primary')
                    ->label(__('New Movement'))
                    ->after(function (CreateAction $action, Movement $movement) {
                        $product = $movement->product;
                        $currentStock = 0;
                        $warehouse = $product->warehouses()->where('warehouse_id', $movement->warehouse_id)->first();

                        if (!empty($warehouse)) {
                            $currentStock = $warehouse->pivot->stock;

                            if ($movement->type === 'input') {
                            
                                $product->warehouses()->updateExistingPivot($movement->warehouse_id, [
                                    'stock' => $currentStock + $movement->quantity
                                ]);
                            }
    
                            if ($movement->type === 'output') {
                                $product->warehouses()->updateExistingPivot($movement->warehouse_id, [
                                    'stock' => $currentStock - $movement->quantity
                                ]);
                            }
                        } else{
                            $product->warehouses()->attach($movement->warehouse_id, ['stock' => $movement->quantity]);
                        }
                        
                    })
            ]);
    }


    public function inputsForm(): array
    {
        return [
            Grid::make(2)
                ->schema([
                    Select::make('product_id')
                        ->label(__('Product'))
                        ->relationship('product', 'name')
                        ->required()
                        ->grow()
                        ->live(),
                    Select::make('warehouse_id')
                        ->label(__('Warehouse'))
                        ->relationship('warehouse', 'name')
                        ->required()
                        ->grow(),
                    Select::make('type')
                        ->label(__('Type'))
                        ->options([
                            'input' => __('Input'),
                            'output' => __('Output'),
                        ])
                        ->required(),
                    TextInput::make('quantity')
                        ->label(__('Quantity'))
                        ->numeric()
                        ->minValue(1)
                        ->required()
                        ->rules([
                            fn (Get $get): Closure => function (string $attribute, float $value, Closure $fail) use ($get) {

                                if ($get('type') === 'output') {
                                    $warehouse = Warehouse::find($get('warehouse_id'));
                                    $product = Product::find($get('product_id'));

                                    if ($product->warehouses->contains($warehouse->id)) {
                                        // Gets the current stock of the product in the warehouse
                                        $currentStock = $product->warehouses()->where('warehouse_id', $warehouse->id)->first()->pivot->stock;

                                        // Check if the movement quantity is less than or equal to the current stock
                                        if ($value > floatval($currentStock)) {
                                            $fail(__("The movement quantity is greater than the stock available in the warehouse."));
                                        }
                                    } else {
                                        $fail(__("The product is not associated with the specified warehouse."));
                                    }
                                }
                            },
                        ]),
                    TextInput::make('lot_code')
                        ->label(__('Lot Code')),


                ])
        ];
    }

    public function render(): View
    {
        return view('livewire.movements.movements-list');
    }
}
