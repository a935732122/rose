<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Model\home\Dian as d;
use App\Http\Requests;
use App\Model\admin\Provice as p; 
use App\Model\admin\Banner1 as b;
use App\Http\Controllers\Controller;

class DianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        // 轮播图
         $nav1 = b::orderby('updated_at','desc')->where('status',1)->get();
        $data = p::where('pid',0)->get();
        $list = d::get();
        return view("home/dian/index",['nav1'=>$nav1,'data'=>$data,'list'=>$list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCity()
    {
         $list = p::where('pid',$_GET['id'])->get();
         foreach ($list as $k=>$v) {
             $ii[$k]['name'] = $v['name'];
             $ii[$k]['id'] = $v['id'];
         }
         // dd($ii);
         return $ii;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getDian()
    {
        $list = d::where('pro_id',$_GET['id'])->get();
        foreach ($list as $k=>$v) {
             $ii[$k]['name'] = $v['name'];
             $ii[$k]['tel'] = $v['tel'];
             $ii[$k]['adress'] = $v['adress'];
             $ii[$k]['time'] = $v['time'];
         }
         // dd($ii);
        return $ii;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
