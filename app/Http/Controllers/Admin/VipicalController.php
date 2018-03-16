<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Model\admin\Vipical as b;
use App\Model\admin\Vip;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class VipicalController extends Controller
{

    /**
     * 判断权限
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        
        // $this->middleware('auth');
        $this->middleware('ability:admin|vip,show_vip',['only'=>['getIndex']]);
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
           
            return view('admin/vipical/index',['num'=>$num,'list'=>$list,'search'=>$data]);
    	}
}