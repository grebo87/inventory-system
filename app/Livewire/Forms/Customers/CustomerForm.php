<?php

namespace App\Livewire\Forms\Customers;

use App\Models\Customer;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;

final class CustomerForm
{
    /**
     * Returns the customer form schema
     *
     * @return array $schema
     */

    public static function schema(): array
    {
        return [
            Grid::make(2)
                ->schema([
                    Select::make('document_type')
                        ->label(__('Document Type'))
                        ->options([
                            'cedula' => __('Cedula'),
                            'passport' => __('Passport'),
                            'rif' => __('RIF'),
                        ])
                        ->required(),
                    TextInput::make('document_number')
                        ->numeric()
                        ->label(__('Document Number'))
                        ->required()
                        ->maxLength(10)
                        ->unique(table: Customer::class, column: 'document_number', ignoreRecord: true),
                    TextInput::make('name')
                        ->label(__('Name'))
                        ->required(),
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
        ];
    }
}
