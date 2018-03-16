<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use DB;

class Category extends Model
{
    // 自动添加时间戳
    protected function getDateFormat(){  
        return time();  
    } 
    protected $table = 'category';
    protected $primaryKey='id';
    // public $timestamps=false;
    protected $fillable = ['name','pid','status','image','link'];
    //使用递归获取分类 （正式函数）
    public function getCategory($sourceItems, $targetItems, $pid=0){
        foreach ($sourceItems as $k => $v) {
            if($v->pid == $pid){
                $targetItems[] = $v;
                $this->getCategory($sourceItems, $targetItems, $v->id);
            }
        }
    }
 
    //使用递归获取分类信息测试函数 （测试正式函数）
    public function getCategoryTest($sourceItems, $targetItems, $pid=0, $str='ㅣ'){
        $str .= 'ㅡㅡ';
        foreach ($sourceItems as $k => $v) {
            if($v->pid == $pid){
                $v->name = $str.$v->name;
                $targetItems[] = $v;
                $this->getCategoryTest($sourceItems, $targetItems, $v->id, $str);
            }
        }
    }

    public function getStatusAttribute($value)
    {
        $status = ['1'=>"<span class='label label-success radius'>已启用</span>",'2'=>"<span class='label label-defaunt radius'>已禁用</span>"];
        return $status[$value];
    }
    //使用递归获取分类信息 （正式函数）
    public function getCategoryInfo(){
        $sourceItems = $this->get();
        $targetItems = new Collection;
        $this->getCategory($sourceItems, $targetItems, 0);
        return $targetItems;
    }

    //测试函数 （测试正式函数）
    public function getCategoryInfoTest(){
        $sourceItems = $this->get();
        $targetItems = new Collection;
        $this->getCategoryTest($sourceItems, $targetItems);
        return $targetItems;
    }
     public function getPidAttribute($value)
    {
        if ($value==0) {
            return '顶级类别';
        }
      $pid = DB::table('category')->where('id',$value)->select('name')->get();
      // print_r($pid);
        return $pid[0]['name'];
    }

}