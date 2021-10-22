<?php

namespace App\Http\Controllers;

use App\patient;
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
        $patients = vaccine::where('wait_at','0')->where('name','like','%'.$keyword.'%')->paginate(8);
        return view('vaccine.today-list',compact('patients'));
    }

    // function done_patient($id){
    //     $name = patient::find($id)->name;
    //     patient::where('id',$id)->update(['wait_at'=>'1']);
    //     return redirect()->route('today-list')->with('done_patient',$name);
    // }

    // function delete_patient($id){
    //     $name = patient::find($id)->name;
    //     patient::find($id)->delete();
    //     return redirect('vaccine/tiem-hom-nay')->with('delete_patient',$name);
    // }

    // function waitList(Request $request){
    //     session(['active' => 'wait']);
    //     $keyword = '';
    //     if($request->input('keyword')){
    //         $keyword = $request->input('keyword');
    //     }
    //     $patients = patient::where('wait_at','1')->whereNull('result')->where('name','like','%'.$keyword.'%')->paginate(8);
    //     return view('vaccine.wait-list',compact('patients'));
    // }

    // function result(Request $request){
    //     $list_id = $request->input('check');
    //     $list_result = $request->input('result');
    //     foreach ($list_id as $item) {
    //         patient::where('id',$item)->update(['result'=>$list_result[$item]]);
    //     }
    //     return redirect('vaccine/danh-sach-cho')->with('status','Đã Xác Nhận thành công!!!');
    // }
}
