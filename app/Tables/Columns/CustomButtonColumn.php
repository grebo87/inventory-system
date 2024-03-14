<?php

namespace App\Tables\Columns;

use Filament\Tables\Columns\Column;

class CustomButtonColumn extends Column
{
    protected string $view = 'tables.columns.custom-button-column';

    public function getValue($record)
    {
        return view($this->view, [
            'record' => $record,
        ]);
    }
}
