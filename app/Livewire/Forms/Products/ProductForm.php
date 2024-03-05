<?php

namespace App\Livewire\Forms\Products;

use App\Models\Brand;
use App\Models\Catalog\MeasurementUnit;
use App\Models\Catalog\Currency;
use App\Models\Category;
use App\Models\Product;
use App\Models\Warehouse;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Livewire\Form;

class ProductForm extends Form
{
    /**
     * Returns the product form schema
     *
     * @return array $schema
     */

    public static function schema(): array
    {
        return [
            Grid::make(2)
                ->schema([
                    TextInput::make('code')
                        ->label(__('Code'))
                        ->unique(table: Product::class, column: 'code', ignoreRecord: true),
                    TextInput::make('name')
                        ->label(__('Name'))
                        ->required(),
                    TextInput::make('description')
                        ->label(__('Description')),
                    Select::make('measurement_unit_id')
                        ->label(__('Measurement Unit'))
                        ->options(MeasurementUnit::pluck('name', 'id')),
                    Select::make('currency_id')
                        ->label(__('Currency'))
                        ->options(fn () => Currency::pluck('name', 'id')),
                    TextInput::make('unit_price')
                        ->label(__('Price'))
                        ->numeric(),
                    TextInput::make('initial_stock')
                        ->label(__('Initial Stock'))
                        ->numeric()
                        ->visible(fn (Product $product): bool => empty($product->id)),
                    Select::make('category_id')
                        ->label(__('Category'))
                        ->options(fn () => Category::pluck('name', 'id')),
                    Select::make('brand_id')
                        ->label(__('Brand'))
                        ->options(fn () => Brand::pluck('name', 'id')),
                    Select::make('warehouse_id')
                        ->label(__('Warehouse'))
                        ->options(fn () => Warehouse::pluck('name', 'id')),
                    DatePicker::make('date_expiration')
                        ->label(__('Date Expiration')),
                ])
        ];
    }
}
