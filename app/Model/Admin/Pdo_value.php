<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class Pdo_value extends Model
{
     // 自动添加时间戳
    protected function getDateFormat(){  
    	return time();  
	}  
	// 设置表名
	protected $table = 'pdo_value';
	// 白名单
    protected $fillable = ['value','attr_id','pdo_id','updated_at','created_at'];

}
