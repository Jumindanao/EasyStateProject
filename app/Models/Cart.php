<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Cart extends Model
{
    use HasFactory;
    protected $table= 'carts'; 
    protected $fillable=[
        'user_id',
        'productid',
        'productquantity',
    ];
    public function products(){
        return $this->belongsTo(Product::class,'productid','id');
    }
}
