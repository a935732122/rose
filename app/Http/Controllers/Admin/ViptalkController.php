<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Model\admin\Vipical;
use App\Model\admin\Vip;
use App\Model\admin\Viptalk as b;
use App\Model\admin\Hui as h;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class ViptalkController extends Controller
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
         $this->middleware('ability:admin|vip,update_vip',['only'=>['getIndex','getSta','getHui','postEdit']]);
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
       
        return view('admin/viptalk/index',['num'=>$num,'list'=>$list,'search'=>$data]);
	}
    public function getSta()
    {
        $id=$_GET['id'];
        $b=new b();

        $status = DB::table('viptalk')->where('id',$id)->select('status')->first();
         
        // dd($status);
        switch ($status['status']) {
            case '1':
                $data = ['status'=>2];
                $ee = $b->find($id);
                    $ee->fill($data);
                    $ee->save();
                    
                    return redirect('admin/viptalk/index');
                // $this->redirect('index',['info '=>'已隐藏']);
                break; 
            case '2':
                $data = ['status'=>1];
                $ee = $b->find($id);
                    $ee->fill($data);
                    $ee->save();
                
                  return redirect('admin/viptalk/index');
            break;
        }
    }

    public function getHui($id){
        $list = b::find($id);
        return view("admin/viptalk/hui",['list'=>$list]);
    }
    public function postEdit(Request $request){
        $data = $request->all();
        
        if(h::create($data))
       {
        return redirect('/admin/viptalk/index')->with('message','回复成功');
       }
       else
       {
        return redirect()->back()->withError('回复失败');
       }
        
    }
}