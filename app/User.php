<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\Base\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;
use Backpack\CRUD\CrudTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {
    use CrudTrait;
    use HasRoles;
    use Notifiable;
    
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const STATUS_PENDING = 0;
    const STATUS_ACCEPTED = 1;
    const STATUS_REJECTED = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'surname', 'ocupation', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token) {
        $this->notify(new ResetPasswordNotification($token));
    }
    
    public static function statusArray() {
        return [
            0 => 'Pendiente',
            1 => 'Aceptada',
            2 => 'Rechazada'
        ];
    }
}
