<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'date_of_birth',
        'gender',
        'email',
        'password',
        'mobile_number',
        'emergency_number',
        'nationality',
        'photo', // Storing image file path
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
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date', // Cast 'date_of_birth' as a date
        'password' => 'hashed',
    ];

    /**
     * Define the relationship between the User and Member models.
     * A user can have multiple members.
     *
     * @return HasMany
     */
    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    /**
     * Define the relationship between the User and Guide models.
     * A user can be linked to multiple guides.
     *
     * @return HasMany
     */
    public function guides(): HasMany
    {
        return $this->hasMany(Guide::class);
    }
}
