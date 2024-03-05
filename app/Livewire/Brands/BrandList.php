<?php

namespace App\Livewire\Brands;

use App\Models\Brand;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\ActionSize;
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
use Livewire\Component;

class BrandList extends Component implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    function table(Table $table): Table
    {
        return $table->query(Brand::query())
            ->columns([
                TextColumn::make('index')
                    ->rowIndex()
                    ->label(__('#')),
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->formatStateUsing(fn (Brand $record): string => $record->created_at->toDateString())
                    ->label(__('Creation date'))
                    ->sortable()
            ])
            ->filters([
                Filter::make('name')
                    ->label(__('Name'))
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make()
                        ->form([
                            TextInput::make('name')
                                ->label(__('Name'))
                                ->required()
                                ->unique(table: Brand::class, column: 'name', ignoreRecord: true),
                        ])
                        ->modalAlignment(Alignment::Start)
                        ->modalWidth(MaxWidth::ThreeExtraLarge)
                        ->successNotificationTitle(__('Brand saved successfully.')),
                    DeleteAction::make()
                        ->successNotificationTitle(__('Brand delete successfully.')),
                ])->size(ActionSize::ExtraSmall)
            ])
            ->headerActions([
                CreateAction::make()
                    ->model(Brand::class)
                    ->form([
                        TextInput::make('name')
                            ->label(__('Name'))
                            ->required()
                            ->unique(table: Brand::class, column: 'name', ignoreRecord: true)
                    ])
                    ->modalAlignment(Alignment::Start)
                    ->modalWidth(MaxWidth::ThreeExtraLarge)
                    ->successNotificationTitle(__('Brand saved successfully.'))
                    ->icon('heroicon-m-plus')
                    ->color('primary')
                    ->label(__('New Brand'))
            ])
            ->emptyStateHeading(__('No Brands'))
            ->emptyStateDescription(__('Create a brands to get started.'))
            ->searchPlaceholder(__('Search'));
    }

    public function render()
    {
        return view('livewire.brands.brand-list');
    }
}
