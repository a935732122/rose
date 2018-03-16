<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
     use EntrustUserTrait { 
        EntrustUserTrait::can as may;
        Authorizable::can insteadof EntrustUserTrait;
        }

    
     
    protected $table = 'users';

    /**
     * 白名单
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password','status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    /**
    *是否启用
     */
    public function getStatusAttribute($value)
    {
        $status = ['1'=>"<span class='label label-success radius'>已启用</span>",'2'=>"<span class='label label-defaunt radius'>已禁用</span>"];
        return $status[$value];
    }
}
