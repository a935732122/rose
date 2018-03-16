<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Pdo_image extends Model
{
	// 自动添加时间戳
    protected function getDateFormat(){  
    	return time();  
	} 
    // 设置表名
	protected $table = 'pdo_image';
    protected $fillable = ['image','status','pdo_id','updated_at','created_at','title'];
    // 查询商品
    public function pdo()
    {
        return $this->belongsTo('App\Model\Admin\Pdo','pdo_id','id');
    }
     /*
    *图片类型
     */
    public function getStatusAttribute($value)
    {
        $status = ['1'=>"<span >缩略图</span>",'2'=>"<span >大图</span>"];
        return $status[$value];
    }
}
