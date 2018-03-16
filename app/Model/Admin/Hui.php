<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;
class Hui extends Model
{	
	// 自动添加时间戳
    protected function getDateFormat(){  
    	return time();  
	}  
	// 设置表名
	 protected $table = 'hui';
    protected $fillable = ['hui','talk_id','created_at','updated_at'];
   
 }