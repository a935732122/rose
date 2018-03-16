<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\admin\Banner1 as b;
use DB;

class Banner1Controller extends Controller
{
    /**
     * 判断权限
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        
        // $this->middleware('auth');
        $this->middleware('ability:admin|banner,show_banner',['only'=>['getIndex']]);
        $this->middleware('ability:admin|banner,create_banner',['only'=>['getAdd','postSave']]);
        $this->middleware('ability:admin|banner,update_banner',['only'=>['getEdit','postUpdate','getSta']]);
        $this->middleware('ability:admin|banner,delete_banner',['only'=>'getDel']);
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
        $m = new b;
        $num = $m->count();
        $list = $m->orderby('updated_at','desc')->where('title','like','%'.$data['title'].'%')->Paginate(5);
       
        return view('admin/banner1/ban_index',['list'=>$list,'num'=>$num,'search'=>$data]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAdd()
    {
        return view('admin/banner1/add');
    }


    public function postSave(Request $request)
    {   
        //验证规则
       $this->validate($request,
               [
                    'title'=>'required',
                   
               ],
                [
            'title.required'=>'标题必填',

           
        ]
            );
        $data = $request->all();

        $filepath="./uploads/banner1/";
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
                         $image = "/uploads/banner1/".$newName;   //返回一个地址
                          $m = new b;
                          $data['image']=$image;
                          $post = $m->create($data);
                             
                          return redirect('admin/banner1/index')->with('message', '添加成功!');   
           

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
             return redirect('admin/banner1/index')->with('message', '添加失败!');   
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        
         $b = new b();
        $arr = $b->find($id);
        
        return view('admin.banner1.edit',['arr'=>$arr]);

    }

    /**
     * 执行修改
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request)
    {
        $b=new b;
        $id = $_POST['id'];
        $list = $b->find($id);;//查询原数值
        $arr = $request->except('_token');//获取修改的值
        $info=$request->file('image');//获取文件名
        // dd($info);
        if(empty($info)){
           $ee = $b->find($id);
            $ee->fill($arr);
            if($ee->save()){
                 return redirect('admin/banner1/index')->with('message', '修改成功!');   
            }else{
                return redirect('admin/banner1/index')->with('message', '修改失败!');   
            }
        }else{
            $path = './uploads/banner1';//定义图片存储路径
            $data = ".".$list['image'];//定义图片路径和图片名称
            $re = unlink($data);
            //获取文件后缀
            $ext = $info->getClientOriginalExtension();
            //随机文件名
            
            $name = time().rand(00000,99999).'.'.$ext;
            //执行移动
            $re = $info->move($path,$name);
            $arr['image']='/uploads/banner1/'.$name;
           
            $ee = $b->find($id);
            $ee->fill($arr);
            if($ee->save()){
                return redirect('admin/banner1/index')->with('message', '修改成功!');   
            }else{
                 return redirect('admin/banner/index')->with('message', '修改失败!');   
            }
        }
        // return redirect('admin/banner');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDel()
    {
        $b=new b;
        // $data = './home/index/images/';
        $id=$_GET['id'];
        $file = $b->find($id);;//查询原数值

        // dd($file['file-1']);
        $data = '.'.$file['image'];
        $re = unlink($data);
        $row = DB::table('banner1')->where('id',$id)->delete();
       if ($row) {
            return redirect('/admin/banner1/index');
        }else{
            return back();
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSta()
    {
        $id=$_GET['id'];
        $b=new b();
        $status = DB::table('banner1')->where('id',$id)->select('status')->first();
        // dd($status);
        switch ($status['status']) {
            case '1':
                $data = ['status'=>2];
                $ee = $b->find($id);
                    $ee->fill($data);
                    $ee->save();
                    return redirect('admin/banner1/index');
                // $this->redirect('index',['info '=>'已隐藏']);
                break; 
            case '2':
                $data = ['status'=>1];
                $ee = $b->find($id);
                    $ee->fill($data);
                    $ee->save();
                    return redirect('admin/banner1/index');
            break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
