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
        'email' => 'required',
        'password' => 'required',
    );
    
    public function isAdmin(){
        
        return $this->is_admin == 1;
    }

    public function getRoleAttribute(){
    //getIsAdminAtrtibuteにすると、上のisAdmin()の時点で１が管理者と表示されてしまった。
    //それを回避するため、ここではカラム名をそのまま使用するのではなくRoleとし、
        return $this->is_admin == 1 ? "管理者" : " "; 
    //これを表示させたいview(users.bale.php)も{{ $user->role }}とした。
    }
    
    public function attendances(){
        return $this->hasmany('App\Attendance');
    }
    
}
