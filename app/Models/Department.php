<?php

namespace App\Models;

use App\Traits\hasMeta;
use App\Traits\Histories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, hasMeta, SoftDeletes, Histories;

    private $reservedKeys = ['id', 'title', 'created_at', 'updated_at', 'created_by', 'updated_by'];

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class, 'department_id');
    }

    public function brands()
    {
        return $this->hasMany(Brand::class, 'department_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'department_id');
    }

    public function vendors()
    {
        return $this->hasMany(Vendor::class, 'department_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'department_id');
    }

    public function productitems()
    {
        return $this->hasMany(ProductItem::class, 'department_id');
    }
}
