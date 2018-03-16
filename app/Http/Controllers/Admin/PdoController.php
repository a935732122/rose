<?php

namespace App\Http\Controllers\admin;
header("Content-Type:text/html;charset=utf-8");

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\admin\Pdo as p;
use App\Model\admin\Pdo_type as t;
use App\Model\admin\Category as c;
use App\Model\admin\Pdo_value as v;
use App\Model\admin\Pdo_attr as a;
use App\Model\admin\Pdo_image as i;
use DB;

class PdoController extends Controller
{

    /**
     * 判断权限
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        
        // $this->middleware('auth');
        $this->middleware('ability:admin|pdo,show_pdo',['only'=>['getIndex','getUlist']]);
        $this->middleware('ability:admin|pdo,create_pdo',['only'=>['getAdd','postInsert','getParam','postPara','getIma','postImg']]);
        $this->middleware('ability:admin|pdo,update_pdo',['only'=>['getEdit','postUpdate','getSta']]);
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

        if (!empty($request->only('name'))) {
            $data=$request->only('name');
       
        }
        $m = new p;
        $num = $m->count();
        
        $list = $m->orderby('updated_at','desc')->where('name','like','%'.$data['name'].'%')->with('pdo_type')->Paginate(5);
        // dd($list);
        
        return view('admin/pdo/index',['list'=>$list,'num'=>$num,'search'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAdd()
    {
        $t = new t();
        $c = new c();
        $list = $t->get();
        $lists = $c->get();
        return view('admin/pdo/add',['list'=>$list,'lists'=>$lists]);
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
                    'name'=>'required',
                    'price'=>'required',
               ] ,
                [

                    'name.required'=>'商品名必填',
                    'price.required'=>'价格必填',
                ]
            );
                $data = $request->all();

        $filepath="./uploads/pdo/";
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
                         $image = "/uploads/pdo/".$newName;   //返回一个地址
                          $data['image']=$image;
                          $post = p::create($data);
                             
                          return redirect('admin/pdo/index')->with('message', '添加成功!');
           

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
             return redirect('admin/pdo/index')->with('message', '添加失败!');
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
        $t = new t();
        $c = new c();
        $p = new p();
        $list = $t->get();
        $lists = $c->get();
        $data = $p->find($id);
        return view('admin/pdo/edit',['list'=>$list,'lists'=>$lists,'data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request)
    {
         $id = $_POST['id'];
        // $id = $_POST['pdo_id'];
        $list = p::find($id);;//查询原数值
        // dd($list);
        $arr = $request->except('_token');//获取修改的值
        // dd($arr);
        $info=$request->file('image');//获取文件名
        // dd($info);
        if(empty($info)){
           $ee = p::find($id);
            $ee->fill($arr);
            if($ee->save()){
                return redirect('admin/pdo/index')->with('message', '修改成功!');
            }else{
                 return redirect('admin/pdo/index')->with('message', '修改失败!');
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
           
            $ee = p::find($id);
            $ee->fill($arr);
            if($ee->save()){
                return redirect('admin/pdo/index')->with('message', '修改成功!');
               
            }else{
                 return redirect('admin/pdo/index')->with('message', '修改加失败!');
                
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
         $file = p::find($id);;//查询原数值

        $data = '.'.$file['image'];
        $re = unlink($data);
        $row = p::destroy($id);
       if ($row) {
                 return redirect('admin/pdo/index')->with('message', '删除成功!');
           
        }else{
            return back()->with('message', '删除成功!');
        }

    }
     public function getSta()
    {
        $id=$_GET['id'];
        $b=new p();
        $status = DB::table('pdo')->where('id',$id)->select('status')->first();
        // dd($status);
        switch ($status['status']) {
            case '1':
                $data = ['status'=>2];
                $ee = $b->find($id);
                    $ee->fill($data);
                    $ee->save();
                    return redirect('admin/pdo/index');
                // $this->redirect('index',['info '=>'已隐藏']);
                break; 
            case '2':
                $data = ['status'=>1];
                $ee = $b->find($id);
                    $ee->fill($data);
                    $ee->save();
                    return redirect('admin/pdo/index');
            break;
        }
    }
    /**
     * 添加参数
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getParam($type_id,$id)
    {
        // dd($id);
        $list = a::where('type_id',$type_id)->get();
        $lists = v::where('pdo_id',$id)->get();
        return view('admin/pdo/param',['list'=>$list,'id'=>$id,'lists'=>$lists]);

    }
    /**
     * 添加参数
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postPara(Request $request)
    {
         $data = $request->except('_token');
        $num = v::where('pdo_id',$data['pdo_id'])->count();
        // dd($data);
        foreach ($data['value'] as $k=>$v) {
            $list[$k]['value'] = $v;
            $list[$k]['pdo_id'] = $data['pdo_id']; 
        }
        foreach ($data['attr_id'] as $k=>$v) {
            $list[$k]['attr_id'] = $v; 
        }
        // dd($list);
        if ($num==0) {
            foreach ($list as $v) {
            v::create($v);
            }
            return redirect('admin/pdo/index')->with('message', '添加成功!');
        }
        // $id = [];
        foreach ($list as $v) {
            $id = v::where(['pdo_id'=>$v['pdo_id'],'attr_id'=>$v['attr_id']])->select('id')->first();
            $bb = v::find($id['id']);
            $bb->value = $v['value'];
            $bb->save();
            // dd($bb);
            
        }
       
        return redirect('admin/pdo/index')->with('message', '添加成功!');
    }

    public function getUlist(){
        $id = $_GET['id'];
        // dd($id);
            // $list = DB::table('indent')->where('id',$id)->first();

            $arr = DB::table('pdo')->where('id',$id)->first();
            // dd($arr);
            $ar = DB::table('pdo_attr')->where('type_id',$arr['type_id'])->get();
            // $ar = DB::table('pdo_type')->where('type_id',$arr['type_id'])->get();
            
            $li = DB::table('pdo_value')->where('pdo_id',$arr['id'])->get();
            
            return view('admin/pdo/ulist',['arr'=>$arr,'ar'=>$ar,'li'=>$li]);
    }

        /**
     * 加载添加图片页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getIma($id)
    {
        $list = p::find($id)->name;
        // dd($id);
       return view('admin/pdo/img',['list'=>$list,'id'=>$id]);
    }
      /**
     * 添加图片
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postImg(Request $request)
    {
        
         $data = $request->all();

        $filepath="./uploads/pdo/";
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
                         $image = "/uploads/pdo/".$newName;   //返回一个地址
                          $data['image']=$image;
                          $post = i::create($data);
                             
                          return redirect('admin/pdo/index')->with('message', '添加成功!');
           

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
             return redirect('admin/pdo/index')->with('message', '添加失败!');
        }
    }
}
