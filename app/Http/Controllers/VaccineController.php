<?php

namespace App\Http\Controllers;

use App\disease;
use App\hospital;
use App\patient;
use App\test_patient;
use App\vaccine;
use App\vaccine_hos;
use App\vaccine_patient;
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

        return view('vaccine.dashboard', compact('count_yesterday', 'sum_count', 'negative', 'positive', 'ratio_yesterday', 'ratio_sum_count', 'ratio_negative', 'ratio_positive'));
    }


    // VACCINE

    function vaccine_list(Request $request)
    {
        session(['active' => 'danh-sach-vaccine']);
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $vaccines = vaccine::select('vaccines.*', 'vaccine_hos.lot_number', 'vaccine_hos.quantity', 'vaccine_hos.date_add', 'vaccine_hos.date_of_manufacture', 'vaccine_hos.out_of_date')
            ->where('name', 'like', '%' . $keyword . '%')
            ->where('vaccine_hos.id_hos', hospital::where('id_user', Auth::user()->id)->first()->id)
            ->leftJoin('vaccine_hos', 'vaccines.id', 'vaccine_hos.id_vac')
            ->where('vaccine_hos.quantity', '>', '0')->paginate(8);
        return view('vaccine.vaccine_list', compact('vaccines'));
    }

    function edit_vaccine($id)
    {
        $vaccines = vaccine::select('vaccines.*', 'diseases.name as diseases')
            ->leftJoin('diseases', 'vaccines.id', 'diseases.id_vac')->where('vaccines.id', $id)->first();
        $diseases = disease::all();
        return view('vaccine.vaccine_edit', compact('vaccines', 'diseases', 'id'));
    }

    function store_edit_vaccine(Request $request)
    {
        if ($request->input('submit')) {
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

            return redirect('vaccine/danh-sach-vaccine')->with('update_vaccine', $request->input('name'));
        }
    }

    function delete_vaccine($id)
    {
        if (vaccine::find($id)) {
            $name = vaccine::find($id)->name;
            vaccine::find($id)->delete();
            return redirect('vaccine/danh-sach-vaccine')->with('delete_vaccine', $name);
        } else {
            $name = vaccine::onlyTrashed()->where('id', $id)->first()->name;
            vaccine::onlyTrashed()->where('id', $id)->forceDelete();
            return redirect('vaccine/danh-sach-vaccine-da-xoa')->with('delete_vaccine', $name);
        }
    }

    function bin_vaccine(Request $request)
    {
        session(['active' => 'danh-sach-vaccine-da-xoa']);
        $keyword = '';
        $vaccines = vaccine::select('vaccines.*', 'vaccine_hos.lot_number', 'vaccine_hos.quantity', 'vaccine_hos.date_of_manufacture', 'vaccine_hos.out_of_date')
            ->where('name', 'like', '%' . $keyword . '%')
            ->where('vaccine_hos.id_hos', hospital::where('id_user', Auth::user()->id)->first()->id)
            ->join('vaccine_hos', 'vaccines.id', 'vaccine_hos.id_vac')
            ->onlyTrashed()->paginate(8);
        return view('vaccine.bin-vaccine', compact('vaccines'));
    }

    function restore_bin_vaccine($id)
    {
        $name = vaccine::onlyTrashed()->where('id', $id)->first()->name;
        vaccine::onlyTrashed()->where('id', $id)->restore();
        return redirect('vaccine/danh-sach-vaccine-da-xoa')->with('restore_vaccine', $name);
    }


    function vaccine_addnew()
    {
        $diseases = disease::selectRaw('count(id_vac) as number, name')->groupBy('name')->get();
        return view('vaccine.vaccine_addnew', compact('diseases'));
    }

    function store_addnew(Request $request)
    {
        if ($request->input('submit')) {
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
                    'id_vac' => vaccine::where('name','like', '%'.$request->input('name').'%')->first()->id,
                    'name'   => $request->input('type_disease')
                ]
            );

            vaccine_hos::create(
                [
                    'id_vac' => vaccine::where('name', $request->input('name'))->first()->id,
                    'id_hos' => hospital::where('id_user', Auth::id())->first()->id,
                    'quantity' => 0,
                ]
            );


            return redirect('vaccine/them-moi-vaccine')->with('nameVaccine', $request->input('name'));
        }
    }



    function vaccine_import()
    {
        $list_vac = vaccine::all();
        return view('vaccine.vaccine_import', compact('list_vac'));
    }

    function store_vaccine_import(Request $request)
    {
        if($request->input('submit')){
            $request->validate(
                [
                    'name' => ['required'],
                    'quantity' => ['required'],
                    'lot_number' => ['required'],
                    'date_of_manufacture' => ['required'],
                    'out_of_date' => ['required'],
                ],
                [
                    'required' => ':attribute không được để trống'
                ],
                [
                    'name' => 'Tên Vắc Xin',
                    'quantity' => 'Số Lượng',
                    'lot_number' => 'Số Lô',
                    'date_of_manufacture' => 'Ngày Sản Xuất',
                    'out_of_date' => 'Hạn Sử Dụng',
    
                ]
            );
    
            vaccine_hos::create([
                'id_vac' => vaccine::where('name','like', '%'.$request->input('name').'%')->first()->id,
                'id_hos' => hospital::where('id_user', Auth::id())->first()->id,
                'quantity' => $request->input('quantity'),
                'lot_number' => $request->input('lot_number'),
                'date_add' => date('Y-m-d'),
                'date_of_manufacture' => $request->input('date_of_manufacture'),
                'out_of_date' => $request->input('out_of_date')
            ]);
            return redirect('vaccine/nhap-them-vaccine')->with('done_vac_hos',$request->input('name'));
        }
    }

    // DANH SÁCH TIÊM CHÍCH
    function todayList(Request $request)
    {
        session(['active' => 'today']);
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $count_vac = $list_id_vac = vaccine_hos::select('id_vac')->groupBy('id_vac')->count();
        $list_id_vac = vaccine_hos::select('id_vac')->groupBy('id_vac')->get()->toArray();

        for ($i=0; $i < $count_vac ; $i++) { 
            
            $list_vac[$i]['name'] = vaccine_hos::select('vaccines.name')
            ->join('vaccines', 'vaccines.id', 'vaccine_hos.id_vac')
                ->where('id_vac',$list_id_vac[$i]['id_vac'])->first()->name;
            
                if(vaccine_hos::select('vaccine_hos.quantity')
                    ->join('vaccines', 'vaccines.id', 'vaccine_hos.id_vac')
                        ->where('id_vac',$list_id_vac[$i]['id_vac'])
                        ->where('quantity','>','0')->orderBy('date_add','ASC')->first()){
                            $list_vac[$i]['quantity'] = vaccine_hos::select('vaccine_hos.quantity')
                                ->join('vaccines', 'vaccines.id', 'vaccine_hos.id_vac')
                                ->where('id_vac',$list_id_vac[$i]['id_vac'])
                                ->where('quantity','>','0')->orderBy('date_add','ASC')->first()->quantity;
                }else{
                    $list_vac[$i]['quantity'] = 0;
                }
        }

        // echo "<pre>";
        // print_r($list_vac);
        $vaccines = vaccine_patient::select('patients.*', 'vaccine_patients.injection_times', 'vaccine_patients.vaccine_1', 'vaccine_patients.vaccine_2', 'vaccine_patients.vaccine_3', 'vaccines.name')
            ->join('patients', 'vaccine_patients.id_card', 'patients.id_card')
            ->leftJoin('vaccines', 'vaccine_patients.id_vac', 'vaccines.id')
            ->where('vaccine_patients.done_inject', '0')
            ->where('date', date('Y-m-d'))->paginate(8);
        return view('vaccine.today-list', compact('vaccines', 'list_vac'));
    }


    function confirm_vaccine($id_card, Request $request)
    {
         // ta chỉ lấy dc tên vắc cin = select_vac -> từ cái tên suy ngược ra lấy số vắc xin
        if(vaccine_hos::join('vaccines', 'vaccines.id', 'vaccine_hos.id_vac')
        ->where('id_vac',vaccine::where('name', 'like', '%' . $request->input('select_vac') . '%')->first()->id)
        ->orderBy('date_add','ASC')
        ->where('vaccine_hos.quantity','>','0')->first()){
            $quantity = vaccine_hos::join('vaccines', 'vaccines.id', 'vaccine_hos.id_vac')
            ->where('id_vac',vaccine::where('name', 'like', '%' . $request->input('select_vac') . '%')->first()->id)
            ->orderBy('date_add','ASC')
            ->where('vaccine_hos.quantity','>','0')->first()->quantity;
        }else{
            // $name = vaccine::find(vaccine_patient::where('id_card', $id_card)->first()->id_vac)->name;
            $name = $request->input('select_vac');
            return redirect('vaccine/tiem-hom-nay')->with('quantity_zero', $name);
        } 
        // nhập tên vắc xin
        if (vaccine_patient::where('id_card', $id_card)->first()->injection_times    == 1) {
            vaccine_patient::where('id_card', $id_card)->update([
                'id_vac' => vaccine::where('name', 'like', '%' . $request->input('select_vac') . '%')->first()->id,
                'vaccine_1' => $request->input('select_vac'),
                'done_inject' => '1',
                'date' => date('Y-m-d')
            ]);
        } else {
            if (vaccine_patient::where('id_card', $id_card)->first()->injection_times    == 2) {
                vaccine_patient::where('id_card', $id_card)->update([
                    'id_vac' => vaccine::where('name', 'like', '%' . $request->input('select_vac') . '%')->first()->id,
                    'vaccine_2' => $request->input('select_vac'),
                    'done_inject' => '1',
                    'date' => date('Y-m-d')
                ]);
            } else {
                vaccine_patient::where('id_card', $id_card)->update([
                    'id_vac' => vaccine::where('name', 'like', '%' . $request->input('select_vac') . '%')->first()->id,
                    'vaccine_3' => $request->input('select_vac'),
                    'done_inject' => '1',
                    'date' => date('Y-m-d')
                ]);
            }
        }
        //cập nhật số lượng vac
        vaccine_hos::where('id_vac', vaccine::where('name', 'like', '%' . $request->input('select_vac') . '%')->first()->id)
        ->orderBy('date_add','ASC')->first()
            ->update(
                [
                    'quantity' => $quantity - 1
                ]
            );
        $name = patient::where('id_card', $id_card)->first()->fullname;
        return redirect('vaccine/tiem-hom-nay')->with('done_patient', $name);
    }

    
    function delete_patient_vaccine($id_card)
    {
        if (vaccine_patient::where('id_card', $id_card)->first()) {
            $name = patient::where('id_card', $id_card)->first()->fullname;
            vaccine_patient::where('id_card', $id_card)->delete();
            return redirect('vaccine/tiem-hom-nay')->with('delete_vaccine', $name);
        } else {
            $name = patient::where('id_card', $id_card)->first()->fullname;
            vaccine_patient::onlyTrashed()->where('id_card', $id_card)->forceDelete();
            return redirect('vaccine/danh-sach-cho')->with('delete_vaccine', $name);
        }
    }

    function waitList(Request $request)
    {
        session(['active' => 'waitList']);
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $vaccines = vaccine_patient::select('patients.*', 'vaccine_patients.injection_times', 'vaccine_patients.vaccine_1', 'vaccine_patients.vaccine_2', 'vaccine_patients.vaccine_3', 'vaccines.name')
            ->join('patients', 'vaccine_patients.id_card', 'patients.id_card')
            ->leftJoin('vaccines', 'vaccine_patients.id_vac', 'vaccines.id')
            ->where('vaccine_patients.done_inject', '0')
            ->where('date', date('Y-m-d'))->onlyTrashed()->paginate(8);
        $list_vac = vaccine::all();
        return view('vaccine.wait-list', compact('vaccines', 'list_vac'));
    }

    function restorePatient($id_card)
    {
        $name = patient::where('id_card', $id_card)->first()->fullname;
        vaccine_patient::onlyTrashed()->where('id_card', $id_card)->restore();
        return redirect('vaccine/danh-sach-cho')->with('restore_vaccine', $name);
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
        session(['active' => 'calander']);
        $created_at = '';
        if ($request->input('created_at')) {
            $created_at = date("Y-m-d", strtotime($request->input('created_at')));
        }
        $vaccines = vaccine_patient::select('patients.*', 'vaccine_patients.injection_times', 'vaccine_patients.done_inject', 'vaccine_patients.vaccine_1', 'vaccine_patients.vaccine_2', 'vaccine_patients.vaccine_3', 'vaccines.name')
            ->join('patients', 'vaccine_patients.id_card', 'patients.id_card')
            ->leftJoin('vaccines', 'vaccine_patients.id_vac', 'vaccines.id')
            ->where('date', $created_at)->withTrashed()->paginate(8);
        return view('vaccine.list-to-calander', compact('vaccines'));
    }
}
