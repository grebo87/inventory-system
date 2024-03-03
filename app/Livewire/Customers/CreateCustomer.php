<?php

namespace App\Livewire\Customers;

use App\Livewire\Forms\Customers\CustomerForm;
use App\Models\Customer;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateCustomer extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('Name'))
                    ->required(),
                TextInput::make('cedula')
                    ->numeric()
                    ->label(__('Cedula'))
                    ->required()
                    ->maxLength(10)
                    ->unique(table: Customer::class, column: 'cedula'),
                TextInput::make('phone')
                    ->label(__('Phone'))
                    ->tel(),
                TextInput::make('email')
                    ->label(__('Email'))
                    ->email(),
                TextInput::make('address')
                    ->label(__('Address')),
                ToggleButtons::make('status')
                    ->label(__('Active'))
                    ->boolean()
                    ->default(true)
                    ->grouped(),
            ])
            ->statePath('data')
            ->columns(2);
    }


    public function create()
    {
        $this->validate();

        Customer::create($this->form->getState());

        $this->reset();

        Notification::make()
            ->title(__('Customer saved successfully.'))
            ->success()
            ->send();
        return redirect('/customers');
    }

    public function render(): View
    {
        return view('livewire.customers.create-customer');
    }
}
