<?php

namespace App\Livewire\Transfer;

use App\Models\Product;
use App\Models\Transfer;
use App\Models\Warehouse;
use Closure;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class TransfersList extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Transfer::query())
            ->columns([
                TextColumn::make('product.name')
                    ->label(__('Product')),
                TextColumn::make('originWarehouse.name')
                    ->label(__('Origin Warehouse')),
                TextColumn::make('destinationWarehouse.name')
                    ->label(__('Destination Warehouse')),
                TextColumn::make('quantity')
                    ->label(__('Quantity'))
                    ->numeric($decimalPlaces = 2),
                TextColumn::make('reason')
                    ->label(__('Reason')),
                TextColumn::make('created_at')
                    ->formatStateUsing(fn (Transfer $record): string => $record->created_at->toDateString())
                    ->label(__('Creation date')),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->model(Transfer::class)
                    ->form($this->inputsForm())
                    ->modalAlignment(Alignment::Start)
                    ->modalWidth(MaxWidth::ThreeExtraLarge)
                    ->successNotificationTitle(__('Transfer saved successfully.'))
                    ->icon('heroicon-m-plus')
                    ->color('primary')
                    ->label(__('New Transfer'))
                    ->after(function (CreateAction $action, Transfer $transfer) {
                        $product = $transfer->product;

                        $currentStockOriginWarehouse = $product->warehouses()->where('warehouse_id', $transfer->origin_warehouse_id)->first()->pivot->stock;

                        $product->warehouses()->updateExistingPivot($transfer->origin_warehouse_id, [
                            'stock' => $currentStockOriginWarehouse - $transfer->quantity
                        ]);


                        if ($product->warehouses->contains($transfer->destination_warehouse_id)){
                            $currentStockDestinationWarehouse = $product->warehouses()->where('warehouse_id', $transfer->destination_warehouse_id)->first()->pivot->stock;

                            $product->warehouses()->updateExistingPivot($transfer->destination_warehouse_id, [
                                'stock' => $currentStockDestinationWarehouse + $transfer->quantity
                            ]);
                        } else {
                            $product->warehouses()->attach($transfer->destination_warehouse_id, ['stock' => $transfer->quantity]);
                        }
                    })
            ]);
    }



    public function inputsForm(): array
    {
        return [
            Grid::make(2)
                ->schema([
                    Select::make('origin_warehouse_id')
                        ->options(fn () => Warehouse::pluck('name', 'id'))
                        ->required()
                        ->label(__('Origin Warehouse'))
                        ->live(),
                    Select::make('destination_warehouse_id')
                        ->options(fn (Get $get): Collection => Warehouse::query()
                            ->whereNotIn('id', [$get('origin_warehouse_id')])
                            ->pluck('name', 'id'))
                        ->required()
                        ->label(__('Destination Warehouse'))
                ]),
            Grid::make(3)
                ->schema([
                    Select::make('product_id')
                        ->options(fn (Get $get): Collection => Product::query()
                            ->whereIn('warehouse_id', [$get('origin_warehouse_id')])
                            ->pluck('name', 'id'))
                        ->required()
                        ->label(__('Product'))
                        ->live()
                        ->afterStateUpdated(function (Get $get, Set $set, float $value = 0) {
                            $originWarehouse = Warehouse::find($get('origin_warehouse_id'));
                            $product = Product::find($get('product_id'));

                            if ($product->warehouses->contains($originWarehouse->id)) {
                                // Gets the current stock of the product in the warehouse
                                $value = $product->warehouses()->where('warehouse_id', $originWarehouse->id)->first()->pivot->stock;
                            }

                            $set('current_quantity', number_format($value, 2, ',', '.'));
                        }),
                    TextInput::make('current_quantity')
                        ->readOnly()
                        ->label(__('Current Quantity'))
                        ->minValue(1)
                        ->required(),
                    TextInput::make('quantity')
                        ->required()
                        ->numeric()
                        ->minValue(1)
                        ->label(__('Quantity to Transfer'))
                        ->rules([
                            fn (Get $get): Closure => function (string $attribute, float $value, Closure $fail) use ($get) {
                                $originWarehouse = Warehouse::find($get('origin_warehouse_id'));
                                $product = Product::find($get('product_id'));

                                if ($product->warehouses->contains($originWarehouse->id)) {
                                    // Gets the current stock of the product in the warehouse
                                    $currentStock = $product->warehouses()->where('warehouse_id', $originWarehouse->id)->first()->pivot->stock;

                                    // Check if the transfer quantity is less than or equal to the current stock
                                    if ($value > floatval($currentStock)) {
                                        $fail(__("The transfer quantity is greater than the stock available in the warehouse {$originWarehouse->name}."));
                                    }
                                } else {

                                    Notification::make()
                                        ->title('The product is not associated with the specified warehouse.')
                                        ->danger()
                                        ->send();

                                    $fail('');
                                }
                            },
                        ])
                ]),
            Grid::make(1)
                ->schema([
                    Textarea::make('reason')
                        ->label(__('Reason'))
                        ->rows(2)
                ])

        ];
    }

    public function render(): View
    {
        return view('livewire.transfer.transfers-list');
    }
}
