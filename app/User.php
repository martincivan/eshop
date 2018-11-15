<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    const ROLE_ADMIN = 'A';
    const ROLE_CUSTOMER = 'C';

    public function isAdmin() {
        if ($this->getAttribute('role') == self::ROLE_CUSTOMER) {
            return true;
        }
        return false;
    }

    protected $attributes = [
        'role' => self::ROLE_CUSTOMER
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'street', 'city', 'zip', 'business_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
