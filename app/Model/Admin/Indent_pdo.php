<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use DB;
class Indent_pdo extends Model
{
	protected function getDateFormat(){  
    	return time();  
	}  
	
	// 设置表名
	protected $table = 'indent_pdo';
    protected $fillable = ['did','pid','created_at','updated_at','pnum'];
    
      
      
   
}