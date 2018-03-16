<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\admin\Cate_image as i;
use App\Model\admin\Category;
use DB;
class Cate_imageController extends Controller
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
        $this->middleware('ability:admin|pdo,create_pdo',['only'=>['getAdd','postSave']]);
        $this->middleware('ability:admin|pdo,update_pdo',['only'=>['getEdit','postUpdate']]);
        $this->middleware('ability:admin|pdo,delete_pdo',['only'=>'getDel']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $m = new i();
        $num = $m->count();
        $list = $m->Paginate(5);
        $mm = DB::table('category')->where('pid',0)->get();
        // dd($mm);
        return view('admin/cate_image/index',['list'=>$list,'num'=>$num,'mm'=>$mm]);
    }



     public function getAdd(){
        $mm = new i;
        $items = $mm->get();
        $category = new category();
        $ms = $category->where('pid',0)->get();
        return view('admin/cate_image/add',['list'=>$items,'ms'=>$ms]);
    }




     public function postSave(Request $request)
    {
         $this->validate($request,
               [
                    'image'=>'required',
                   
               ],
                [
            'image.required'=>'图片必填',

           
        ]
            );

      $input = $request->except('_token');
          $data = $request->all();
        $filepath="./uploads/cate/";
         //1.首先检查文件是否存在
        if ($request->hasFile('image')){
        //2.获取文件
        $file = $request->file('image');
        //3.其次检查图片手否合法
        if ($file->isValid()){
    // 先得到文件后缀,然后将后缀转换成小写,然后看是否在否和图片的数组内
                if(in_array( strtolower($file->getClientOriginalExtension()),['jpeg','jpg','gif','gpeg','png'])){
                    //4.将文件取一个新的名字
                    $newName = 'img'.time().rand(100000, 999999).$file->getClientOriginalName();
                    //5.移动文件,并修改名字
                    if($file->move($filepath,$newName)){
                         $image = "/uploads/cate/".$newName;   //返回一个地址
                          $m = new i;
                          $data['image']=$image;
                          $post = $m->create($data);
                             
                          return redirect('admin/cate_image/index')->with('message', '添加成功!');
           

                    }else{
                        return "图片储存失败";
                    }
                }else{
                    return "图片后缀不对";
                }

            }else{
                return "图片不合法";
                
            }
        }else{
           $m = new i;
           $m->create($data);
            return redirect('admin/cate_image/index')->with('message', '添加成功!');
        }
      
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
        return view('admin/cate_image/edit',['list'=>$list]);
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
        // $id = $_POST['cate_id'];
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
                return redirect('admin/cate_image/index')->with('message', '修改成功!');
            }else{
                 return redirect('admin/cate_image/index')->with('message', '修改失败!');
            }
        }else{
            $path = './uploads/cate';//定义图片存储路径
            $data = ".".$list['image'];//定义图片路径和图片名称
            $re = unlink($data);
            //获取文件后缀
            $ext = $info->getClientOriginalExtension();
            //随机文件名
            
            $name = time().rand(00000,99999).'.'.$ext;
            //执行移动
            $re = $info->move($path,$name);
            $arr['image']='/uploads/cate/'.$name;
           
            $ee = i::find($id);
            $ee->fill($arr);
            if($ee->save()){
                return redirect('admin/cate_image/index')->with('message', '修改成功!');
               
            }else{
                 return redirect('admin/cate_image/index')->with('message', '修改失败!');
                
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
                 return redirect('admin/cate_image/index')->with('message', '删除成功!');
           
        }else{
            return back()->with('message', '删除成功!');
        }
    }


}
