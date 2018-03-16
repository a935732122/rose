<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\admin\Vip as v;
use App\Model\admin\Vipical as vm;
use App\Model\admin\Vipce as c;
use App\Model\admin\Indent as pp;
use App\Model\home\Indent_pdo as a;
use App\Model\admin\Pdo;
use DB;
class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $name = session('name');
       
        $id = DB::table('vip')->where('name',$name)->first();
        $i = DB::table('Indent')->where('vid',$id['id'])->first();
        // dd($i);
        $ix = DB::table('Indent')->where('vid',$id['id'])->get();
        // dd($ix);
        
       
        if (!$i) {
            return view('home/personal/index',['i'=>$i]);
        }
        foreach($ix as $v){
            $im[] = DB::table('Indent_pdo')->where('did',$v['id'])->get();
        }
        
        foreach($ix as $ll){
             $in[] =  a::where('did',$ll['id'])->get();

        }
       // dd($in);
       //  $in= a::get();
        $p = DB::table('pdo')->get();
        return view('home/personal/index',['i'=>$i,'im'=>$im,'p'=>$p,'in'=>$in,'ix'=>$ix]);
    }


    public function getDfx()
    {

        $name = session('name');
        $id = DB::table('vip')->where('name',$name)->first();
        $i = DB::table('Indent')->where(['vid'=>$id['id'],'stat'=>2])->get();
        $imx = DB::table('Indent')->where(['vid'=>$id['id'],'stat'=>2])->first();
        $im = DB::table('Indent_pdo')->get();
        $in= a::get();
        $p = DB::table('pdo')->get();
        return view('home/personal/dfx',['i'=>$i,'im'=>$im,'p'=>$p,'in'=>$in,'imx'=>$imx]);
    }

     public function getDfh()
    {

        $name = session('name');
        $id = DB::table('vip')->where('name',$name)->first();
        $i = DB::table('Indent')->where(['vid'=>$id['id'],'status'=>2,'stat'=>1])->get();
        $imx = DB::table('Indent')->where(['vid'=>$id['id'],'status'=>2,'stat'=>1])->first();
        $im = DB::table('Indent_pdo')->get();
        $in= a::get();
        $p = DB::table('pdo')->get();
        return view('home/personal/dfh',['i'=>$i,'im'=>$im,'p'=>$p,'in'=>$in,'imx'=>$imx]);
    }

      public function getDsh()
    {

        $name = session('name');
        $id = DB::table('vip')->where('name',$name)->first();
        $i = DB::table('Indent')->where(['vid'=>$id['id'],'status'=>1])->get();
        $imx = DB::table('Indent')->where(['vid'=>$id['id'],'status'=>1])->first();
        $im = DB::table('Indent_pdo')->get();
        $in= a::get();
        $p = DB::table('pdo')->get();
        return view('home/personal/dsh',['i'=>$i,'im'=>$im,'p'=>$p,'in'=>$in,'imx'=>$imx]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit()
    {
        $name = session('name');
        $v = new v();
        $list = $v->where('name',$name)->first();
        // dd($list);
        return view('home/personal/pass',['list'=>$list]);
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
         $this->validate($request,
               [
                    'oldpass'=>'required',
                    'userpass'=>'required',
                    'newpass'=>'required',
                   
               ],
                [
            'oldpass.required'=>'旧密码必填',
            'userpass.required'=>'新密码必填',
            'newpass.required'=>'确认密码必填',

        ]
            );

        $m = $request->all();
        $v = new v();
        // dd(md5($m['userpass']));
        $list = $v->where('id',$m['id'])->first();
        // dd($list);
        if($list['pass']!=md5($m['oldpass'])){
            return back()->with('message','旧密码错误');
        }else{
            if($m['userpass']!=$m['newpass']){
                return back()->with('message','两次新密码不一致');
            }else{
                if($list['pass']==md5($m['userpass'])){
                    return back()->with('message','新密码与旧密码相同');
                }else{
                    $list->pass = md5($m['userpass']);
                    $list->save();
                    return back()->with('message','修改成功');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAddress()
    {   
        $name = session('name');
        $v = new v();
        $list = $v->where('name',$name)->first();
        $mm = DB::table('vipical')->orderby('da')->where('vid',$list['id'])->get();
        return view('home/personal/address',['mm'=>$mm,'list'=>$list]);
    }

    public function getDel()
    {
        $id = $_GET['id'];
        $data = DB::table('vipical')->where('id',$id)->delete();
        return back();
    }

     public function getAd()
     {
        $id = $_GET['id'];
       // dd($id);
        $data = DB::table('vipical')->where('da',1)->first();
        $data['da']=2;
        $data = DB::table('vipical')->where('id',$data['id'])->update($data);
        $addr = DB::table('vipical')->where('id',$id)->first();
        $addr['da']=1;
        $addr = DB::table('vipical')->where('id',$id)->update($addr);
        return  back();
    }



    public function getUpdate()
    {
        $id = $_GET['id'];
        $mm = DB::table('vipical')->where('id',$id)->get();
        return view('home/personal/update',['mm'=>$mm]);
    }

    public function postAdupdate(Request $request)
    {
        
        $data = $request->except('_token');
        if($data['s_province']=='省份'){
            return back()->with('message','请选择所属省份');
       }else{
            if($data['s_city']=='地级市'){
                 return back()->with('message','请选择所属市');
            }else{
                 if($data['s_county']=='市、县级市'){
                     return back()->with('message','请选择所属区域');
                 }else{
                     $info = DB::table('vipical')->where('id',$data['id'])->update($data);
                     return redirect('home/personal/address')->with('message', '修改成功!');
                 }
            }
       }
       

    }


     public function postSave(Request $request)
    {
       $data = $request->all();
       if($data['s_province']=='省份'){
            return back()->with('message','请选择所属省份');
       }else{
            if($data['s_city']=='地级市'){
                 return back()->with('message','请选择所属市');
            }else{
                 if($data['s_county']=='市、县级市'){
                     return back()->with('message','请选择所属区域');
                 }else{
                    $name = session('name');
                    $v = new v();
                    $list = $v->where('name',$name)->first();
                    $data['vid']=$list['id'];
                    // dd($data);
                    $vm = new vm();
                   $vm->create($data);
                   return back();
                 }
            }
       }

    }
   

    public function getCenter()
    {
        $v = new v();
        $c = new c();
        $name = session('name');
        $list = $v->where('name',$name)->first();
        $cc = $c->where('pid',$list['id'])->first();
        return view('home/personal/center',['list'=>$list,'cc'=>$cc]);
    }

    public function postUpd(Request $request)
    {
        $data = $request->except('_token');
        $info = DB::table('Vipce')->where('id',$data['id'])->update($data);
        return back()->with('message', '修改成功!');
    }
    public function getShou($id)
    {
      
       $list = DB::table('Indent')->where('id',$id)->first();
       $list['status'] =3;
       $data = DB::table('Indent')->where('id',$list['id'])->update($list);
       return redirect('home/personal/index');
    }


    public function getDelete($id)
    {
      
       $list = DB::table('Indent')->where('id',$id)->delete();
       return redirect('home/personal/index');
    }
}
