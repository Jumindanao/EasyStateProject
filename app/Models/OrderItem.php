<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'productid',
        'productquantity',
        'price',
    ];

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'productid', 'id');
    }
}
