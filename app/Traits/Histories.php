<?php

namespace App\Traits;


use App\Models\History;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait Histories
{

    public static function boot()
    {

        parent::boot();

        static::creating(function ($model) {

            if(get_class($model) == "App\Models\Product")
            {
                $model->uuid = Str::uuid();
            }
            $model->created_by = Auth::id();

        });

        static::created(function ($model) {
            createHistory($model, 'created');
        });


        static::updating(function ($model) {

            $model->updated_by = Auth::id();

        });

        static::updated(function ($model) {
            createHistory($model, 'updated');
        });

        static::deleting(function ($model) {
            createHistory($model, 'deleted');
        });

    }

    public function histories()
    {
        return $this->morphMany(History::class, 'model');
    }


}
