<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\admin\Pdo_image as i;
class Pdo_imageController extends Controller
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

        if (!empty($request->only('title'))) {
            $data=$request->only('title');
       
        }
        $m = new i();
        $num = $m->count();
        $list = $m->orderby('updated_at','desc')->where('title','like','%'.$data['title'].'%')->with('pdo')->Paginate(4);
        // dd($list);
       
        return view('admin/pdo_image/index',['list'=>$list,'num'=>$num,'search'=>$data]);
    }



    /**
     * 加载修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $list = i::find($id);
        // dd($list);
        return view('admin/pdo_image/edit',['list'=>$list]);
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
        $id = $_POST['id'];
        // $id = $_POST['pdo_id'];
        $list = i::find($id);;//查询原数值
        // dd($list);
        $arr = $request->except('_token');//获取修改的值
        // dd($arr);
        $info=$request->file('image');//获取文件名
        // dd($info);
        if(empty($info)){
           $ee = i::find($id);
            $ee->fill($arr);
            if($ee->save()){
                return redirect('admin/pdo_image/index')->with('message', '修改失败!');
            }else{
                 return redirect('admin/pdo_image/index')->with('message', '修改失败!');
            }
        }else{
            $path = './uploads/pdo';//定义图片存储路径
            $data = ".".$list['image'];//定义图片路径和图片名称
            $re = unlink($data);
            //获取文件后缀
            $ext = $info->getClientOriginalExtension();
            //随机文件名
            
            $name = time().rand(00000,99999).'.'.$ext;
            //执行移动
            $re = $info->move($path,$name);
            $arr['image']='/uploads/pdo/'.$name;
           
            $ee = i::find($id);
            $ee->fill($arr);
            if($ee->save()){
                return redirect('admin/pdo_image/index')->with('message', '修改成功!');
               
            }else{
                 return redirect('admin/pdo_image/index')->with('message', '修改失败!');
                
            }
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
        $file = i::find($id);;//查询原数值

        $data = '.'.$file['image'];
        $re = unlink($data);
        $row = i::destroy($id);;
       if ($row) {
                 return redirect('admin/pdo_image/index')->with('message', '删除成功!');
           
        }else{
            return back()->with('message', '删除成功!');
        }
    }
}
