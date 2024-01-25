<?php

namespace App\Models;

use App\Traits\hasMeta;
use App\Traits\Histories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, hasMeta, SoftDeletes, Histories;

    private $reservedKeys = ['id', 'title', 'description', 'price', 'type', 'asset_type', 'uuid', 'brand_id', 'department_id', 'created_at', 'updated_at', 'created_by', 'updated_by'];

    protected $fillable = ['title', 'description', 'price', 'type', 'asset_type', 'brand_id', 'department_id'];

    protected $casts = ['meta' => 'array'];

    public function brand()
    {
        
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function variations()
    {
        return $this->hasMany(Variation::class, 'product_id');
    }

    public function productitems()
    {
        return $this->hasMany(ProductItem::class, 'product_id');
    }
}
