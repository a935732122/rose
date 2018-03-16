<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\admin\Pdo as b;
use App\Model\admin\Category as c;



use DB;
class ListController extends Controller
{
	public function getIndex($id){
		$data = c::find($id);
		if ($data->getOriginal('pid')==0) {
			$ids = c::where('pid',$data['id'])->get();
			$im = c::where('pid',$data['id'])->first();
			if($im){
				foreach ($ids as $k => $v) {
					$li[] = c::where('pid',$v['id'])->get();
				}
				foreach ($li as $v) {
					foreach ($v as $al) {
						$cc[] = $al['id'];
					}	
				}

				$m = new b;
				foreach ($cc as $au) {
					$list[] = $m->orderby('id','desc')->where(['status'=>1,'cateid'=>$au])->Paginate(12);
				}
				// dd($list);
				return view('home/list/index',['list'=>$list,'id'=>$id]);
			}else{
				$ims = c::where('id',$id)->first();
				if($ims['name']=="专卖店"){
					return redirect("home/dian/index");
				}elseif($ims['name']=="诺誓世界"){
					return redirect('home/nsyj/index');
				}elseif($ims['name']=="高端定制"){
					return view('home/gddz/gddz');
				}
			}
		}
		$m = new b;
		$list = $m->orderby('id','desc')->where(['status'=>1,'cateid'=>$id])->Paginate(12);
		return view('home/list/show',['list'=>$list]);
	}








	public function getNew($id){
		$data = c::find($id);
		if ($data->getOriginal('pid')==0) {
			$ids = c::where('pid',$data['id'])->get();
			foreach ($ids as $k => $v) {
				$li[] = c::where('pid',$v['id'])->get();
			}
			// dd($li);
			foreach ($li as $v) {
				foreach ($v as $al) {
					$cc[] = $al['id'];
				}	
			}

			$m = new b;
			foreach ($cc as $au) {
				$list[] = $m->orderby('created_at','desc')->where(['status'=>1,'cateid'=>$au])->Paginate(12);
			}
			// dd($list);
			return view('home/list/index',['list'=>$list,'id'=>$id]);
		}

		$m = new b;
		$list = $m->orderby('created_at','desc')->where(['status'=>1,'cateid'=>$id])->Paginate(12);
		return view('home/list/show',['list'=>$list]);
	}
	public function getPrice($id){

			$data = c::find($id);
		if ($data->getOriginal('pid')==0) {
			$ids = c::where('pid',$data['id'])->get();
			foreach ($ids as $k => $v) {
				$li[] = c::where('pid',$v['id'])->get();
			}
			// dd($li);
			foreach ($li as $v) {
				foreach ($v as $al) {
					$cc[] = $al['id'];
				}	
			}

			$m = new b;
			foreach ($cc as $au) {
				$list[] = $m->orderby('price','desc')->where(['status'=>1,'cateid'=>$au])->Paginate(12);
			}
			// dd($list);
			return view('home/list/index',['list'=>$list,'id'=>$id]);
		}


			$m = new b;
				$list = $m->orderby('price','desc')->where(['status'=>1,'cateid'=>$id])->Paginate(12);
				
				return view('home/list/show',['list'=>$list]);
	}



	public function getPrice1($id){

			$data = c::find($id);
		if ($data->getOriginal('pid')==0) {
			$ids = c::where('pid',$data['id'])->get();
			foreach ($ids as $k => $v) {
				$li[] = c::where('pid',$v['id'])->get();
			}
			// dd($li);
			foreach ($li as $v) {
				foreach ($v as $al) {
					$cc[] = $al['id'];
				}	
			}

			$m = new b;
			foreach ($cc as $au) {
				$list[] = $m->orderby('price','asc')->where(['status'=>1,'cateid'=>$au])->Paginate(12);
			}
			// dd($list);
			return view('home/list/index',['list'=>$list,'id'=>$id]);
		}

		
			$m = new b;
				$list = $m->orderby('price','asc')->where(['status'=>1,'cateid'=>$id])->Paginate(12);
				
				return view('home/list/show',['list'=>$list]);
	}
	/*
	*综合
	*
	 */
	public function getIndex1($id){
		$data = c::find($id);
		if ($data->getOriginal('pid')==0) {
			$ids = c::where('pid',$data['id'])->get();
			foreach ($ids as $k => $v) {
				$li[] = c::where('pid',$v['id'])->get();
			}
			// dd($li);
			foreach ($li as $v) {
				foreach ($v as $al) {
					$cc[] = $al['id'];
				}	
			}

			$m = new b;
			foreach ($cc as $au) {
				$list[] = $m->orderby('id','desc')->where(['status'=>1,'cateid'=>$au])->Paginate(12);
			}
			// dd($list);
			return view('home/list/index',['list'=>$list,'id'=>$id]);
		}
		
			$m = new b;
				$list = $m->orderby('id','desc')->where(['status'=>1,'cateid'=>$id])->Paginate(12);
				
				return view('home/list/show',['list'=>$list]);
	}
	public function getSousuo(Request $request){
		$data = [];
        $where= [];

        if (!empty($request->only('name'))) {
            $data=$request->only('name');
       
        }
        $m = new b;
        $num = $m->count();
        if ($num==0) {
        	return redirect()->back()->withError('ss','没有该商品');
        }
        $list = $m->orderby('updated_at','desc')->where('name','like','%'.$data['name'].'%')->Paginate(12);

         return view('home/list/sousuo',['list'=>$list,'search'=>$data]);
	}

}