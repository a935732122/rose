<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class Pdo_attr extends Model
{
    // 自动添加时间戳
    protected function getDateFormat(){  
    	return time();  
	}  
	// 设置表名
	protected $table = 'pdo_attr';
	// 白名单
    protected $fillable = ['attr','type_id','updated_at','created_at'];
    // 查询商品类型
    public function pdo_type()
    {
        return $this->belongsTo('App\Model\Admin\Pdo_type','type_id','id');
    }
}
