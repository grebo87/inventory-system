<?php

namespace App\Livewire\Customers;

use App\Livewire\Forms\Customers\CustomerForm;
use App\Models\Customer;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

// filament table
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Support\HtmlString;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;

class CustomersList extends Component implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;


    public function table(Table $table): Table
    {
        return $table
            // ->selectable()
            ->query(Customer::query())
            ->columns([
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('cedula')
                    ->label(__('Cedula'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->icon('heroicon-m-phone')
                    ->label(__('Phone'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    ->label(__('Email'))
                    ->searchable()
                    ->sortable(),
                ToggleColumn::make('status')
                    ->label(__('Active'))
                    ->searchable()
                    ->sortable()
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make()
                        ->form(CustomerForm::schema())
                        ->modalAlignment(Alignment::Start)
                        ->modalWidth(MaxWidth::ThreeExtraLarge),
                    EditAction::make()
                        ->form(CustomerForm::schema())
                        ->modalAlignment(Alignment::Start)
                        ->modalWidth(MaxWidth::ThreeExtraLarge),
                    DeleteAction::make(),
                ])
            ])
            ->searchPlaceholder(__('Search'))
            ->filters([
                Filter::make('name')->label(__('Name')),
                // Filter::make('status')->toggle(),
                Filter::make('cedula')->label(__('Cedula')),

            ])
            ->headerActions([
                CreateAction::make()
                    ->model(Customer::class)
                    ->form(CustomerForm::schema())
                    ->modalAlignment(Alignment::Start)
                    ->modalWidth(MaxWidth::ThreeExtraLarge)
                    ->successNotificationTitle(__('Customer saved successfully.'))
                    ->icon('heroicon-m-plus')
                    ->color('primary')
                    ->label(__('New customer'))
            ]);
    }


    public function render(): View
    {
        return view('livewire.customers.customers-list');
    }
}
