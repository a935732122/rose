<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class Pdo_type extends Model
{
     // 自动添加时间戳
    protected function getDateFormat(){  
    	return time();  
	}  
	// 设置表名
	protected $table = 'pdo_type';
	// 白名单
    protected $fillable = ['type','updated_at','created_at'];
   
}
