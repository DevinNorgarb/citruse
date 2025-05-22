<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
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
        'payment_terms',
        'currency',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
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
}
