<?php

namespace App\Http\Controllers;

use App\disease;
use App\hospital;
use App\test_patient;
use App\vaccine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VaccineController extends Controller
{
    function dashboard()
    {
        session(['active' => 'dashboard']);
        // return round(4/6,3);
        $count_yesterday = test_patient::whereNotNull('result')->where('date', date('Y-m-d', strtotime('-1 days')))->get()->count();
        if (test_patient::whereNotNull('result')->whereBetween('date', ['2000-01-01', date('Y-m-d', strtotime('-2 days'))])->get()->count() == 0) {
            $ratio_yesterday = 100;
        } else {
            $ratio_yesterday = round($count_yesterday * 100 / test_patient::whereNotNull('result')->whereBetween('date', ['2000-01-01', date('Y-m-d', strtotime('-2 days'))])->get()->count() - 100);
        }
        $sum_count = test_patient::whereNotNull('result')->get()->count();
        if (test_patient::whereNotNull('result')->whereBetween('date', ['2000-01-01', date('Y-m-d', strtotime('-1 days'))])->get()->count() == 0) {
            $ratio_sum_count = 100;
        } else {
            $ratio_sum_count = round($sum_count * 100 / test_patient::whereNotNull('result')->whereBetween('date', ['2000-01-01', date('Y-m-d', strtotime('-1 days'))])->get()->count() - 100);
        }
        $negative = test_patient::where('result', '0')->get()->count();
        if (test_patient::where('result', '0')->whereBetween('date', ['2000-01-01', date('Y-m-d', strtotime('-1 days'))])->get()->count() == 0) {
            $ratio_negative = 100;
        } else {
            $ratio_negative = round($negative * 100 / test_patient::whereNotNull('result')->whereBetween('date', ['2000-01-01', date('Y-m-d', strtotime('-1 days'))])->get()->count() - 100);
        }
        $positive = test_patient::where('result', '1')->get()->count();
        if (test_patient::where('result', '1')->whereBetween('date', ['2000-01-01', date('Y-m-d', strtotime('-1 days'))])->get()->count() == 0) {
            $ratio_positive = 100;
        } else {
            $ratio_positive = round($positive * 100 / test_patient::whereNotNull('result')->whereBetween('date', ['2000-01-01', date('Y-m-d', strtotime('-1 days'))])->get()->count() - 100);
        }

        return view('test.dashboard', compact('count_yesterday', 'sum_count', 'negative', 'positive', 'ratio_yesterday', 'ratio_sum_count', 'ratio_negative', 'ratio_positive'));
    }


    // VACCINE

    function vaccine_list(Request $request){
        session(['active' => 'danh-sach-vaccine']);
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $vaccines = vaccine::select('vaccines.*','vaccine_hos.lot_number','vaccine_hos.quantity','vaccine_hos.date_of_manufacture','vaccine_hos.out_of_date')
        ->where('name', 'like', '%' . $keyword . '%')
        ->where('vaccine_hos.id_hos',hospital::where('id_user',Auth::user()->id)->first()->id)
        ->join('vaccine_hos','vaccines.id','vaccine_hos.id_vac')->paginate(8);
        return view('vaccine.vaccine_list',compact('vaccines'));
    }

    function edit_vaccine($id){
        $vaccines = vaccine::select('vaccines.*','diseases.name as diseases')
        ->leftJoin('diseases','vaccines.id','diseases.id_vac')->where('vaccines.id',$id)->first();
        $diseases = disease::all();
        return view('vaccine.vaccine_edit',compact('vaccines','diseases','id'));

    }
    
    function store_edit_vaccine(Request $request){
        if($request->input('submit')){
            $request->validate(
                [
                    'name' => ['required'],
                    'country' => ['required'],
                    'age_use_from' => ['required'],
                    'age_use_to' => ['required'],
                    'type_disease' => ['required'],
                    'description' => ['required'],
                ],
                [
                    'required' => ':attribute không được để trống'
                ],
                [
                    'name' => 'Tên Vắc Xin',
                    'country' => 'Quốc Gia',
                    'age_use_from' => 'Tuổi Dùng Từ',
                    'age_use_to' => 'Tuổi Dùng Đến',
                    'type_disease' => 'Loại Bệnh',
                    'description' => 'Mô Tả',
                ]
            );

            vaccine::where('id', $request->input('id'))->update(
                [
                    'name' => $request->input('name'),
                    'country' => $request->input('country'),
                    'description' => $request->input('description'),
                    'age_use_from' => $request->input('age_use_from'),
                    'age_use_to' => $request->input('age_use_to'),
                    
                ]
            );    
            disease::where('id_vac', $request->input('id'))->update(
                [
                    'id_vac' => $request->input('id'),
                    'name'   => $request->input('type_disease')
                ]
            );
        
            return redirect('vaccine/danh-sach-vaccine')->with('update_vaccine',$request->input('name'));
        }
    }

    function delete_vaccine($id){
        if(vaccine::find($id)){
            $name = vaccine::find($id)->name;
            vaccine::find($id)->delete();
            return redirect('vaccine/danh-sach-vaccine')->with('delete_vaccine', $name);
        } else{
            $name = vaccine::onlyTrashed()->where('id',$id)->first()->name;
            vaccine::onlyTrashed()->where('id',$id)->forceDelete();
            return redirect('vaccine/danh-sach-vaccine-da-xoa')->with('delete_vaccine', $name);
        }
    }

    function bin_vaccine(Request $request){
        session(['active' => 'danh-sach-vaccine-da-xoa']);
        $keyword = '';
        $vaccines = vaccine::select('vaccines.*','vaccine_hos.lot_number','vaccine_hos.quantity','vaccine_hos.date_of_manufacture','vaccine_hos.out_of_date')
        ->where('name', 'like', '%' . $keyword . '%')
        ->where('vaccine_hos.id_hos',hospital::where('id_user',Auth::user()->id)->first()->id)
        ->join('vaccine_hos','vaccines.id','vaccine_hos.id_vac')
        ->onlyTrashed()->paginate(8);
        return view('vaccine.bin-vaccine',compact('vaccines'));
    }

    function restore_bin_vaccine($id){
        $name = vaccine::onlyTrashed()->where('id',$id)->first()->name;
        vaccine::onlyTrashed()->where('id',$id)->restore();
        return redirect('vaccine/danh-sach-vaccine-da-xoa')->with('restore_vaccine', $name);
    }
    

    function vaccine_addnew()
    {
        $diseases = disease::selectRaw('count(id_vac) as number, name')->groupBy('name')->get();
        return view('vaccine.vaccine_addnew', compact('diseases'));
    }

    function store_addnew(Request $request)
    {
        if($request->input('submit')){
            $request->validate(
                [
                    'name' => ['required'],
                    'country' => ['required'],
                    'age_use_from' => ['required'],
                    'age_use_to' => ['required'],
                    'type_disease' => ['required'],
                    'description' => ['required'],
                ],
                [
                    'required' => ':attribute không được để trống'
                ],
                [
                    'name' => 'Tên Vắc Xin',
                    'country' => 'Quốc Gia',
                    'age_use_from' => 'Tuổi Dùng Từ',
                    'age_use_to' => 'Tuổi Dùng Đến',
                    'type_disease' => 'Loại Bệnh',
                    'description' => 'Mô Tả',
                ]
            );

            vaccine::create(
                [
                    'name' => $request->input('name'),
                    'country' => $request->input('country'),
                    'description' => $request->input('description'),
                    'age_use_from' => $request->input('age_use_from'),
                    'age_use_to' => $request->input('age_use_to'),
                    
                ]
            );    
            disease::create(
                [
                    'id_vac' => vaccine::where('name',$request->input('name'))->first()->id,
                    'name'   => $request->input('type_disease')
                ]
            );
        
            return redirect('vaccine/them-moi-vaccine')->with('nameVaccine',$request->input('name'));
        }
    }



    function vaccine_import()
    {
        return view('vaccine.vaccine_import');
    }


    // DANH SÁCH TIÊM CHÍCH
    function todayList(Request $request)
    {
        session(['active' => 'today']);
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $vaccines = vaccine::where('name', 'like', '%' . $keyword . '%')->paginate(8);
        return view('vaccine.today-list', compact('vaccines'));
    }

    function done_vaccine($id)
    {
        $name = vaccine::find($id)->name;
        vaccine::find($id)->delete();
        return redirect()->route('today-list')->with('done_vaccine', $name);
    }

    function delete_patient_vaccine($id)
    {
        $name = vaccine::find($id)->name;
        vaccine::find($id)->delete();
        return redirect('vaccine/tiem-hom-nay')->with('delete_vaccine', $name);
    }

    function result(Request $request)
    {
        $list_id = $request->input('check');
        $list_result = $request->input('result');
        foreach ($list_id as $item) {
            vaccine::where('id', $item)->update(['result' => $list_result[$item]]);
        }
        return redirect('vaccine/danh-sach-cho')->with('status', 'Đã Xác Nhận thành công!!!');
    }

    //DS theo lịch
    function list_to_calander(Request $request)
    {

        $created_at = date("Y-m-d", strtotime($request->input('created_at')));

        $vaccines = vaccine::where('created_at', $created_at)->paginate(8);
        return view('vaccine.list-to-calander', compact('vaccines'));
    }
}
