<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;


class Admin extends Authenticatable
{
    use Notifiable;
    use LaratrustUserTrait;
    protected $table = 'admins';

    protected $fillable = [
        'name', 'email','photo','password',
    ];
    protected $appends=['image_path'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getImagePathAttribute(){
        return asset('uploads/users/'.$this->photo);
    }

    public function getNameAttribute($value){
        return ucfirst($value);
    }
}
