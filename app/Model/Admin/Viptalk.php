<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use DB;
class Viptalk extends Model
{	
	// 自动添加时间戳
    protected function getDateFormat(){  
    	return time();  
	}  
	// 设置表名
	protected $table = 'viptalk';
    protected $fillable = ['vid','text','pdoid','created_at','updated_at','status'];
    
    public function getStatusAttribute($value)
    {
        $status = ['1'=>"<span class='label label-success radius'>已启用</span>",'2'=>"<span class='label label-defaunt radius'>已禁用</span>"];
        return $status[$value];
    }
     public function getVidAttribute($value)
    {
         $vid = DB::table('vip')->where('id',$value)->select('name')->get();
          return $vid[0]['name'];
    }
    public function getPdoidAttribute($value)
    {
       
      $pid = DB::table('pdo')->where('id',$value)->select('name')->get();
      // print_r($pid);
        return $pid[0]['name'];
    }
     public function hui(){
       return $this->belongsTo('App\Model\Admin\hui','id','talk_id');
    }

 }