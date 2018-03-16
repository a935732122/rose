<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use App\User;
use DB;

class RoleController extends Controller
{
    /**
     * 判断权限
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        
        // $this->middleware('auth');
        $this->middleware('ability:admin|role,show_role',['only'=>['getIndex']]);
        $this->middleware('ability:admin|role,create_role',['only'=>['getAdd','postInsert']]);
        $this->middleware('ability:admin|role,update_role',['only'=>['getEdit','postUpdate']]);
        $this->middleware('ability:admin|role,delete_role',['only'=>'getDel']);
    }
    /**
     * 加载页面
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
        $m = new Role();
        $num = $m->count();
        $roles = $m->orderby('updated_at','desc')->where('name','like','%'.$data['name'].'%')->Paginate(5);
       
        return view('admin/role/index',['roles'=>$roles,'num'=>$num,'search'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAdd()
    {
        $permission = Permission::get();
        return view('admin.role.add',['permissions'=>$permission]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postInsert(Request $request)
    {
        $role = new Role($request->all());
        // dd();
        
        $this->validate($request,
               [
                    'name'=>'required',
                    'display_name'=>'required',
                    'permission'=>'required',
               ],
                [
                'name.required'=>'角色必填',
                'display_name.required'=>'角色名必填',
                'permission.required'=>'权限必填',
         
            
        ]
            );
        $m = DB::table('roles')->where('name',$role['name'])->first();
       if($m){
            return redirect()->back()->with('message','添加失败,角色已存在');
       }else{
       if($role->save())
       {
        //给角色添加相关权限
       
        $role->perms()->sync($request->get('permission'));
           return redirect('admin/role/index')->with('message', '添加成功!');
       }
       else
       {
          return redirect('admin/role/index')->with('message', '添加失败!');
       }
    }}

    /**
     * 加载修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $rose = DB::table('roles')->find($id);
        // dd($rose['name']);
        $rp = DB::table('permission_role')->where('role_id',$id)->get();
        // $b = call_user_func_array('array_merge', $rp);
        // print_r($b);
         // dd($rp);
         if (empty($rp)) {
            $permission = Permission::get();
             return view('admin.role.edit',['rose'=>$rose,'permissions'=>$permission]);
         }else{
            foreach ($rp as $value) {
                $ids[] = $value['permission_id']; 
            }

            $permission = Permission::get();
            // // dd($permission);
            return view('admin.role.edit',['rose'=>$rose,'permissions'=>$permission,'ids'=>$ids]);
         }
        
    }

    /**
     * 执行修改操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request)
    {
        $arr = $request->except('_token');
        // dd($arr);
        if (empty($arr['permission'])) {

                DB::table('permission_role')->where('role_id',$arr['id'])->delete();
                 return redirect('admin/role/index')->with('message', '添加成功!');
             }
             
             $c=implode(" ",$arr['permission']);
                // print_r($c);

             $list = DB::table('permission_role')->where('role_id',$arr['id'])->get();
             // dd($list);
             if(empty($list)){
               
                        $role = new Role($request->all());
                        
                         $role = Role::findOrFail($request->get('id'));
                        $role->perms()->sync($request->get('permission'));

                         return redirect('admin/role/index')->with('message', '添加成功!');
                 
                  
                }
                   
             
             foreach($list as $v){
              $a = $v['permission_id']." ";
                echo $a;
             }
            
             if($a == $c){
                return redirect('/admin/role/index');
             }else{
                DB::table('permission_role')->where('role_id',$arr['id'])->delete();
                
                 $role = new Role($request->all());
                        
                         $role = Role::findOrFail($request->get('id'));
                        $role->perms()->sync($request->get('permission'));
           
                // }
                 return redirect('admin/role/index')->with('message', '添加成功!');
             }
                
    }

    /**
     * 执行删除操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDel($id)
    {
        //
        
        $roses = DB::table('roles')->where('id',$id)->delete();
        
         $role_users = DB::table('permission_role')->where('role_id',$id)->delete();
       return redirect('/admin/role/index');
    }
}
