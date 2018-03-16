<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\admin\Pdo as p;
use App\Model\admin\Pdo_type as t;
use App\Model\admin\Pdo_attr as a;
use App\Model\admin\Pdo_value as v;
use App\Model\admin\Pdo_image as i;
use App\Model\admin\cart as c;
use App\Model\admin\vip as vp;
use App\Model\admin\viptalk as tt;
use App\Model\admin\indent as d;
use App\Model\admin\indent_pdo as o;
use App\Model\admin\Category as ss;
use DB;
class ShowController extends Controller
{
    /**
     * 加载页面
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex($id)
    {
        $listp = p::find($id);
        $type_id = $listp['type_id'];
        $listi = i::where(['pdo_id'=>$id,'status'=>1])->get();
        $listim = i::where(['pdo_id'=>$id,'status'=>2])->get();
        $lista = a::where('type_id',$type_id)->get();
        $listv = v::where('pdo_id',$id)->get();

        return view('home/index/show',['listp'=>$listp,'listi'=>$listi,'listim'=>$listim,"lista"=>$lista,'listv'=>$listv]);
        // return "111";
    }
     public function getTalk($id)
    {
        $listp = p::find($id);
        $type_id = $listp['type_id'];
        $listi = i::where(['pdo_id'=>$id,'status'=>1])->get();
        
        $lista = a::where('type_id',$type_id)->get();
        $listv = v::where('pdo_id',$id)->get();
        $listm = tt::where(['pdoid'=>$id,'status'=>1])->with("hui")->Paginate(5);;
      

        return view('home/index/talk',['listp'=>$listp,'listi'=>$listi,"lista"=>$lista,'listv'=>$listv,"listim"=>$listm]);
        // return "111";
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getChe($pid,$num)
    {
        if (!session()->get("name")) {
            return redirect('/home/login/index')->with('message','请登录');
        }
        $vid = vp::where('name',session()->get('name'))->first();
        $data['pdoid'] = $pid;
        $data['num'] = $num;
        $data['vid'] = $vid['id'];
        c::create($data);
        return redirect('home/shop/index');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMai($pid,$num)
    {
        if (!session()->get("name")) {
            return redirect('/home/login/index')->with('message','请登录');
        }
        $vid = vp::where('name',session()->get('name'))->first();
               $pdo = p::where('id',$pid)->first();
        $data['num'] = $num;
        $data['vid'] = $vid['id'];
        $much = ($num*$pdo['price']);
        // dd($much);
        $data['much'] = $much;
        d::create($data);

        $list = DB::table('indent')->where(['num' => $num,'much'=>$much,'vid'=>$vid['id'],'stat'=>2,'status'=>2])->first();
        $da = [];
        // dd($list['id']);
        $da['pnum'] = $num;
        $da['did'] = $list['id'];
        $da['pid'] = $pid;
        o::create($da);
        $c = new d();
         $c = new ss();
        $nav2 = $c->orderby('updated_at','desc')->where('pid',0)->get();
        $nav3 = DB::table('Category')->get();
        $nav4 = DB::table('Category')->get();

                    $listm = DB::table('indent')->where('id',$list['id'])->get();
                  
                    $bb = DB::table('vipical')->where(['vid'=>$listm[0]['vid'],'da'=>1])->first();
                    $ss = DB::table('vipical')->where('vid',$listm[0]['vid'])->get();
                    // echo"<pre>";
                    // print_r($listm);
                    return view('home/shop/much',['list'=>$listm,'bb'=>$bb,'nav2'=>$nav2,'nav3'=>$nav3,'nav4'=>$nav4,'ss'=>$ss]);
        
    }
    public function getTa($id)
    {
        $pdoid = $id;
        $arr = DB::table('pdo')->where('id',$pdoid)->first();
        return view('home/index/ta',['pdoid'=>$pdoid,'arr'=>$arr]);
    }
    public function postSave(Request $request)
    {
          $input = $request->except('_token');
          // dd($input);
          $vid = vp::where('name',session()->get('name'))->first();
          $data= [];
        $data['vid'] = $vid['id'];
        $data['pdoid'] = $input['id'];
        $data['text']=$input['text'];
        tt::create($data);
        return redirect('home/personal/index');
    }
}
