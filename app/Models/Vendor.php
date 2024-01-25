<?php

namespace App\Models;

use App\Traits\hasMeta;
use App\Traits\Histories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory, hasMeta, SoftDeletes, Histories;

    private $reservedKeys = ['id', 'title', 'address', 'department_id', 'created_at', 'updated_at', 'created_by', 'updated_by'];

    protected $fillable = ['title', 'address', 'department_id'];

    protected $casts = ['meta' => 'array'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'vendor_id');
    }
}
