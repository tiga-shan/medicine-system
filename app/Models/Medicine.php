<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'generic_name',
        'category',
        'description',
        'price',
        'stock_quantity',
        'reorder_level',
        'expiry_date',
        'requires_prescription',
        'image',
        'supplier_id',
    ];

    protected function casts(): array
    {
        return [
            'expiry_date' => 'date',
            'requires_prescription' => 'boolean',
        ];
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}