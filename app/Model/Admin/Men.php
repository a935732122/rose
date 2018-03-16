<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Men extends Model
{	
	// 自动添加时间戳
    protected function getDateFormat(){  
    	return time();  
	}  
	// 设置表名
	protected $table = 'men';
    protected $fillable = ['link','updated_at','created_at','text','order'];
    /*
    *是否上架
     */
    
	/*
    *查询
     */
    // public function getShow(){
    // 	$list = $this->all();
    // 	return $list;
    // }
    //  public function setImageAttribute($value)
    // {
    //     $this->attributes['image'] = ucfirst($value);
    // }
}