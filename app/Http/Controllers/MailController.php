<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send()
    {
            $name = 'lzh';  
            $flag = Mail::send('mail',['user'=>$name],function($message){  
            $to = '15234367047m@sina.cn';  //收件人
            $message ->to($to)->subject('测试邮件');  //subject 是邮件标题
        });  
        if($flag){  
            echo '发送邮件成功，请查收！';  
        }else{  
            echo '发送邮件失败，请重试！';  
        }  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sms()
    {
        $resa = sendTemplateSMS('15234367047',array("8888","123"),1);
      //echo $_POST['tel'];
      if($resa)
      {
          echo "y";
      }
      else
      {
          echo "n";
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function yan()
    {
        return view('yan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
