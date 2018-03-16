<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Model\admin\Vip as b;
use App\Model\admin\Vipical as d;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class VipController extends Controller
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
        $this->middleware('ability:admin|vip,update_vip',['only'=>['getSta']]);
    }

	public function getIndex(Request $request){
		$data = [];
        $where= [];

        if (!empty($request->only('name'))) {
            $data=$request->only('name');
       
        }
        $m = new b;
        $num = $m->count();
        $list = $m->orderby('created_at','desc')->where('name','like','%'.$data['name'].'%')->Paginate(5);
       
        return view('admin/vip/index',['num'=>$num,'list'=>$list,'search'=>$data]);
	}
	
	public function getSta()
    {
        $id=$_GET['id'];
        $b=new b();
        $d = new d();
        $status = DB::table('vip')->where('id',$id)->select('status')->first();
         $arr = DB::table('vipical')->where('vid',$id)->first();
        // dd($status);
        switch ($status['status']) {
            case '1':
                $data = ['status'=>2];
                $ee = $b->find($id);
                    $ee->fill($data);
                    $ee->save();
                    if($arr){


                     $dd = $d->find($arr['id']);
                    $dd->fill($data);
                    $dd->save();
                    return redirect('admin/vip/index');

                      }
                    return redirect('admin/vip/index');
                // $this->redirect('index',['info '=>'已隐藏']);
                break; 
            case '2':
                $data = ['status'=>1];
                $ee = $b->find($id);
                    $ee->fill($data);
                    $ee->save();
                if($arr){
                    $dd = $d->find($arr['id']);
                    $dd->fill($data);
                    $dd->save();
                    return redirect('admin/vip/index');
                }
                  return redirect('admin/vip/index');
            break;
        }
    }
}