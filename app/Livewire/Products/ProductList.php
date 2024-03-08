<?php

namespace App\Livewire\Products;

use App\Livewire\Forms\Products\ProductForm;
use App\Models\Brand;
use App\Models\Catalog\Currency;
use App\Models\Category;
use App\Models\Product;
use App\Models\Warehouse;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Livewire\Component;

class ProductList extends Component implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    function table(Table $table): Table
    {
        return $table->query(Product::query())
            ->columns([
                TextColumn::make('code')
                    ->label(__('Code'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('unit_price')
                    ->label(__('Price'))
                    ->formatStateUsing(fn (Product $product): string => "{$product->currency->symbol} {$product->unit_price}")
                    ->sortable()
                    ->searchable(),
                TextColumn::make('measurementUnit.name')
                    ->label(__('Unit'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('stock')
                    ->label(__('Stock'))
                    ->state(fn (Product $product): float => $product->warehouses()->sum('product_warehouse.stock'))
                    ->numeric(decimalPlaces: 2),
            ])
            ->filters([
                SelectFilter::make('currency_id')
                    ->options(Currency::pluck('name', 'id'))
                    ->label(__('Currency')),
                SelectFilter::make('category_id')
                    ->options(Category::pluck('name', 'id'))
                    ->label(__('Category')),
                SelectFilter::make('brand_id')
                    ->options(Brand::pluck('name', 'id'))
                    ->label(__('Brand')),
                SelectFilter::make('warehouse_id')
                    ->options(Warehouse::pluck('name', 'id'))
                    ->label(__('Warehouse')),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make()
                        ->form(ProductForm::schema())
                        ->modalAlignment(Alignment::Start)
                        ->modalWidth(MaxWidth::ThreeExtraLarge),
                    EditAction::make()
                        ->form(ProductForm::schema())
                        ->modalAlignment(Alignment::Start)
                        ->modalWidth(MaxWidth::ThreeExtraLarge)
                        ->successNotificationTitle(__('Product saved successfully.')),
                    DeleteAction::make()
                        ->successNotificationTitle(__('Product delete successfully.')),
                ])
            ])
            ->headerActions([
                CreateAction::make()
                    ->model(Product::class)
                    ->form(ProductForm::schema())
                    ->modalAlignment(Alignment::Start)
                    ->modalWidth(MaxWidth::ThreeExtraLarge)
                    ->successNotificationTitle(__('Product saved successfully.'))
                    ->icon('heroicon-m-plus')
                    ->color('primary')
                    ->label(__('New Product'))
                    ->after(function (CreateAction $action, Product $product) {
                        $warehouse = Warehouse::find($product->warehouse_id);
                        
                        $product->movements()->create([
                            'warehouse_id' => $warehouse->id,
                            'type' => 'initial-stock',
                            'quantity' => $product->initial_stock,
                        ]);

                        $product->warehouses()->attach($warehouse->id, ['stock' => $product->initial_stock]);
                    })
            ])
            ->emptyStateHeading(__('No Products'))
            ->emptyStateDescription(__('Create a products to get started.'))
            ->searchPlaceholder(__('Search'));
    }

    public function render()
    {
        return view('livewire.products.product-list');
    }
}
