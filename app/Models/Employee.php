<?php

namespace App\Models;

use App\Traits\hasMeta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory, hasMeta;

    private $reservedKeys = ['id', 'full_name', 'employee_code', 'email', 'phone', 'designation', 'department', 'created_at', 'updated_at'];

    protected $casts = ['meta' => 'array'];

    public function productitems()
    {
        return $this->hasMany(ProductItem::class, 'employee_id');
    }
}
