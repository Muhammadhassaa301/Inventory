<?php

namespace App\Models;

use App\Traits\hasMeta;
use App\Traits\Histories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, hasMeta, SoftDeletes, Histories;

    private $reservedKeys = ['id', 'invoice_no', 'date', 'vendor_id', 'department_id', 'quantity', 'amount', 'created_at', 'updated_at', 'created_by', 'updated_by'];
    //protected $fillable = ['title', 'description', 'price', 'type', 'asset_type', 'brand_id', 'department_id'];

    protected $casts = ['meta' => 'array'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function productitems()
    {
        return $this->hasMany(ProductItem::class, 'invoice_id');
    }
}
