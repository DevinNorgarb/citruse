<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'description',
        'price_2023',
        'price_2024',
        'price_2025',
    ];

    public function lineItems()
    {
        return $this->hasMany(PurchaseOrderLineItem::class);
    }
}
