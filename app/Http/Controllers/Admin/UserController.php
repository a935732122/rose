<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\Role;
class UserController extends Controller
{
    /**
     * 判断权限
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        
        // $this->middleware('auth');
        $this->middleware('ability:admin|user,show_user',['only'=>['getIndex']]);
        $this->middleware('ability:admin|user,create_user',['only'=>['getAdd','postStore','getRole','postInsert']]);
        $this->middleware('ability:admin|user,update_user',['only'=>['getEdit','postUpdate','getSta']]);
        $this->middleware('ability:admin|user,delete_user',['only'=>'getDel']);
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function getIndex(Request $request)
    {
       $a =  DB::table('users')->where('email','lizhi@qq.com')->get();
       if ($a[0]['email']) {
          $b = $a[0]['email'];

       }

        $data = [];
        $where= [];

        if (!empty($request->only('name'))) {
            $data=$request->only('name');
        }
        $m = new User();
        $num = $m->count();
        $users = $m->orderby('updated_at','desc')->where('name','like','%'.$data['name'].'%')->Paginate(5);
       
        return view('admin/user/index',['users'=>$users,'num'=>$num,'search'=>$data,'b'=>$b]);

    }

     /**
     * 添加用户
     *
     * @return \Illuminate\Http\Response
     */
    public function getAdd()
    {
        
        return view('admin.user.add');

    }
    public function postInsert(Request $request){
        $this->validate($request,
               [
                    'name'=>'required',
                    'email'=>'required',
                    'password'=>'required',
               ],
                [
            'name.required'=>'用户名必填',
            'email.required'=>'邮箱必填',
            'password.required'=>'密码必填',
         
            
        ]
            );
        
        $user = new user($request->all());
        $u = DB::table('users')->where('email',$user['email'])->first();
        if($u){
            return redirect('admin/user/index')->with('message', '添加失败!邮箱存在');
        }else{


        if ($user->save()) {
            return redirect('admin/user/index')->with('message', '添加成功!');   
        }else{
              return redirect('admin/user/index')->with('message', '添加失败!');   
        }
        }
        
    }
    /*
    *加载分配角色
     */
    public function getRole($id)
    {

        $user = DB::table('users')->find($id);

        // dd($user);
        // $rp = DB::table('role_user')->get();
        $user = User::with('roles')->findOrFail($id);
       
        foreach ($user->roles as $value) {
            // print_r($user->roles);
            $ids[] = $value['id']; 
            
        }
        $roles = Role::get();
        if (empty($ids)) {
                return view('admin.user._role',['user'=>$user,'roles'=>$roles]);
            }else{
                return view('admin.user._role',['user'=>$user,'ids'=>$ids,'roles'=>$roles]);
            }
        

    }
    /*
    *分配角色
     */

    public function postSrole(Request $request)
    {
     $arr = $request->except('_token');
     // dd($arr);
     // 
     
     // 清空权限时
     if (empty($arr['role'])) {
          $k = DB::table('role_user')->where('user_id',$arr['id'])->delete();
          if (!empty($k)) {
               return redirect('admin/user/index')->with('message', '添加失败!');   
          }
           return redirect('admin/user/index')->with('message', '添加成功!');   
     }
     
     $c=implode(" ",$arr['role']);
        // print_r($c);

     $list = DB::table('role_user')->where('user_id',$arr['id'])->get();

     // 如果该权限本来是空时的添加权限
     if (empty($list)) {
            
               
        $user = User::findOrFail($request->get('id'));
               
       $info = $user->roles()->attach($request->get('role'));
        if (!empty($info)) {
            return redirect('admin/user/index')->with('message', '添加失败!');   
            }
            return redirect('admin/user/index')->with('message', '添加成功!');     
     }

     foreach($list as $v){
        $a = $v['role_id']." ";
        echo $a;
     }

     if($a == $c){
         return redirect('admin/user/index')->with('message', '添加成功!');   
     }else{
        DB::table('role_user')->where('user_id',$arr['id'])->delete();
        $user = User::findOrFail($request->get('id'));
       
        // foreach ( as $id) {
        $k = $user->roles()->attach($request->get('role')); 
        // }
        if (!empty($k)) {
            return redirect('admin/user/index')->with('message', '添加失败!');   
            }
             return redirect('admin/user/index')->with('message', '添加成功!');    
     }
    

    }
    /**
     * 删除用户
     *
     * @return \Illuminate\Http\Response
     */
    public function getDel($id)
    {

        $a = DB::table('role_user')->where('user_id',$id)->get();
        // 当没有角色时执行删除
        if (!empty($a)) {
        // 当没有角色时执行删除
        
            $role_users = DB::table('role_user')->where('user_id',$id)->delete();
            $user = DB::table('users')->where('id',$id)->delete();
            return redirect('/admin/user/index');
        }
           $user = DB::table('users')->where('id',$id)->delete();
       //   // $role_users->delete();
       return redirect('/admin/user/index');
    }

    /**
     * 状态管理
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
     
    public function getSta($id)
    {
        
        $b=new User();
        $status = DB::table('users')->where('id',$id)->select('status')->first();
        // dd($status);
        switch ($status['status']) {
            case '1':
                $data = ['status'=>2];
                $ee = $b->find($id);
                    $ee->fill($data);
                    $ee->save();
                    return redirect('admin/user/index');
                
                break; 
            case '2':
                $data = ['status'=>1];
                $ee = $b->find($id);
                    $ee->fill($data);
                    $ee->save();
                    return redirect('admin/user/index');
            break;
        }
    }


    /**
     * 修改用户
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $b = new User();
        $arr = $b->find($id);

        return view('admin.user.edit',['arr'=>$arr]);
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
        $b = new User();
        $arr = $request->except('_token');
        $id = $arr['id'];
         $list = $b->find($id);
         // dd($list);
        if ($arr['password']=='') {
            $arr['password']=$list['password'];
            // dd($arr);
        }else{

            $arr['password']=bcrypt($arr['password']);
        }
        $list->fill($arr);
        if($list->save()){
                return redirect('admin/user/index')->with('message', '修改成功!');   
            }else{
            return redirect('admin/user/index')->with('message', '修改失败!');   
            }
    }

   
}
