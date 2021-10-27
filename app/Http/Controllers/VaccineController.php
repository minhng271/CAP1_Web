<?php

namespace App\Http\Controllers;

use App\vaccine;
use Illuminate\Http\Request;

class VaccineController extends Controller
{
    function todayList(Request $request){
        session(['active' => 'today']);
        $keyword = '';
        if($request->input('keyword')){
            $keyword = $request->input('keyword');
        }
        $vaccines = vaccine::where('name','like','%'.$keyword.'%')->paginate(8);
        return view('vaccine.today-list',compact('vaccines'));
    }

    function done_vaccine($id){
        $name = vaccine::find($id)->name;
        vaccine::find($id)->delete();
        return redirect()->route('today-list')->with('done_vaccine',$name);
    }

    function delete_vaccine($id){
        $name = vaccine::find($id)->name;
        vaccine::find($id)->delete();
        return redirect('vaccine/tiem-hom-nay')->with('delete_vaccine',$name);
    }

    function result(Request $request){
        $list_id = $request->input('check');
        $list_result = $request->input('result');
        foreach ($list_id as $item) {
            vaccine::where('id',$item)->update(['result'=>$list_result[$item]]);
        }
        return redirect('vaccine/danh-sach-cho')->with('status','Đã Xác Nhận thành công!!!');
    }

    //DS theo lịch
    function list_to_calander(Request $request){

        $created_at = date("Y-m-d", strtotime($request->input('created_at')));

        $vaccines = vaccine::where('created_at',$created_at)->paginate(8);
        return view('vaccine.list-to-calander',compact('vaccines'));
    }
}
