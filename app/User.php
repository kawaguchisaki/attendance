<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    protected $guarded = array('id');
    
    public static $rules = array(
        'name' => 'required',
    );
    
    public function isAdmin(){
        
        return $this->is_admin == 1;
    }
    
    public function getHogeHogeAttribute(){
        return "from hogehoge";
    }

    public function getRoleAttribute(){
        return $this->is_admin == 1 ? "管理者" : " ";
    }
    
}