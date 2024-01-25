<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\hasMeta;
use App\Traits\Histories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, hasMeta, Histories;

    private $reservedKeys = ['id', 'name', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at', 'is_disabled', 'department_id', 'created_by', 'updated_by'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'meta' => 'array'
    ];

    public function getIsAdminAttribute()
    {

        return $this->hasRole('Super Admin');
    }

    public function getSortedNameAttribute()
    {
        return strtoupper($this->name);
    }

    public function setSortNameAttribute($name)
    {
        $this->attributes['name'] = $name;
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function histories()
    {
        return $this->hasMany(History::class, 'user_id');
    }
}
