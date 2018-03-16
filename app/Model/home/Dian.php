<?php

namespace App\Model\home;

use Illuminate\Database\Eloquent\Model;

class Dian extends Model
{
    // 自动添加时间戳
    protected function getDateFormat(){  
        return time();  
    } 
    protected $table = 'zmd';
   
    protected $fillable = ['name','adress','time','tei','pro_id'];
}
