<?php

namespace App\Models;

use App\Events\UserCreated;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

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

    protected $dispatchesEvents = [
        'created' => UserCreated::class,
    ];

    const ADMINISTRATOR_TYPE = 0;
    const USER_TYPE = 1;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function isAdministrator(): Attribute
    {
        return Attribute::make(
            get: fn (null $value,array $attributes) => $attributes['role'] === self::ADMINISTRATOR_TYPE,
        );
    }

    public function wallet(){
        return $this->hasOne(Wallet::class);
    }
}
