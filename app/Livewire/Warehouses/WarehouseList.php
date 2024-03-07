<?php

namespace App\Livewire\Warehouses;

use App\Models\Warehouse;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\View\View;
use Livewire\Component;

class WarehouseList extends Component implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;


    public function table(Table $table): Table
    {
        return $table->query(Warehouse::query())
            ->columns([
                TextColumn::make('code')
                    ->sortable()
                    ->searchable()
                    ->label(__('Code')),
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label(__('Name')),
                TextColumn::make('description')
                    ->sortable()
                    ->searchable()
                    ->label(__('Description')),
                TextColumn::make('address')
                    ->sortable()
                    ->searchable()
                    ->label(__('Address'))
            ])
            ->filters([
                Filter::make('code')
                    ->label(__('Code')),
                Filter::make('name')
                    ->label(__('Name'))
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make()
                        ->form($this->inputsForm())
                        ->modalAlignment(Alignment::Start)
                        ->modalWidth(MaxWidth::ThreeExtraLarge)
                        ->successNotificationTitle(__('Warehouse saved successfully.')),
                    DeleteAction::make()
                        ->successNotificationTitle(__('Warehouse delete successfully.'))
                ])
            ])
            ->headerActions([
                CreateAction::make()
                ->model(Warehouse::class)
                    ->form($this->inputsForm())
                    ->modalAlignment(Alignment::Start)
                    ->modalWidth(MaxWidth::ThreeExtraLarge)
                    ->successNotificationTitle(__('Warehouse saved successfully.'))
                    ->icon('heroicon-m-plus')
                    ->color('primary')
                    ->label(__('New Warehouse'))
            ])
            ->emptyStateHeading(__('No Warehouses'))
            ->emptyStateDescription(__('Create a warehouses to get started.'))
            ->searchPlaceholder(__('Search'));
    }

    public function render(): View
    {
        return view('livewire.warehouses.warehouse-list');
    }


    public function inputsForm(): array
    {
        return [
            Grid::make(2)
                ->schema([
                    TextInput::make('code')
                        ->label(__('Code'))
                        ->default(function (Warehouse $warehouse) {
                            $lastWarehouse = $warehouse->orderBy('id', 'desc')->first();
                            return empty($lastWarehouse) ? '001' : str_pad($lastWarehouse->id + 1, 3, "0", STR_PAD_LEFT);
                        })
                        ->grow(),
                    TextInput::make('name')
                        ->required()
                        ->unique(table: Warehouse::class, column: 'name', ignoreRecord: true)
                        ->label(__('Name')),
                    TextInput::make('description')
                        ->label(__('Description')),
                    TextInput::make('address')
                        ->label(__('Address')),
                ])
        ];
    }
}
