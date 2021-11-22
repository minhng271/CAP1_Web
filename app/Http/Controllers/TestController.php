<?php

namespace App\Http\Controllers;

use App\patient;
use App\test;
use App\test_patient;
use App\vaccine_patient;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Json;

class TestController extends Controller
{

    function dashboard(){
        session(['active' => 'dashboard']);
        // return round(4/6,3);
        $count_yesterday = test_patient::whereNotNull('result')->where('date',date('Y-m-d',strtotime('-1 days')))->get()->count();     
            if(test_patient::whereNotNull('result')->whereBetween('date',['2000-01-01',date('Y-m-d',strtotime('-2 days'))])->get()->count() == 0){
                 $ratio_yesterday = 100;
            }else{
                 $ratio_yesterday = round($count_yesterday*100/test_patient::whereNotNull('result')->whereBetween('date',['2000-01-01',date('Y-m-d',strtotime('-2 days'))])->get()->count()-100);
            }
        $sum_count = test_patient::whereNotNull('result')->get()->count();
            if(test_patient::whereNotNull('result')->whereBetween('date',['2000-01-01',date('Y-m-d',strtotime('-1 days'))])->get()->count() == 0){
                 $ratio_sum_count = 100;
            }else{
                 $ratio_sum_count = round($sum_count*100/test_patient::whereNotNull('result')->whereBetween('date',['2000-01-01',date('Y-m-d',strtotime('-1 days'))])->get()->count()-100);
            }
        $negative = test_patient::where('result','0')->get()->count();
            if(test_patient::where('result','0')->whereBetween('date',['2000-01-01',date('Y-m-d',strtotime('-1 days'))])->get()->count() == 0){
                 $ratio_negative = 100;
            }else{
                 $ratio_negative = round($negative*100/test_patient::whereNotNull('result')->whereBetween('date',['2000-01-01',date('Y-m-d',strtotime('-1 days'))])->get()->count()-100);
            }
        $positive = test_patient::where('result','1')->get()->count();
            if(test_patient::where('result','1')->whereBetween('date',['2000-01-01',date('Y-m-d',strtotime('-1 days'))])->get()->count() == 0){
                 $ratio_positive = 100;
            }else{
                 $ratio_positive = round($positive*100/test_patient::whereNotNull('result')->whereBetween('date',['2000-01-01',date('Y-m-d',strtotime('-1 days'))])->get()->count()-100);
            }

        return view('test.dashboard',compact('count_yesterday','sum_count','negative','positive','ratio_yesterday','ratio_sum_count','ratio_negative','ratio_positive'));
    }

    function todayList(Request $request){
        session(['active' => 'today']);
        $keyword = '';
        if($request->input('keyword')){
            $keyword = $request->input('keyword');
        }    
        
        $patients = test_patient::select('patients.*','test_patient.*')
        ->join('patients','test_patient.id_card','patients.id_card')
        ->join('hospitals','test_patient.id_hos','hospitals.id')
        ->where('test_patient.id_hos',Auth::user()->hospital->id)
        ->where('test_patient.wait_at','0')
        ->where('date',date('Y-m-d'))
        ->where('patients.fullname','like','%'.$keyword.'%')->paginate(8);
        // echo "<pre>";
        // print_r($patients);
        return view('test.today-list',compact('patients'));
    }

    function softDeleteList(Request $request){
        session(['active' => 'softDeleteList']);
        $keyword = '';
        if($request->input('keyword')){
            $keyword = $request->input('keyword');
        }          
        $patients = test_patient::onlyTrashed()->select('patients.*','test_patient.*')
        ->join('patients','test_patient.id_card','patients.id_card')
        ->join('hospitals','test_patient.id_hos','hospitals.id')
        ->where('test_patient.id_hos',Auth::user()->hospital->id)
        ->where('test_patient.wait_at','0')
        ->where('date',date('Y-m-d'))
        ->where('patients.fullname','like','%'.$keyword.'%')->paginate(8);
        // echo "<pre>";
        // print_r($patients);
        return view('test.softDelete-list',compact('patients'));
    }
    function done_patient($id_card){
        test_patient::where('id_card',$id_card)->update(['wait_at'=>'1']);       
        $fullname = patient::where('id_card',$id_card)->first()->fullname;
        return redirect('test/xet-nghiem-hom-nay')->with('done_patient',$fullname);
    }
    
    function restore_patient($id_card){
        test_patient::onlyTrashed()->where('id_card',$id_card)->restore();       
        $fullname = patient::where('id_card',$id_card)->first()->fullname;
        return redirect('test/danh-sach-xoa-tam')->with('restore_patient',$fullname);
    }

    function delete_patient($id_card){  
        $fullname = patient::where('id_card',$id_card)->first()->fullname;
        test_patient::where('id_card',$id_card)->delete();
        return redirect('test/xet-nghiem-hom-nay')->with('delete_patient',$fullname);
    }

    function delete_patient_softDelete($id_card){  
        $fullname = patient::where('id_card',$id_card)->first()->fullname;
        test_patient::onlyTrashed()->where('id_card',$id_card)->forceDelete();
        return redirect('test/danh-sach-xoa-tam')->with('delete_patient',$fullname);
    }

    function waitList(Request $request){
        session(['active' => 'wait']);
        $keyword = '';
        if($request->input('keyword')){
            $keyword = $request->input('keyword');
        }
        $patients = test_patient::select('patients.*','test_patient.*')
        ->join('patients','test_patient.id_card','patients.id_card')
        ->join('hospitals','test_patient.id_hos','hospitals.id')
        ->where('test_patient.id_hos',Auth::user()->hospital->id)
        ->where('test_patient.wait_at','1')->whereNull('result')
        ->where('date',date('Y-m-d'))
        ->where('patients.fullname','like','%'.$keyword.'%')->paginate(8);
        return view('test.wait-list',compact('patients'));
    }

    function result(Request $request){
        $list_id = $request->input('check');
        $list_result = $request->input('result');
        foreach ($list_id as $item) {
            test_patient::where('id_card',$item)->update(['result'=>$list_result[$item]]);
        }
        return redirect('test/danh-sach-cho')->with('status','Đã Xác Nhận thành công!!!');
    }

    //DS theo lịch
    function list_to_calander(Request $request){
        session(['active' => 'list_to_calander']);
        $created_at = date("Y-m-d", strtotime($request->input('created_at')));
        $keyword = '';
        if($request->input('keyword')){
            $keyword = $request->input('keyword');
        }
        
        $patients = test_patient::select('patients.*','test_patient.*')
        ->join('patients','test_patient.id_card','patients.id_card')
        ->join('hospitals','test_patient.id_hos','hospitals.id')
        ->where('test_patient.id_hos',Auth::user()->hospital->id)
        ->where('date',$created_at)
        ->where('patients.fullname','like','%'.$keyword.'%')->paginate(8);
        
        return view('test.list-to-calander',compact('patients'));
    }
}
