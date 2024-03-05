<?php

namespace App\Models;

use App\Models\Catalog\Currency;
use App\Models\Catalog\MeasurementUnit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'warehouse_id',
        'name',
        'code',
        'description',
        'measurement_unit_id',
        'currency_id',
        'unit_price',
        'initial_stock',
        'date_expiration'
    ];


    public function currency() : HasOne {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }

    public function measurementUnit() : HasOne {
        return $this->hasOne(MeasurementUnit::class, 'id', 'measurement_unit_id');
    }
}
