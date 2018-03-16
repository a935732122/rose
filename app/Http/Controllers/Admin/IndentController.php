<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Model\admin\indent as b;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class IndentController extends Controller
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
        $this->middleware('ability:admin|vip,update_vip',['only'=>['getSta']]);
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
   

        return view('admin/indent/index',['num'=>$num,'list'=>$list,'search'=>$data]);
	}
    public function getUlist(){
        $id = $_GET['id'];
            $list = DB::table('indent_pdo')->where('did',$id)->get();
            foreach($list as $v){
            $listm[] = DB::table('pdo')->where('id',$v['pid'])->get();
            

        }
        // dd($listm);
            return view('admin/indent/ulist',['listm'=>$listm]);
    }
    public function getSta()
    {
        $id=$_GET['id'];
        $b=new b();
   
        $status = DB::table('indent')->where('id',$id)->select('status')->first();
        
        // dd($status);
        switch ($status['status']) {
            case '1':
                $data = ['status'=>2];
                $ee = $b->find($id);
                    $ee->fill($data);
                    $ee->save();
                    
                    return redirect('admin/indent/index');
                // $this->redirect('index',['info '=>'已隐藏']);
                break; 
            case '2':
                $data = ['status'=>1];
                $ee = $b->find($id);
                    $ee->fill($data);
                    $ee->save();
                
                  return redirect('admin/indent/index');
            break;
        }
    }
}