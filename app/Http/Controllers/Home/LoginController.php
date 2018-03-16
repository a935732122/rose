<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Model\admin\vip as b;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Model\admin\Category as c;
use App\Model\admin\vipce as cs;


use Validator;
use App\User;
class LoginController extends Controller
{
   public function getIndex(){
    
    return view('home/login/login');
   }
   public function postDologin(Request $request){

     $input = $request->except('_token');
     $input['pass']=md5($input['pass']);
   
        $this->validate($request,
        [
            'name'=>'required',
            'pass'=>'required',
            
        ],
        [
            'name.required'=>'用户名必填',
            'pass.required'=>'密码必填',
            
            
        ]
        );//自定义验证规则

      $list = DB::table('vip')->where('name',$input['name'])->first();
      if ($list['status']==2) {
         return redirect()->back()->with('message','已被禁用');
      }
      if ($list['pass']==$input['pass']) {
      session()->put('name',$list['name']);
        return redirect('/home/index');
      }else{
        return redirect()->back()->with('message','账号或密码错误');
      }
   }
   public function getAdd(){
    $c = new C();
        $cc = $c->orderby('updated_at','desc')->where('pid',0)->get();
        $dd = DB::table('Category')->get();
        $vv = DB::table('Category')->get();

    return view('home/login/add',['cc'=>$cc,'dd'=>$dd,'vv'=>$vv]);
   }
   public function postSave(Request $request){
    $this->validate($request,
               [
                    'name'=>'required',
                    'pass'=>'required',
                    'email'=>'required',
                    'phone'=>'required',
                    'captcha'=>'required',
                    'captcha'=>'captcha',

               ],
                [
            'name.required'=>'用户名必填',
            'pass.required'=>'密码必填',
            'email.required'=>'邮箱必填',
            'phone.required'=>'邮箱必填',
            'captcha.required'=>'验证码必填',
            'captcha.captcha'=>'验证码错误', 
        ]
            );
      
        // dd($request);
        $input = $request->except('_token');
        // dd($input);
        $input['pass']=md5($input['pass']);
        // dd($input);
  //       if (!captcha_check($input['captcha'])) {
    //  return  redirect('/home/login/add')->with('message','验证码错误');
    // }
        $list = DB::table('vip')->where('name',$input['name'])->first();
        $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        if (!preg_match( $pattern, $input['email'] )) {
            return redirect('/home/login/index')->with('message','邮箱格式错误');
           }else{
        if (strlen($input['phone']) == "11") {
          //上面部分判断长度是不是11位
         
          $n = preg_match_all("/13[123569]{1}\d{8}|15[1235689]\d{8}|188\d{8}/", $input['phone'],$array);
          /*接下来的正则表达式("/131,132,133,135,136,139开头随后跟着任意的8为数字 '|'(或者的意思)
           * 151,152,153,156,158.159开头的跟着任意的8为数字
           * 或者是188开头的再跟着任意的8为数字,匹配其中的任意一组就通过了
           * /")*/
          //看看是不是找到了,如果找到了,就会输出电话号码的
            if ($n) {
              // dd($array[0][0]);
              // 
              if ($list) {
                  return redirect('/home/login/add')->with('message','用户名重复');
                 }else{
                    $permission = new b;

                    $mmms = $permission->create($input);
                    $data['pid'] = $mmms['id'];
                    $cs = new cs();
                    $cs->create($data);
                   if($mmms)
                   {
                    return redirect('/home/login/index')->with('message','注册成功');
                   }
                   else
                   {
                    return redirect()->back()->withError('注册失败');
                   }
                 }
            }else{
               return redirect('/home/login/add')->with('message','请填写正确的手机号');
            }
          
        } else {
         return redirect('/home/login/add')->with('message','手机好必须为11位');
        }

           }
   }
   public function getEdit()
   {  $c = new C();
        $cc = $c->orderby('updated_at','desc')->where('pid',0)->get();
        $dd = DB::table('Category')->get();
        $vv = DB::table('Category')->get();
    return view('home/login/edit',['cc'=>$cc,'dd'=>$dd,'vv'=>$vv]);
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSms()
    {
      $num = rand(1111,9999);
        $resa = sendTemplateSMS('13935919355',array($num,"123"),1);
      //echo $_POST['tel'];
      if($resa)
      {
          return $num;
      }
      else
      {
          return $num;
      }
    }
    public function postUpdate(Request $request)
    {
      $input = $request->except('_token');
      // dd($input);
      if ($input['pass']==$input['apass']) {
        if ($input['phc']==$input['captcha']){
          unset($input['phc']);
          unset($input['captcha']);
          unset($input['apass']);
          $input['pass']=md5($input['pass']);
            $info = DB::table('vip')->where('name',$input['name'])->update($input);
            if ($info) {
              return redirect('/home/login/index')->with('message','修改成功');
            }else{
              return required()->back()->with('message','用户名错误');
            }
        }else{
          return required()->back()->with('message','验证码错误');
        }
      }else{
        return required()->back()->with('message','两次的密码不一致');
      }
    }
      public function getOutlogin(){
        session()->forget('name');
       return redirect('home/login/index')->with('message',"退出成功!");
    }

}