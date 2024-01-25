<?php

namespace App\Models;

use App\Traits\Histories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory, Histories;

    protected $fillable = ['title', 'price', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productitems()
    {
        return $this->hasMany(ProductItem::class, 'variation_id');
    }
}
