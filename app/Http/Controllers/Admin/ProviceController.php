<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Model\Admin\Provice;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\Controller;

use DB;

class ProviceController extends Controller
{

     /**
     * 判断权限
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        
        // $this->middleware('auth');
        $this->middleware('ability:admin|pdo,show_pdo',['only'=>['getIndex','getShow']]);
        $this->middleware('ability:admin|pdo,create_pdo',['only'=>['getAdd','postSave']]);
        $this->middleware('ability:admin|pdo,update_pdo',['only'=>['getEdit','postUpdate']]);
        $this->middleware('ability:admin|pdo,delete_pdo',['only'=>'getDel']);
    }
    public function getIndex(Request $request){
        $data = [];
        $where= [];
        if (!empty($request->only('name'))) {
            $data=$request->only('name');
        }
        $provice = new Provice;
        $items = $provice->get();
        $num = $provice->count();
        $list = $provice->orderby('pid')->where('name','like','%'.$data['name'].'%')->Paginate(5);
        return view('admin/provice/index',['list'=>$list,'num'=>$num,'search'=>$data]);
    }



    public function getAdd(){
        $provice = new Provice;
        $items = $provice->where('pid',0)->get();
        return view('admin/provice/add',['list'=>$items]);
    }




    public function postSave(Request $request)
    {
          $this->validate($request,
               [
                    'name'=>'required',
                   
               ],
                [
            'name.required'=>'类别名必填',

           
        ]
            );
      $input = $request->except('_token');
      $m = new Provice;

       if($m->create($input))
       {
        return redirect('/admin/provice/index')->with('message','添加成功');
       }
       else
       {
        return redirect()->back()->withError('添加失败');
       }
    }




     public function getEdit($id)
    {
        
        $b = new Provice;
        $arr = $b->find($id);
        // dd($arr['pid']);
        // $id=$_GET['id'];

        $items = $b->where('id',$id)->first();
        // dd($items);
        return view('admin.provice.edit',['arr'=>$arr,'list'=>$items]);

    }
     public function postUpdate(Request $request)
    {
         $this->validate($request,
               [
                    'name'=>'required',
                   
               ],
                [
            'name.required'=>'类别名必填',

           
        ]
            ); 
        $b = new Provice();
       $input = $request->except('_token');
       $id = $input['id'];
        $list = DB::table('Provice')->where('id',$input['id'])->first();  
        if($list['name']==$input['name'] and $list['pid']==$input['pid']){
            return redirect()->back()->with('message','请输入要修改的信息');
        }else{
            $ee = $b->find($id);
            $ee->fill($input);
           $ee->save();
              return redirect('admin/provice/index')->with('message','修改成功');
          }
        
      
    }


    public function getDel($id){
       $b = new Provice;
        $arr = $b->find($id);
        // dd($arr);
        $list = DB::table('Provice')->where('pid',$arr['id'])->first();
        dd($list);
        if($arr['pid']==0){
          return redirect()->back()->with('message','顶级类别不能删除');
        }else{
          if($arr['id']==$list['pid']){
            return redirect()->back()->with('message','该类下方有子类');
          }else{
            $arr->delete();
            return redirect()->back()->with('message','删除成功');
          }
        }
        
    } 

    
    public function getShow($id){
      $b = new Provice;
        $arr = $b->find($id);
        $list = DB::table('provice')->where('pid',$arr['id'])->first();
        $status = DB::table('provice')->where('id',$id)->select('status')->first();
        // dd($status);
           switch ($status['status']) {
            case '1':
                $data = ['status'=>2];
                $ee = $b->find($id);
                    $ee->fill($data);
                    $ee->save();
                    return redirect('admin/provice/index');
                // $this->redirect('index',['info '=>'已隐藏']);
                break; 
            case '2':
                $data = ['status'=>1];
                $ee = $b->find($id);
                    $ee->fill($data);
                    $ee->save();
                    return redirect('admin/provice/index');
            break;
        }
    }
        
}