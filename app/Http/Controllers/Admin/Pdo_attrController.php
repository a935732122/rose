<?php

namespace App\Http\Controllers\admin;
header("Content-Type:text/html;charset=utf-8");

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\admin\Pdo_attr as a;
use App\Model\admin\Pdo_type as t;
use DB;

class Pdo_attrController extends Controller
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
     * 查询商品
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        $data = [];
        $where= [];

        if (!empty($request->only('attr'))) {
            $data=$request->only('attr');
       
        }
        $m = new a;
        $num = $m->count();
        
        $list = $m->orderby('updated_at','desc')->where('attr','like','%'.$data['attr'].'%')->with('pdo_type')->Paginate(5);
        // dd($list);
        
        return view('admin/pdo_attr/index',['list'=>$list,'num'=>$num,'search'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAdd()
    {
        $t = new t();
        $list = $t->get();
        return view('admin/pdo_attr/add',['list'=>$list]);
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
                    'attr'=>'required',
               ] ,  [

                    'attr.required'=>'属性名必填',
                ]
            );
        $m = new a();
        $data = $request->all();
        // dd($data);
        $post = $m->create($data);
        if ($post) {
            return redirect('admin/pdo_attr/index')->with('message', '添加成功!');
           
        }
          return redirect()->back()->withError('添加失败');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
       
        $list = t::get();
        $data = a::find($id);
        return view('admin/pdo_attr/edit',['list'=>$list,'data'=>$data]);
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
        $ee = a::find($id);
            $ee->fill($data);
            if ($ee->save()) {
                return redirect('admin/pdo_attr/index')->with('message', '修改成功!');
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
        // dd($id);
        $list=a::destroy($id);
        // $list->delete();
       return redirect('admin/pdo_attr/index')->with('message', '删除成功!');

    }
    
}
