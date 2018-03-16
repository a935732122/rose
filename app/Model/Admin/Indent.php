<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use DB;
class Indent extends Model
{

	protected function getDateFormat(){  
    	return time();  
	}  
	// 设置表名
	protected $table = 'indent';
    protected $fillable = ['vid','pdoid','num','created_at','updated_at','status','much','stat'];
     public function getStatusAttribute($value)
    {
        $status = ['1'=>"<span class='label label-success radius'>已发货</span>",'2'=>"<span class='label label-defaunt radius'>未发货</span>",'3'=>"<span class='label label-success radius'>已收货</span>"];
        return $status[$value];
    } public function getStatAttribute($value)
    {
        $status = ['1'=>"<span class='label label-success radius'>已付款</span>",'2'=>"<span class='label label-defaunt radius'>未付款</span>"];
        return $status[$value];
    }
      public function getVidAttribute($value)
    {
       
      $vid = DB::table('vip')->where('id',$value)->select('name')->get();
      // print_r($pid);
        return $vid[0]['name'];
    }
      public function getPdoidAttribute($value)
    {
       
      $pdoid = DB::table('pdo')->where('id',$value)->first();
      // print_r($pid);
        return $pdoid['name'];
    }
   
}