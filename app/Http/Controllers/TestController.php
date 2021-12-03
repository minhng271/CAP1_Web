<?php

namespace App\Http\Controllers;

use App\hospital;
use App\limit_web_mobile;
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

    function dashboard()
    {
        session(['active' => 'dashboard']);

        // tổng đã xét nghiệm hôm qua
        $sum_count_now = test_patient::whereNotNull('result')->where('date', date('Y-m-d'))->get()->count();
        $sum_count_now_old = test_patient::whereNotNull('result')->where('date', date('Y-m-d', strtotime('-1 days')))->get()->count();
        if ($sum_count_now == 0) {
            $ratio_sum_count_now = 0;
        } else {
            if ($sum_count_now_old == 0) {
                $ratio_sum_count_now = 100;
            } else {
                $ratio_sum_count_now = round($sum_count_now * 100 / $sum_count_now_old - 100,2);
            }
        }

        // tổng đã xét nghiệm trong tháng   
        $sum_test_done = test_patient::whereNotNull('result')->whereBetween('date', [date('Y-m-01'), date('Y-m-t')])->get()->count();
        $sum_test_done_old = test_patient::whereNotNull('result')->whereBetween('date', [date('Y-m-01', strtotime('-1 month')), date('Y-m-t', strtotime('-1 month'))])->get()->count();
        if ($sum_test_done == 0) {
            $ratio_sum_test_done = 0;
        } else {
            if ($sum_test_done_old == 0) {
                $ratio_sum_test_done = 100;
            } else {
                $ratio_sum_test_done = round($sum_test_done * 100 / $sum_test_done_old - 100,2);
            }
        }

        // tổng âm tính 
        $sum_negative = test_patient::where('result', '0')->whereBetween('date', [date('Y-m-01'), date('Y-m-t')])->get()->count();
        $sum_negative_old = test_patient::where('result', '0')->whereBetween('date', [date('Y-m-01', strtotime('-1 month')), date('Y-m-t', strtotime('-1 month'))])->get()->count();
        if ($sum_negative == 0) {
            $ratio_sum_negative = 0;
        } else {
            if ($sum_negative_old == 0) {
                $ratio_sum_negative = 100;
            } else {
                $ratio_sum_negative = round($sum_negative * 100 / $sum_negative_old - 100,2);
            }
        }
        // tổng dương tính 
        $sum_positive = test_patient::where('result', '1')->whereBetween('date', [date('Y-m-01'), date('Y-m-t')])->get()->count();
        $sum_positive_old = test_patient::where('result', '1')->whereBetween('date', [date('Y-m-01', strtotime('-1 month')), date('Y-m-t', strtotime('-1 month'))])->get()->count();
        if($sum_positive == 0){
            $ratio_sum_positive = 0;
        }else{
            if ($sum_positive_old == 0) {
                $ratio_sum_positive = 100;
            } else {
                $ratio_sum_positive = round($sum_positive * 100 / $sum_positive_old - 100,2);
            }
        }

        $sum_count = test_patient::selectRaw('Month(date) as month,count(*) as count')
        ->whereYear('date',date('Y'))
        ->whereNotNull('result')
        ->groupByRaw('Month(date)')->pluck('count');
        
        $sum_month = test_patient::selectRaw('Month(date) as month,count(*) as count')
        ->whereYear('date',date('Y'))
        ->whereNotNull('result')
        ->groupByRaw('Month(date)')->pluck('month');

        $data = ['0','0','0','0','0','0','0','0','0','0','0','0'];
        foreach ($sum_month as $index => $month) {
            $month--;
            $data[$month] = $sum_count[$index];
        }
        
        $sum_count_am = test_patient::selectRaw('Month(date) as month,count(*) as count')
        ->whereYear('date',date('Y'))
        ->where('result','0')
        ->groupByRaw('Month(date)')->pluck('count');
        
        $sum_month_am = test_patient::selectRaw('Month(date) as month,count(*) as count')
        ->whereYear('date',date('Y'))
        ->where('result','0')
        ->groupByRaw('Month(date)')->pluck('month');

        $data2 = ['0','0','0','0','0','0','0','0','0','0','0','0'];
        foreach ($sum_month_am as $index => $month) {
            $month--;
            $data2[$month] = $sum_count_am[$index];
        }
        
        $sum_count_duong = test_patient::selectRaw('Month(date) as month,count(*) as count')
        ->whereYear('date',date('Y'))
        ->where('result','1')
        ->groupByRaw('Month(date)')->pluck('count');
        
        $sum_month_duong = test_patient::selectRaw('Month(date) as month,count(*) as count')
        ->whereYear('date',date('Y'))
        ->where('result','1')
        ->groupByRaw('Month(date)')->pluck('month');

        $data3 = ['0','0','0','0','0','0','0','0','0','0','0','0'];
        foreach ($sum_month_duong as $index => $month) {
            $month--;
            $data3[$month] = $sum_count_duong[$index];
        }

        return view('test.dashboard', compact(
            'sum_count_now',
            'ratio_sum_count_now',
            'sum_test_done',
            'ratio_sum_test_done',
            'sum_negative',
            'ratio_sum_negative',
            'sum_positive',
            'ratio_sum_positive',
            'data',
            'data2',
            'data3',
        ));
    }

    function limit(){
        session(['active'=>'limit']);      
        $limit = 0;
        if(limit_web_mobile::find(1)->limit_test){
            $limit = limit_web_mobile::find(1)->limit_test;
        }
        return view('test.limit',compact('limit'));
    }

    function edit_limit(){
        session(['active'=>'limit']);      
        $limit = 0;
        if(limit_web_mobile::find(1)->limit_test){
            $limit = limit_web_mobile::find(1)->limit_test;
        }
        return view('test.edit_limit',compact('limit'));
    }
    function store_edit_limit(Request $request){
        if($request->input('submit')){
            limit_web_mobile::find(1)->update([
                'limit_test' => $request->limit
            ]);
            return redirect('test/limit')->with('limit','Thay Đổi Giới Hạn Đăng Ký Thành Công');
        }  
        return view('test.edit_limit',compact('limit'));    
        
    }

    function profile(){
        $hospital = hospital::select('hospitals.*','users.email')
        ->join('users','hospitals.id_user','users.id')
        ->where('users.id',Auth::id())->first();
        return view('test.profile',compact('hospital'));
    }
    function edit_profile(){
        $hospital = hospital::select('hospitals.*','users.email')
        ->join('users','hospitals.id_user','users.id')
        ->where('users.id',Auth::id())->first();
        return view('test.edit_profile',compact('hospital'));
    }

    function store_edit_profile(Request $request){
        $request->validate(
            [
                'name' => ['required'],
                'phone' => ['required'],
                'address' => ['required'],
            ],
            [
                'required' => ':attribute không được để trống'
            ],
            [
                'name' => 'Tên Bệnh Viện',
                'phone' => 'Số Điện Thoại',
                'address' => 'Địa Chỉ',
            ]
        );
        hospital::where('id_user',Auth::id())->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        return redirect('test/profile')->with('success','CẬP NHẬT THÔNG TIN BỆNH VIỆN THÀNH CÔNG');
    }

    function todayList(Request $request)
    {
        session(['active' => 'today']);
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }

        $patients = test_patient::select('patients.*', 'test_patient.*')
            ->join('patients', 'test_patient.id_card', 'patients.id_card')
            ->join('hospitals', 'test_patient.id_hos', 'hospitals.id')
            ->where('test_patient.id_hos', Auth::user()->hospital->id)
            ->where('test_patient.wait_at', '0')
            ->where('date', date('Y-m-d'))
            ->where('patients.fullname', 'like', '%' . $keyword . '%')->paginate(8);
        // echo "<pre>";
        // print_r($patients);
        return view('test.today-list', compact('patients'));
    }

    function softDeleteList(Request $request)
    {
        session(['active' => 'softDeleteList']);
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $patients = test_patient::onlyTrashed()->select('patients.*', 'test_patient.*')
            ->join('patients', 'test_patient.id_card', 'patients.id_card')
            ->join('hospitals', 'test_patient.id_hos', 'hospitals.id')
            ->where('test_patient.id_hos', Auth::user()->hospital->id)
            ->where('test_patient.wait_at', '0')
            ->where('date', date('Y-m-d'))
            ->where('patients.fullname', 'like', '%' . $keyword . '%')->paginate(8);
        // echo "<pre>";
        // print_r($patients);
        return view('test.softDelete-list', compact('patients'));
    }
    function done_patient($id_card)
    {
        test_patient::where('id_card', $id_card)->update(['wait_at' => '1']);
        $fullname = patient::where('id_card', $id_card)->first()->fullname;
        return redirect('test/xet-nghiem-hom-nay')->with('done_patient', $fullname);
    }

    function restore_patient($id_card)
    {
        test_patient::onlyTrashed()->where('id_card', $id_card)->restore();
        $fullname = patient::where('id_card', $id_card)->first()->fullname;
        return redirect('test/danh-sach-xoa-tam')->with('restore_patient', $fullname);
    }

    function delete_patient($id_card)
    {
        $fullname = patient::where('id_card', $id_card)->first()->fullname;
        test_patient::where('id_card', $id_card)->delete();
        return redirect('test/xet-nghiem-hom-nay')->with('delete_patient', $fullname);
    }

    function delete_patient_softDelete($id_card)
    {
        $fullname = patient::where('id_card', $id_card)->first()->fullname;
        test_patient::onlyTrashed()->where('id_card', $id_card)->forceDelete();
        return redirect('test/danh-sach-xoa-tam')->with('delete_patient', $fullname);
    }

    function waitList(Request $request)
    {
        session(['active' => 'wait']);
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $patients = test_patient::select('patients.*', 'test_patient.*')
            ->join('patients', 'test_patient.id_card', 'patients.id_card')
            ->join('hospitals', 'test_patient.id_hos', 'hospitals.id')
            ->where('test_patient.id_hos', Auth::user()->hospital->id)
            ->where('test_patient.wait_at', '1')->whereNull('result')
            ->where('date', date('Y-m-d'))
            ->where('patients.fullname', 'like', '%' . $keyword . '%')->paginate(8);
        return view('test.wait-list', compact('patients'));
    }

    function result(Request $request)
    {
        $list_id = $request->input('check');
        $list_result = $request->input('result');
        foreach ($list_id as $item) {
            test_patient::where('id_card', $item)->update(['result' => $list_result[$item]]);
        }
        return redirect('test/danh-sach-cho')->with('status', 'Đã Xác Nhận thành công!!!');
    }

    //DS theo lịch
    function list_to_calander(Request $request)
    {
        session(['active' => 'list_to_calander']);
        $created_at = date("Y-m-d", strtotime($request->input('created_at')));
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }

       
        $patients = test_patient::select('patients.*', 'test_patient.*')
            ->join('patients', 'test_patient.id_card', 'patients.id_card')
            ->join('hospitals', 'test_patient.id_hos', 'hospitals.id')
            ->where('test_patient.id_hos', Auth::user()->hospital->id)
            ->where('test_patient.date', $created_at)
            ->where('patients.fullname', 'like', '%' . $keyword . '%')->paginate(8);
        // echo "<pre>";
        // print_r($patients);
        return view('test.list-to-calander', compact('patients'));
    }
}
