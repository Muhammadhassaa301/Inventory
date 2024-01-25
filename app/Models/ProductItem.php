<?php

namespace App\Models;

use App\Traits\hasMeta;
use App\Traits\Histories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductItem extends Model
{
    use HasFactory, hasMeta, SoftDeletes, Histories;

    private $reservedKeys = ['id', 'product_code', 'serial_no', 'invoice_id', 'product_id', 'employee_id', 'variation_id', 'department_id', 'price', 'created_at', 'updated_at', 'created_by', 'updated_by'];

    protected $casts = ['meta' => 'array'];
    
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function variation()
    {
        return $this->belongsTo(Variation::class, 'variation_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function products_maintenance_history()
    {
        return $this->hasMany(ProductsMaintenanceHistory::class, 'product_item_id');
    }



}
