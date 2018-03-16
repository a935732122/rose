<?php

namespace App\Model\admin;

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
     public function getStatusAttribute($value)
    {
        $status = ['1'=>"<span class='label label-success radius'>未购买</span>",'2'=>"<span class='label label-defaunt radius'>已购买</span>"];
        return $status[$value];
    }
      public function getVidAttribute($value)
    {
       
      $vid = DB::table('vip')->where('id',$value)->select('name')->get();
      // print_r($pid);
        return $vid[0]['name'];
    }
     
   
}
