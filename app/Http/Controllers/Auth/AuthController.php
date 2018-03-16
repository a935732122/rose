<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    // use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = '/admin/index';
    protected $loginPath = '/auth/login';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logOut']);
    }
    //加载登陆页面
    public function login()
    {
        // echo "11";
        return view('auth.login');
    }
     //加载添加页面
    public function add()
    {
        return view('auth.add');
    }

    //验证
    public function doLogin(Request $request)
    {
        $data = $request->all();

        $this->validate($request,
        [
            'email'=>'required',
            'password'=>'required',
            'captcha'=>'required|captcha'
        ],
        [
            'email.required'=>'邮箱必填',
            'password.required'=>'密码必填',
            'captcha.required'=>'验证码必填',
            'captcha.captcha'=>'验证码错误',
            
        ]
        );//自定义验证规则

        //验证账号
        if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']]))
        {
            session()->put('email',$data['email']);
            return redirect($this->redirectPath);
        }else
        {
            return redirect($this->loginPath)->with('message','登陆失败,密码或者账号错误');
        }
    }

    //推出
    public function logOut()
    {
        Auth::logout();
        return redirect($this->redirectPath);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ],[
            'email.required'=>'邮箱必填',
            'email.max'=>'邮箱过长',
            'email.unique'=>'邮箱已使用',
        ]);
    }

    public function reg(Request $request)
    {
        $this->create($request->all());
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
