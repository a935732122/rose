<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\admin\Banner as b;
use App\Model\admin\Category as c;
use App\Model\admin\Cate_image as cm;
use App\Model\admin\Fourpic as f;
use App\Model\admin\pdo as p;

use DB;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {   
        $cc = new C();
        $ccc = $cc->orderby('updated_at','desc')->where('pid',0)->get();
        $xx = $cc->where('pid',0)->get();
      
        $cm = new cm();
        $cms = $cm->orderby('updated_at')->where('show',1)->get();
        $cmss = $cm->orderby('updated_at')->where('show',2)->get();
        // dd($cmss);
        $b = new b();
        $nav1 = $b->orderby('updated_at','desc')->where('status',1)->get();
        $f = new F();
        $ff = $f->orderby('updated_at','desc')->limit(4)->where('status',1)->get();
        $p = new p();
        $pp = $p->orderby('updated_at','desc')->where('status',1)->limit(8)->get();
        return view('home/index/index',['nav1'=>$nav1,'ff'=>$ff,'pp'=>$pp,'ccc'=>$ccc,'cms'=>$cms,'cmss'=>$cmss,'xx'=>$xx]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
