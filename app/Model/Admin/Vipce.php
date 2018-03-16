<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Vipce extends Model
{	
	// 自动添加时间戳
    protected function getDateFormat(){  
    	return time();  
	}  
	// 设置表名
	protected $table = 'vipce';
    protected $fillable = ['pid','nc','brithy','add','sex','ma'];
      public function getStatusAttribute($value)
    {
        $status = ['1'=>"<span class='label label-success radius'>已启用</span>",'2'=>"<span class='label label-defaunt radius'>已禁用</span>"];
        return $status[$value];
    }
    
 }