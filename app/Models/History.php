<?php

namespace App\Models;

use App\Traits\hasMeta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory, hasMeta;

    private $reservedKeys = ['id', 'model_type', 'model_id', 'type', 'user_id', 'created_at', 'updated_at'];

    protected $casts = ['meta' => 'array'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parent()
    {
        return $this->morphTo('model');
    }
}
