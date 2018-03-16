<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Fourpic extends Model
{	
	// 自动添加时间戳
    protected function getDateFormat(){  
    	return time();  
	}  
	// 设置表名
	protected $table = 'fourpic';
    protected $fillable = ['title','image','status','updated_at','created_at'];
    /*
    *是否上架
     */
    public function getStatusAttribute($value)
    {
        $status = ['1'=>"<span class='label label-success radius'>已启用</span>",'2'=>"<span class='label label-defaunt radius'>已禁用</span>"];
        return $status[$value];
    }
    
	/*
    *查询
     */
    public function getShow(){
    	$list = $this->all();
    	return $list;
    }
    //  public function setImageAttribute($value)
    // {
    //     $this->attributes['image'] = ucfirst($value);
    // }
}
