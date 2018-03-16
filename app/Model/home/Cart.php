<?php

namespace App\Model\home;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use DB;
class Cart extends Model
{

	protected function getDateFormat(){  
    	return time();  
	}  
	// 设置表名
	protected $table = 'cart';
    protected $fillable = ['vid','pdoid','num','created_at','updated_at','status'];
    
   
}
