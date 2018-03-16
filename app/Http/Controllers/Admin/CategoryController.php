<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Model\Admin\Category;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\Controller;

use DB;

class CategoryController extends Controller
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
        $this->middleware('ability:admin|pdo,update_pdo',['only'=>['getEdit','postUpdate','getSta']]);
        $this->middleware('ability:admin|pdo,delete_pdo',['only'=>'getDel']);
    }
    public function getIndex(Request $request){
        $data = [];
        $where= [];
        if (!empty($request->only('name'))) {
            $data=$request->only('name');
        }
        $category = new Category;
        $items = $category->getCategoryInfoTest();
        $num = $category->count();
        $list = $category->orderby('pid')->where('name','like','%'.$data['name'].'%')->Paginate(5);
        return view('admin/category/index',['list'=>$list,'num'=>$num,'search'=>$data]);
    }



    public function getAdd(){
        $category = new Category;
        $items = $category->getCategoryInfoTest();

        return view('admin/category/add',['list'=>$items]);
    }




     public function postSave(Request $request)
    {
          $this->validate($request,
               [
                    'name'=>'required',
                   
               ],
                [
            'name.required'=>'类别名必填',

           
        ]
            );
      $input = $request->except('_token');
          $data = $request->all();
        $filepath="./uploads/category/";
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
                         $image = "/uploads/category/".$newName;   //返回一个地址
                          $m = new category;
                          $data['image']=$image;
                          $post = $m->create($data);
                             
                          return redirect('admin/category/index')->with('message', '添加成功!');
           

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
           $m = new category;
           $m->create($data);
            return redirect('admin/category/index')->with('message', '添加成功!');
        }
      
    }




     public function getEdit($id)
    {
        
        $b = new Category;
        $arr = $b->find($id);
       $category = new Category;
        $items = $category->getCategoryInfoTest();
        return view('admin.category.edit',['arr'=>$arr,'list'=>$items]);

    }


     public function postUpdate(Request $request)
    {
         $this->validate($request,
               [
                    'name'=>'required',
                   
               ],
                [
            'name.required'=>'类别名必填', 
        ]
            );
      $input = $request->except('_token');
      $id = $input['id'];
      $arr = DB::table('category')->where('id',$input['id'])->first();
      
      // $arr = DB::table('category')->where('id',$input['id'])->first();
      $info=$request->file('image');//获取文件名
      // dd($info);
      
        if(!empty($info)){
          if($arr['image']){
            $path = './uploads/category';//定义图片存储路径
            $data = ".".$arr['image'];//定义图片路径和图片名称
            $re = unlink($data);
            //获取文件后缀
            $ext = $info->getClientOriginalExtension();
            //随机文件名
            $name = time().rand(00000,99999).'.'.$ext;
            //执行移动
            $re = $info->move($path,$name);
            $input['image']='/uploads/category/'.$name;
            $b = new Category();
              $ee = $b->find($id);
              $ee->fill($input);
              $ee->save();
               return redirect('admin/category/index')->with('message', '修改成功!'); 
          }else{
            $path = './uploads/category';//定义图片存储路径
            $data = ".".$arr['image'];//定义图片路径和图片名称
              $ext = $info->getClientOriginalExtension();
            //随机文件名
            $name = time().rand(00000,99999).'.'.$ext;
            //执行移动
            $re = $info->move($path,$name);
            $input['image']='/uploads/category/'.$name;
            $b = new Category();
              $ee = $b->find($id);
              $ee->fill($input);
              $ee->save();
               return redirect('admin/category/index')->with('message', '修改成功!'); 
          }
                
            }else{
               $b = new Category();
                $ee = $b->find($id);
                $ee->fill($input);
                $ee->save();
                 return redirect('admin/category/index')->with('message', '修改成功!');   
            }
        }
      


     public function getSta()
    {
        $id=$_GET['id'];
        $b=new Category();
        $status = DB::table('category')->where('id',$id)->first();
        $num = $b->where('pid',$id)->select('status')->first();
        // dd($num);
        if($num){
             return back();   
        }else{


             switch ($status['status']) {
            case '1':
                $data = ['status'=>2];
                // dd($data);
                $ee = $b->find($id);
                    $ee->fill($data);
                      $ee->save();
                   return back();

                // $this->redirect('index',['info '=>'已隐藏']);
                break; 
            case '2':
                $data = ['status'=>1];
                $ee = $b->find($id);
                    $ee->fill($data);
                      $ee->save();
                   

                   return back();
            break;
        }
         }
       
    }


      public function getDel($id){
        $b = new Category;
        $arr = $b->find($id);
        // dd($arr);
        $list = DB::table('category')->where('pid',$arr['id'])->first();
        // dd($list);
        if($arr['id']==$list['pid']){
            return redirect()->back()->with('message','删除失败,该类下方有子类');
          }else{
            if(empty($arr['image'])){
              $arr->delete();
              return redirect()->back()->with('message','删除成功');

            }else{
                $data = '.'.$arr['image'];
                $re = unlink($data);
                $arr->delete();
                 return redirect()->back()->with('message','删除成功');
            }
        
        } 

      }
}