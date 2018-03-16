<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\home\Cart as b;
use App\Model\admin\pdo_attr as a;
use App\Model\admin\Pdo as p;
use App\Model\admin\Indent as c;
use App\Model\admin\Indent_pdo as s;
use App\Model\admin\Category as d;
use App\Model\admin\Vipical as v;




use DB;
class ShopController extends Controller
{
	public function getIndex(){
		// dd(session()->get("name"));
		if (!session()->get("name")) {
			return redirect('/home/login/index')->with('message','请登录');
		}
		$m = new b;
		$arr= DB::table('vip')->where('name',session()->get('name'))->first();
		$list = $m->orderby('id','desc')->where(['status'=>1,'vid'=>$arr['id']])->get();
		$num = $m->orderby('id','desc')->where(['status'=>1,'vid'=>$arr['id']])->count();
		// dd($listm);
		// dd($list);
		if ($num == 0) {
			
				return view('home/shop/index',['list'=>$list]);
				
		}else{
			foreach($list as $v){
					$listm[] = p::where('id',$v['pdoid'])->get();
				}	
				// dd($listm);	
				return view('home/shop/index',['list'=>$listm,'lists'=>$list]);
		}
		
	}
	public function getJia()
	{
		$input = $_GET['nu'];
		$flight = b::find($_GET['aa']);

		$flight->num = $input;

		$flight->save();
	
      }
	  public function getDel($id)
	{
	
		$flight = b::find($id);
		$flight->delete();
		return redirect('home/shop/index');
	
      }	  
      public function getAdd()
	{
		$arr = DB::table('vip')->where('name',session()->get("name"))->first();
		
		$data = $_GET;
		$data['vid']=$arr['id'];
		
		c::create($data);
		$list = DB::table('indent')->where(['much'=>$data['much'],'num'=>$data['num'],'vid'=>$data['vid'],'status'=>2,'stat'=>2])->get();
		if($list){
				$da= [];
					$da['did'] = $list[0]['id'];
					// foreach ($_GET['bnum'] as $v) {
					// 	$da[$k]['pnum']=$v;
					// }
						$bnum = $_GET['bnum'];
					foreach($_GET['abc'] as $k=>$v){
						$da['pid'] = $v;
						$da['pnum'] =$bnum[$k];
						
						s::create($da);
						DB::table('cart')->where(['vid'=>$arr['id'],'pdoid'=>$v])->delete();
						
					}

					
					return $list[0]['id'];
		}

	}
	public function getMuch($id)
	{
		// $pp = DB::table('indent_pdo')->where('did',$list[0]['id'])->get();
		// 			DB::table('vipical')->where('id',$list[0]['vid'])->get();
		// 			foreach($pp as $va){
		// 				$pl[]= DB::table('pdo')->where('id',$va['pid'])->get();
		// 			}
					 $c = new d();
        $nav2 = $c->orderby('updated_at','desc')->where('pid',0)->get();
        $nav3 = DB::table('Category')->get();
        $nav4 = DB::table('Category')->get();

					$list = DB::table('indent')->where('id',$id)->get();
					
					$bb = DB::table('vipical')->where(['vid'=>$list[0]['vid'],'da'=>1])->first();
					$ss = DB::table('vipical')->where('vid',$list[0]['vid'])->get();
					// echo"<pre>";
					// print_r($listm);
					
					return view('home/shop/much',['list'=>$list,'bb'=>$bb,'nav2'=>$nav2,'nav3'=>$nav3,'nav4'=>$nav4,'ss'=>$ss]);
	}
	public function getFukuan(){

		// $arr = DB::table('indent')->where('id',$_GET['id'])->first();
		if (!$_GET['addrid']) {
			return redirect()->back()->with('message','必须选择一个地址');
		}
		c::where('id', $_GET['id'])
          
          ->update(['stat' => 1,'addid'=>$_GET['addrid']]);
          return redirect('home/shop/index')->with('message','付款成功');
	}
}