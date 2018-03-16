<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use DB;

class Pdo extends Model
{
    // 自动添加时间戳
    protected function getDateFormat(){  
    	return time();  
	}  
	// 设置表名
	protected $table = 'pdo';
	// 白名单
    protected $fillable = ['name','type_id','price','updated_at','created_at','status',"image","cateid"];

    // 查询商品类型
    public function pdo_type()
    {
        return $this->belongsTo('App\Model\Admin\Pdo_type','type_id','id');
    }
    // 查询商品类型
    public function attr()
    {
        return $this->belongsTo('App\Model\Admin\Pdo_attr','type_id','type_id');
    }

     /*
    *是否上架
     */
    public function getStatusAttribute($value)
    {
        $status = ['1'=>"<span class='label label-success radius'>已上架</span>",'2'=>"<span class='label label-defaunt radius'>已下架</span>"];
        return $status[$value];
    }
     public function pdo_attr()
    {
        return $this->hasMany('App\Model\Admin\Pdo_attr','type_id','type_id');
    }
      public function getCateidAttribute($value)
    {
      $vid = DB::table('category')->where('id',$value)->select('name')->get();
        return $vid[0]['name'];
    }

}
