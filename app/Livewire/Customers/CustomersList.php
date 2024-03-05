<?php

namespace App\Livewire\Customers;

use App\Livewire\Forms\Customers\CustomerForm;
use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Livewire\Component;
// filament
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

class CustomersList extends Component implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Customer::query())
            ->columns([
                TextColumn::make('document_type')
                    ->label(__('Document'))
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn (Customer $record): string => "{$record->document_type}: {$record->document_number}"),
                TextColumn::make('name')
                    ->label(__('Name'))
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
                        ->modalWidth(MaxWidth::ThreeExtraLarge)
                        ->successNotificationTitle(__('Customer saved successfully.')),
                    DeleteAction::make()
                        ->successNotificationTitle(__('Customer delete successfully.')),
                ])
            ])
            ->filters([
                // Filter::make('name')->label(__('Name')),
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
            ])
            ->emptyStateHeading(__('No customers'))
            ->emptyStateDescription(__('Create a customer to get started.'))
            ->searchPlaceholder(__('Search'));
    }

    public function render(): View
    {
        return view('livewire.customers.customers-list');
    }
}
