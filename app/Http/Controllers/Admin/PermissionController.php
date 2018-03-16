<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Permission;
use DB;
class PermissionController extends Controller
{
     /**
     * 判断权限
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        
        // $this->middleware('auth');
        $this->middleware('ability:admin|permission,show_permission',['only'=>['getIndex']]);
        $this->middleware('ability:admin|permission,create_permission',['only'=>['getAdd','postInsert']]);
        $this->middleware('ability:admin|permission,update_permission',['only'=>['getEdit','postUpdate']]);
        $this->middleware('ability:admin|permission,delete_permission',['only'=>'getDel']);
    }
    /**
     * 加载权限列表页
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
        $m = new Permission();
        $num = $m->count();
        $permissions = $m->orderby('updated_at','desc')->where('name','like','%'.$data['name'].'%')->Paginate(5);
       
        return view('admin/permission/index',['list'=>$permissions,'num'=>$num,'search'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAdd()
    {
        return view('admin.permission.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postInsert(Request $request)
    {
        //验证规则
        $this->validate($request,
               [
                    'name'=>'required',
                    'display_name'=>'required',
               ],
                [
            'name.required'=>'权限必填',
            'display_name.required'=>'权限名必填',
         
            
        ]
            );
        // dd($request);
       $permission = new Permission($request->all());
       // dd($permission['name']);
       $m = DB::table('permissions')->where('name',$permission['name'])->first();
       if($m){
            return redirect()->back()->with('message','添加失败,权限已存在');
       }else{


       if($permission->save())
       {
            return redirect('/admin/permission/index')->with('message','添加成功');
       }
       else
       {
        return redirect()->back()->withError('添加失败');
       }
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        //
         $permission = DB::table('permissions')->find($id);
         return view('admin.permission.edit',['permissions'=>$permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request)
    {
        //
         $input = $request->except('_token');//过滤_token字段

        $info = DB::table('permissions')->where('id',$input['id'])->update($input);//执行修改

        if ($info == 1) {
            return redirect('/admin/permission/index')->with('message','修改成功');
        }else{
            return redirect()->back()->with('message','修改失败');
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
        $permisssion = Permission::findOrFail($id);
        $permisssion->delete();
        // dd(111);
        return redirect('/admin/permission/index');
    }
}
