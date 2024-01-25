<?php

namespace App\Models;

use App\Traits\hasMeta;
use App\Traits\Histories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductsMaintenanceHistory extends Model
{
    use HasFactory, hasMeta, SoftDeletes, Histories;

    /*
        id
        product_item_id
        title
        description
        amount
        meta
        created_by
        updated_by
        -------------------
        product_item_id - foregin id constrained to product_items table.
        title - type string nullable
        description - type text nullable
        amount - type double defaults to zero
        meta - type json nullable
        timestamps
        created_by  - foregin id constrained to users nullable
        updated_by - foreign id constrained to users nullable

    */

    private $reservedKeys = ['id', 'product_item_id', 'title', 'description', 'amount', 'created_at', 'updated_at', 'created_by', 'updated_by'];

    protected $casts = ['meta' => 'array'];
    
    public function productitem()
    {
        return $this->belongsTo(ProductItem::class, 'product_item_id');
    }   
}
