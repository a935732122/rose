<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\admin\Dian as d;
use App\Model\admin\provice as p;
class DianController extends Controller
{

     /**
     * 判断权限
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        
        // $this->middleware('auth');
        $this->middleware('ability:admin|pdo,show_pdo',['only'=>['getIndex']]);
        $this->middleware('ability:admin|pdo,create_pdo',['only'=>['getAdd','postInsert','getCity']]);
        $this->middleware('ability:admin|pdo,update_pdo',['only'=>['getEdit','postUpdate']]);
        $this->middleware('ability:admin|pdo,delete_pdo',['only'=>'getDel']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        $data = [];
        $where= [];

        if (!empty($request->only('name'))) {
            $data=$request->only('name');
       
        }
        $num = d::count();
        $list = d::orderby('updated_at','desc')->with('provice')->where('name','like','%'.$data['name'].'%')->Paginate(5);
       
        return view('admin/dian/index',['list'=>$list,'num'=>$num,'search'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAdd()
    {
        $data = p::where('pid',0)->get();
        return view("admin/dian/add",['data'=>$data]);
    }

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
    public function postInsert(Request $request)
    {
        $data = $request->all();
        if(d::create($data))
       {
        return redirect('/admin/dian/index')->with('message','添加成功');
       }
       else
       {
        return redirect()->back()->withError('添加失败');
       }
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $list = d::find($id);
        $data = p::where('pid',0)->get();
        return view("admin/dian/edit",['list'=>$list,'data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $ee = d::find($id);
            $ee->fill($data);
            if($ee->save()){
                return redirect('admin/dian/index')->with('message', '修改成功!');   
            }else{
                 return redirect('admin/dian/index')->with('message', '修改失败!');   
            }
    }

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDel($id)
    {
        if(d::destroy($id)){
                return redirect('admin/dian/index')->with('message', '删除成功!');   
            }else{
                 return redirect('admin/dian/index')->with('message', '删除失败!');   
            }
    }
}
