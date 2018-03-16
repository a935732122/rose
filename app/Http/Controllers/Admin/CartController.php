<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Model\admin\cart as b;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class CartController extends Controller
{
	/**
     * 判断权限
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        
        // $this->middleware('auth');
        $this->middleware('ability:admin|vip,show_vip',['only'=>['getIndex','getUlist']]);
    }
	public function getIndex(Request $request){
		$data = [];
        $where= [];

        if (!empty($request->only('name'))) {
            $data=$request->only('name');
       
        }
        $m = new b;
    
      	$arr = DB::table('vip')->where('name',$data['name'])->first();
      	// dd($arr);
        $num = $m->count();
        $list = $m->orderby('created_at','desc')->where('vid','like','%'.$arr['id'].'%')->Paginate(5);
   

        return view('admin/cart/index',['num'=>$num,'list'=>$list,'search'=>$data]);
	}
	public function getUlist(){
		$id = $_GET['id'];
			$list = DB::table('cart')->where('id',$id)->first();

			$arr = DB::table('pdo')->where('id',$list['pdoid'])->first();

			$ar = DB::table('pdo_attr')->where('type_id',$arr['type_id'])->get();
			
			$li = DB::table('pdo_value')->where('pdo_id',$arr['id'])->get();
			// dd($li);
			// dd($arr);
			return view('admin/cart/ulist',['arr'=>$arr,'ar'=>$ar,'li'=>$li]);
	}
}