<?php

namespace App\Livewire\Transfer;

use App\Models\Warehouse;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class CreateTransfer extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public  $transfer;


    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        Select::make('origin_warehouse_id')
                            ->options(fn () => Warehouse::pluck('name', 'id'))
                            ->required()
                            ->label(__('Origin Warehouse')),
                        Select::make('destination_warehouse_id')
                            ->options(fn () => Warehouse::pluck('name', 'id'))
                            ->required()
                            ->label(__('Destination Warehouse')),

                    ]),
                Grid::make(2.5)
                    ->schema([
                        Textarea::make('reason')
                        ->label(__('Reason'))
                            ->rows(2)
                            ->cols(50)

                    ]),


            ])
            ->statePath('data')
            ->model();
    }


    public function create(): void
    {
        dd($this->form->getState());
    }

    public function render()
    {
        return view('livewire.transfer.create-transfer');
    }
}
