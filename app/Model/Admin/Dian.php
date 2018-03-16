<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Dian extends Model
{
    // 自动添加时间戳
    protected function getDateFormat(){  
        return time();  
    } 
    protected $table = 'zmd';
   
    protected $fillable = ['name','adress','time','tel','pro_id'];
    // 查询所属城市
    public function provice()
    {
        return $this->belongsTo('App\Model\Admin\Provice','pro_id','id');
    }
}
