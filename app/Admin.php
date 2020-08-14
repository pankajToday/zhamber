<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification as Notification;

use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable;

     /**
     * The attributes added for admin role adn permission .
     *
     * @var array
     */
    use HasRoles;
    protected $guard_name = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile',
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
     * Custom password reset notification.
     */
    public function sendPasswordResetNotification($token){
        $this->notify(new Notification($token));
    }
}
