<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\admin\Pdo_type as t;
use App\Model\admin\Pdo as p;
use App\Http\Controllers\Controller;

class Pdo_typeController extends Controller
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
        $this->middleware('ability:admin|pdo,create_pdo',['only'=>['getAdd','postInsert']]);
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

        if (!empty($request->only('type'))) {
            $data=$request->only('type');
       
        }
        $m = new t;
        $num = $m->count();
        
        $list = $m->orderby('updated_at','desc')->where('type','like','%'.$data['type'].'%')->Paginate(5);
        // dd($list);
        
        return view('admin/pdo_type/index',['list'=>$list,'num'=>$num,'search'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAdd()
    {
        return view('admin/pdo_type/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postInsert(Request $request)
    {
         $this->validate($request,
               [
                    'type'=>'required',
               ] ,  [

                    'type.required'=>'类别名必填',
                ]
            );
        $m = new t();
        $data = $request->all();
        // dd($data);
        $post = $m->create($data);
        
        return redirect('admin/pdo_type/index')->with('message', '添加成功!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $data = t::find($id);
        return view('admin/pdo_type/edit',['data'=>$data]);
    }

   
    public function postUpdate(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $m = new t();
        $ee = $m->find($id);
            $ee->fill($data);
            if ($ee->save()) {
                return redirect('admin/pdo_type/index')->with('message', '修改成功!');
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
        $list = p::where('type_id',$id)->count();
        
        if ($list>0) {
             return redirect()->back()->with('message','该分类下有商品');
        }
       $list=t::destroy($id);
            return redirect()->back()->with('message','删除成功'); 
       

    }
}
