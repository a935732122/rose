<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ThinkClass\UploadClass;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
       return view('add');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postInsert(Request $request)
    {   $filepath="./uploads/";
         //1.首先检查文件是否存在
    if ($request->hasFile('pic')){
    //2.获取文件
    $file = $request->file('pic');
    //3.其次检查图片手否合法
    if ($file->isValid()){
// 先得到文件后缀,然后将后缀转换成小写,然后看是否在否和图片的数组内
            if(in_array( strtolower($file->getClientOriginalExtension()),['jpeg','jpg','gif','gpeg','png'])){
                //4.将文件取一个新的名字
                $newName = 'img'.time().rand(100000, 999999).$file->getClientOriginalName();
                //5.移动文件,并修改名字
                if($file->move($filepath,$newName)){
                    return $filepath.$newName;   //返回一个地址
                }else{
                    return 4;
                }
            }else{
                return 3;
            }

        }else{
            return 2;
        }
    }else{
        return 1;
    }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
