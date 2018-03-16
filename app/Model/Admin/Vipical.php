<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use DB;
class Vipical extends Model
{	
	// 自动添加时间戳
    protected function getDateFormat(){  
    	return time();  
	}  
	// 设置表名
	protected $table = 'vipical';
    protected $fillable = ['vid','name','created_at','updated_at','status','address','da','phone','email','s_province','s_city','s_county'];
         public function getStatusAttribute($value)
    {
        $status = ['1'=>"<span class='label label-success radius'>已启用</span>",'2'=>"<span class='label label-defaunt radius'>已禁用</span>"];
        return $status[$value];
    }
       public function getSexAttribute($value)
    {
        $status = ['1'=>"男",'2'=>"女"];
        return $status[$value];
    }
      public function getVidAttribute($value)
    {
       
      $vid = DB::table('vip')->where('id',$value)->select('name')->get();
      // print_r($pid);
        return $vid[0]['name'];
    }
      public function getPidAttribute($value)
    {
       
      $pid = DB::table('provice')->where('id',$value)->select('name')->get();
      // print_r($pid);
        return $pid[0]['name'];
    }
 }