<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Filament\Forms\Components\Grid;
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
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CategoryList extends Component implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;


    public function table(Table $table): Table
    {
        return $table->query(Category::query())
            ->columns([
                TextColumn::make('code')
                    ->label(__('Code'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label(__('Description'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('code')
                    ->label(__('Code')),
                Filter::make('name')
                    ->label(__('Name')),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make()
                        ->form($this->inputsForm())
                        ->modalAlignment(Alignment::Start)
                        ->modalWidth(MaxWidth::ThreeExtraLarge)
                        ->successNotificationTitle(__('Category saved successfully.')),
                    DeleteAction::make()
                        ->successNotificationTitle(__('Category delete successfully.'))
                ])->size(ActionSize::ExtraSmall)
            ])
            ->headerActions([
                CreateAction::make()
                    ->model(Category::class)
                    ->form($this->inputsForm())
                    ->modalAlignment(Alignment::Start)
                    ->modalWidth(MaxWidth::ThreeExtraLarge)
                    ->successNotificationTitle(__('Category saved successfully.'))
                    ->icon('heroicon-m-plus')
                    ->color('primary')
                    ->label(__('New Category'))
            ])
            ->emptyStateHeading(__('No Categories'))
            ->emptyStateDescription(__('Create a categories to get started.'))
            ->searchPlaceholder(__('Search'));
    }


    public function render(): View
    {
        return view('livewire.categories.category-list');
    }

    public function inputsForm(): array
    {
        return [
            Grid::make(2)
                ->schema([
                    TextInput::make('code')
                        ->label(__('Code'))
                        ->default(function (Category $category) {
                            $lastCategory = $category->orderBy('id', 'desc')->first();
                            return empty($lastCategory) ? 'C01' : 'C' . str_pad($lastCategory->id + 1, 2, "0", STR_PAD_LEFT);
                        })
                        ->grow(),
                    TextInput::make('name')
                        ->required()
                        ->unique(table: Category::class, column: 'name', ignoreRecord: true)
                        ->label(__('Name')),
                    TextInput::make('description')
                        ->label(__('Description')),
                ])
        ];
    }
}
