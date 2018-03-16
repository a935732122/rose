<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Cate_image extends Model
{
	// 自动添加时间戳
    protected function getDateFormat(){  
    	return time();  
	} 
    // 设置表名
	protected $table = 'cate_image';
    protected $fillable = ['image','status','cate_id','show'];
    // 查询商品
     /*
    *图片类型
     */
    public function getShowAttribute($value)
    {
        $show = ['1'=>"<span >缩略图</span>",'2'=>"<span >大图</span>"];
        return $show[$value];
    }
     public function getStatusAttribute($value)
    {
        $status = ['1'=>"<span class='label label-success radius'>已启用</span>",'2'=>"<span class='label label-defaunt radius'>已禁用</span>"];
        return $status[$value];
    }
}
