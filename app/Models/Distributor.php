<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Distributor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'business_name',
        'address',
        'country',
        'vat_number',
        'registration_number',
        'sales_contact_name',
        'sales_contact_email',
        'sales_contact_phone',
        'logistics_contact_name',
        'logistics_contact_email',
        'logistics_contact_phone',
        'credit_terms',
        'credit_limit',
        'currency',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'credit_limit' => 'decimal:2',
    ];

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function activePurchaseOrders()
    {
        return $this->purchaseOrders()->where('status', '!=', 'completed');
    }

    public function completedPurchaseOrders()
    {
        return $this->purchaseOrders()->where('status', 'completed');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeHasCredit($query)
    {
        return $query->whereNotNull('credit_limit')
                    ->where('credit_limit', '>', 0);
    }
}
