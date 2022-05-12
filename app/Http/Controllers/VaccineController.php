<?php

namespace App\Http\Controllers;

use App\city;
use App\disease;
use App\hospital;
use App\limit_web_mobile;
use App\patient;
use App\price_disease_hos;
use App\test_patient;
use App\User;
use App\vaccine;
use App\vaccine_hos;
use App\vaccine_patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VaccineController extends Controller
{
    function dashboard()
    {
        session(['active' => 'dashboard']);

        // vắc cin nhận được trong năm
        $sum_vac = vaccine_hos::where('id_hos', user::find(Auth::id())->id_hos)
            ->whereYear('date_add', date('Y'))
            ->sum('quantity_received');

        $sum_vac_year_old = vaccine_hos::where('id_hos', user::find(Auth::id())->id_hos)
            ->whereBetween('date_add', [date('Y-m-01', strtotime('-1 month')), date('Y-m-t', strtotime('-1 month'))])
            ->sum('quantity_received');
        // tỉ lệ so với số lượng nhận được tháng trước
        if ($sum_vac == 0) {
            $ratio_sum_old_vac = 0;
        } else {
            if ($sum_vac_year_old == 0) {
                $ratio_sum_old_vac = 100;
            } else {
                $ratio_sum_old_vac = round($sum_vac * 100 / $sum_vac_year_old - 100, 2);
            }
        }


        // vắc cin nhận được trong tháng
        $sum_vac_month = vaccine_hos::where('id_hos', user::find(Auth::id())->id_hos)
            ->whereBetween('date_add', [date('Y-m-01'), date('Y-m-t')])
            ->sum('quantity_received');
        $sum_vac_old = vaccine_hos::where('id_hos', user::find(Auth::id())->id_hos)
            ->whereBetween('date_add', [date('Y-m-01', strtotime('-1 month')), date('Y-m-t', strtotime('-1 month'))])
            ->sum('quantity_received');
        // tỉ lệ so với số lượng nhận được tháng trước
        if ($sum_vac_month == 0) {
            $ratio_sum_vac = 0;
        } else {
            if ($sum_vac_old == 0) {
                $ratio_sum_vac = 100;
            } else {
                $ratio_sum_vac = round($sum_vac_month * 100 / $sum_vac_old - 100, 2);
            }
        }

        // vắc cin còn lại 
        $sum_vac_remain = vaccine_hos::where('id_hos', user::find(Auth::id())->id_hos)
            ->sum('quantity');

        // tỉ lệ so với tổng
        if ($sum_vac == 0) {
            $ratio_sum_vac_remain = 0;
        } else {
            $ratio_sum_vac_remain = round($sum_vac_remain * 100 / $sum_vac, 2);
        }

        // vắc cin tiêm thành công
        $sum_vac_done = count(vaccine_patient::where('id_hos', user::find(Auth::id())->id_hos)
            ->whereBetween('date', [date('Y-m-01'), date('Y-m-t')])
            ->where('done_inject', '>', '0')->get());
        // vắc cin dk trong tháng
        $sum_vac_done_old = count(vaccine_patient::where('id_hos', user::find(Auth::id())->id_hos)
            ->get());
        // tỉ lệ so với tổng
        if ($sum_vac_done_old == 0) {
            $ratio_sum_vac_done = 0;
        } else {
            $ratio_sum_vac_done = round($sum_vac_done * 100 / $sum_vac_done_old, 2);
        }


        // vắc xin dùng nhiều
        $vaccines = vaccine_hos::where('id_hos', user::find(Auth::id())->id_hos)
            ->selectRaw('id_vac, quantity_received - quantity as so_luong')->orderBy('so_luong', 'DESC')
            ->get()->toArray();
        if (!empty($vaccines)) {
            for ($i = 0; $i < count($vaccines) - 1; $i++) {
                for ($j = $i + 1; $j < count($vaccines); $j++) {
                    if ($vaccines[$i]['id_vac'] == $vaccines[$j]['id_vac']) {
                        $vaccines[$i]['so_luong'] += $vaccines[$j]['so_luong'];
                    }
                }
            }
            $vac_top = $vaccines[0];
            $vac_top['name'] = vaccine::find($vac_top['id_vac'])->name;
        } else {
            $vac_top['id_vac'] = '';
            $vac_top['name'] = '';
            $vac_top['so_luong'] = 0;
        }

        $sum_count = vaccine_patient::where('id_hos', user::find(Auth::id())->id_hos)
            ->selectRaw('Month(date) as month,count(*) as count')
            ->whereYear('date', date('Y'))
            ->whereNotNull('done_inject')
            ->groupByRaw('Month(date)')->pluck('count');

        $sum_month = vaccine_patient::where('id_hos', user::find(Auth::id())->id_hos)
            ->selectRaw('Month(date) as month,count(*) as count')
            ->whereYear('date', date('Y'))
            ->whereNotNull('done_inject')
            ->groupByRaw('Month(date)')->pluck('month');

        $data = ['0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'];
        foreach ($sum_month as $index => $month) {
            $month--;
            $data[$month] = $sum_count[$index];
        }

        return view('vaccine.dashboard', compact(
            'data',
            'sum_vac',
            'ratio_sum_old_vac',
            'sum_vac_month',
            'ratio_sum_vac',
            'sum_vac_remain',
            'ratio_sum_vac_remain',
            'sum_vac_done',
            'ratio_sum_vac_done',
            'vac_top'
        ));
    }

    function limit()
    {
        session(['active' => 'limit']);

        // lần đầu tiên đăng nhập
        if(!limit_web_mobile::where('id_hos', user::find(Auth::id())->id_hos)->where('date', date('Y-m-d'))->first()){
            limit_web_mobile::create([
                'date' =>  date('Y-m-d'),
                'id_hos' => user::find(Auth::id())->id_hos,
                'limit_vaccine' => 0
            ]);
            
            // tạo các ngày tiếp theo
            for ($i = 1; $i < 9; $i++) {
                limit_web_mobile::create([
                    'date' =>  date('Y-m-d', strtotime('+' . $i . "day")),
                    'id_hos' => user::find(Auth::id())->id_hos,
                    'limit_vaccine' => 0
                ]);
            }

        }else{
            // tính số ngày cần cộng thêm
            $date_last_old = strtotime(limit_web_mobile::where('id_hos', user::find(Auth::id())->id_hos)->orderBy('date', 'DESC')->first()->date);
            $date_last_new = strtotime(date('Y-m-d', strtotime('+8day')));
            // tính ngày cần cộng thêm
            $datediff = abs($date_last_new - $date_last_old);
            $count = floor($datediff / (60 * 60 * 24));

            // add ngày cần cộng
            for ($i = $count; $i >= 1; $i--) {
                        limit_web_mobile::create([
                            'date' =>  date('Y-m-d', strtotime('+9day -' . $i . "day")),
                            'id_hos' => user::find(Auth::id())->id_hos,
                            'limit_vaccine' => 0
                        ]);
            }
        }

        $limits =  limit_web_mobile::where('id_hos', user::find(Auth::id())->id_hos)->where('date', '>', date('Y-m-d'))->get();
        $date_now = limit_web_mobile::where('id_hos', user::find(Auth::id())->id_hos)->where('date', date('Y-m-d'))->first();
        return view('vaccine.limit', compact('limits', 'date_now'));
    }

    function edit_limit()
    {
        session(['active' => 'limit']);

        if (limit_web_mobile::where('id_hos', user::find(Auth::id())->id_hos)->where('date', date('Y-m-d'))->first()) {
            // lấy 8 ngày tiếp
            $limits =  limit_web_mobile::where('id_hos', user::find(Auth::id())->id_hos)
                ->where('date', '>', date('Y-m-d'))->get();
            // lấy hôm nay
            $date_now = limit_web_mobile::where('id_hos', user::find(Auth::id())->id_hos)->where('date', date('Y-m-d'))->first();
        }
        return view('vaccine.edit_limit', compact('limits', 'date_now'));
    }
    function store_edit_limit(Request $request)
    {
        if ($request->input('submit')) {
            if (limit_web_mobile::where('id_hos', user::find(Auth::id())->id_hos)->where('date', date('Y-m-d'))->first()) {
                // hom nay 
                limit_web_mobile::where('id_hos', user::find(Auth::id())->id_hos)
                ->where('date', date('Y-m-d'))->update([
                    'limit_vaccine' => $request->limit_now
                ]);
                
                // ngay sau
                for ($i = 2; $i <= 9; $i++) {
                    $day = $i - 1;
                    limit_web_mobile::where('id_hos', user::find(Auth::id())->id_hos)
                        ->where('date', date('Y-m-d', strtotime("+ $day" . "day")))->update([
                            'limit_vaccine' => $request->$i
                        ]);
                }

                return redirect('vaccine/limit')->with('limit', 'Thay Đổi Giới Hạn Đăng Ký Thành Công');
            }
        }
    }


    function profile()
    {
        session(['active' => '']);
        $hospital = hospital::select('hospitals.*', 'users.email', 'users.phone')
            ->join('users', 'hospitals.id', 'users.id_hos')
            ->where('id_hos', user::find(Auth::id())->id_hos)
            ->where('users.id', Auth::id())->first();
        return view('vaccine.profile', compact('hospital'));
    }

    function edit_profile()
    {
        $city = city::all();
        $hospital = hospital::select('hospitals.*', 'users.email', 'users.phone')
            ->join('users', 'hospitals.id', 'users.id_hos')
            ->where('id_hos', user::find(Auth::id())->id_hos)
            ->where('users.id', Auth::id())->first();
        return view('vaccine.edit_profile', compact('hospital', 'city'));
    }

    function store_edit_profile(Request $request)
    {
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
        $images = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file->move(public_path('img/avatars'), $file->getClientOriginalName());
            $images = $file->getClientOriginalName();
        } else {
            $images = hospital::where('id', user::find(Auth::id())->id_hos)->first()->images;
        }

        User::where('id', Auth::id())->update([
            'phone' => $request->phone,
        ]);
        $er = [];
        if (empty($request->input('city')) || empty($request->input('province')) || empty($request->input('ward'))) {
            $er['error'] = "Khong de trong";
        }
        if (!empty($er)) {
            hospital::where('id', user::find(Auth::id())->id_hos)->update([
                'name' => $request->name,
                'address' => $request->address,
                'images' => $images
            ]);
        } else {
            hospital::where('id', user::find(Auth::id())->id_hos)->update([
                'name' => $request->name,
                'address' => $request->address,
                'images' => $images,
                'city' => DB::table('devvn_tinhthanhpho')->where('matp', $request->input('city'))->first()->name_city,
                'province' => DB::table('devvn_quanhuyen')->where('maqh', $request->input('province'))->first()->name_province,
                'ward' => DB::table('devvn_xaphuongthitran')->where('xaid', $request->input('ward'))->first()->name_wards
            ]);
        }
        return redirect('vaccine/profile')->with('success', 'CẬP NHẬT THÔNG TIN BỆNH VIỆN THÀNH CÔNG');
    }

    // VACCINE

    function vaccine_list(Request $request)
    {
        session(['active' => 'danh-sach-vaccine']);
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $type_disease = $request->input('type_disease')?$request->input('type_disease'):"";
        $vaccines = vaccine_hos::select('vaccines.*', 'vaccine_hos.lot_number', 'vaccine_hos.quantity', 'vaccine_hos.date_add', 'vaccine_hos.date_of_manufacture', 'vaccine_hos.out_of_date')
            ->where('vaccines.name', 'like', '%' . $keyword . '%')
            ->where('vaccine_hos.id_hos', user::find(Auth::id())->id_hos)
            ->Join('vaccines', 'vaccines.id', 'vaccine_hos.id_vac')
            ->where('vaccines.id_disease', 'like', '%'.$type_disease.'%')
            ->where('vaccine_hos.quantity', '>', '0')
            ->paginate(config('app.paginate'));
        $list_disease = $list_disease = disease::all();
        return view('vaccine.vaccine_list', compact('vaccines', 'list_disease'));
    }

    function edit_vaccine($id)
    {
        $list_vac = vaccine::all();
        $vaccines = vaccine::select('vaccines.*', 'diseases.name as diseases')
            ->leftJoin('diseases', 'vaccines.id_disease', 'diseases.id')->where('vaccines.id', $id)->first();
        $diseases = disease::all();
        $vac_hos = vaccine_hos::where('id_vac', $id)->where('id_hos', user::find(Auth::id())->id_hos)->first();
        return view('vaccine.vaccine_edit', compact('list_vac', 'vaccines', 'diseases', 'id', 'vac_hos'));
    }

    function store_edit_vaccine(Request $request)
    {
        if ($request->input('submit')) {
            $request->validate(
                [

                    'type_disease' => ['required'],
                    'description' => ['required'],
                ],
                [
                    'required' => ':attribute không được để trống'
                ],
                [
                    'type_disease' => 'Loại Bệnh',
                    'description' => 'Mô Tả',
                ]
            );

            vaccine::where('id', $request->input('id'))->update(
                [

                    'id_disease' => disease::where('name', 'like', '%' . $request->input('type_disease') . '%')->first()->id,
                ]
            );

            vaccine_hos::where('id_vac', $request->input('id'))
                ->where('id_hos', user::find(Auth::id())->id_hos)
                ->update([
                    'lot_number' => $request->lot_number,
                    'date_of_manufacture' => $request->date_of_manufacture,
                    'out_of_date' => $request->out_of_date
                ]);

            return redirect('vaccine/danh-sach-vaccine')->with('update_vaccine', $request->input('name'));
        }
    }

    // (1)
    function delete_vaccine(Request $request, $id)
    {

        if (vaccine_hos::where('id_vac', $id)
            ->where('id_hos', user::find(Auth::id())->id_hos)
            ->where('lot_number', $request->lot_number)
            ->where('date_of_manufacture', $request->date_of_manufacture)
            ->where('out_of_date', $request->out_of_date)->first()
        ) {
            $name = vaccine::find($id)->name;
            vaccine_hos::where('id_vac', $id)
                ->where('id_hos', user::find(Auth::id())->id_hos)
                ->where('lot_number', $request->lot_number)
                ->where('date_of_manufacture', $request->date_of_manufacture)
                ->where('out_of_date', $request->out_of_date)->delete();
            return redirect('vaccine/danh-sach-vaccine')->with(['delete_vaccine' => $name, 'lot_number' => $request->lot_number]);
        } else echo "ok";
    }
    function delete_vaccine_bin(Request $request, $id)
    {
        if (vaccine_hos::onlyTrashed()->where('id_vac', $id)
            ->where('id_hos', user::find(Auth::id())->id_hos)
            ->where('lot_number', $request->lot_number)
            ->where('date_of_manufacture', $request->date_of_manufacture)
            ->where('out_of_date', $request->out_of_date)
            ->first()
        ) {
            $name = vaccine::find($id)->name;
            vaccine_hos::onlyTrashed()->where('id_vac', $id)
                ->where('id_hos', user::find(Auth::id())->id_hos)
                ->where('lot_number', $request->lot_number)
                ->where('date_of_manufacture', $request->date_of_manufacture)
                ->where('out_of_date', $request->out_of_date)
                ->forceDelete();
            return redirect('vaccine/danh-sach-vaccine-da-xoa')->with(['delete_vaccine' => $name, 'lot_number' => $request->lot_number]);
        }
    }

    function bin_vaccine(Request $request)
    {
        session(['active' => 'danh-sach-vaccine-da-xoa']);
        $keyword = '';
        $vaccines = vaccine_hos::select('vaccines.*', 'vaccine_hos.lot_number', 'vaccine_hos.quantity', 'vaccine_hos.date_of_manufacture', 'vaccine_hos.out_of_date')
            ->where('vaccines.name', 'like', '%' . $keyword . '%')
            ->where('vaccine_hos.id_hos', user::find(Auth::id())->id_hos)
            ->join('vaccines', 'vaccines.id', 'vaccine_hos.id_vac')
            ->onlyTrashed()->paginate(config('app.paginate'));
        return view('vaccine.bin-vaccine', compact('vaccines'));
    }

    // (2)
    function restore_bin_vaccine(Request $request, $id)
    {
        $name = vaccine::find($id)->name;
        vaccine_hos::where('id_vac', $id)->where('id_hos', user::find(Auth::id())->id_hos)
            ->where('lot_number', $request->lot_number)->onlyTrashed()
            ->where('date_of_manufacture', $request->date_of_manufacture)
            ->where('out_of_date', $request->out_of_date)->restore();
        return redirect('vaccine/danh-sach-vaccine-da-xoa')->with(['restore_vaccine' => $name, 'lot_number' => $request->lot_number]);
    }


    function vaccine_addnew(Request $request)
    {
        session(['active' => 'them-moi']);
        $diseases = disease::select('name')->get();
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
            $list_vac = vaccine::withTrashed()->where('name', 'like', '%' . $request->input('name') . '%')->first();

            if ($list_vac) {
                return redirect('vaccine/them-moi-vaccine')->with('errorNameVaccine', $request->input('name'));
            }
            vaccine::create(
                [
                    'name' => $request->input('name'),
                    'country' => $request->input('country'),
                    'description' => $request->input('description'),
                    'age_use_from' => $request->input('age_use_from'),
                    'age_use_to' => $request->input('age_use_to'),
                    'id_disease' => disease::where('name', $request->input('type_disease'))->first()->id
                ]
            );

            vaccine_hos::create(
                [
                    'id_vac' => vaccine::where('name', $request->input('name'))->first()->id,
                    'id_hos' => user::find(Auth::id())->id_hos,
                    'quantity' => 0,
                ]
            );


            return redirect('vaccine/them-moi-vaccine')->with('nameVaccine', $request->input('name'));
        }
    }



    function vaccine_import()
    {
        session(['active' => 'nhap-them']);
        $list_vac = vaccine::all();
        $list_disease = disease::all();
        return view('vaccine.vaccine_import', compact('list_vac', 'list_disease'));
    }

    public function select_delivery(Request $request)
    {
        $data = $request->all();
        if ($data['action'] == "type_disease") {
            $output = '';
            $select_province = vaccine::where('id_disease', $data['ma_id'])->orderBy('name', 'ASC')->get();
            $output = '<option value="" selected="">Chọn Vắc Xin</option>';
            foreach ($select_province as $province) {
                $output .= '<option value="' . $province->name . '" >' . $province->name . '</option>';
            }
        }
        echo $output;
    }

    function store_vaccine_import(Request $request)
    {
        if ($request->input('submit')) {
            // $request->validate(
            //     [
            //         'name' => ['required'],
            //         'disease' => ['required'],
            //         'quantity' => ['required'],
            //         'lot_number' => ['required'],
            //         'date_of_manufacture' => ['required'],
            //         'out_of_date' => ['required'],
            //     ],
            //     [
            //         'required' => ':attribute không được để trống'
            //     ],
            //     [
            //         'name' => 'Tên Vắc Xin',
            //         'disease' => 'Loại Bệnh',
            //         'quantity' => 'Số Lượng',
            //         'lot_number' => 'Số Lô',
            //         'date_of_manufacture' => 'Ngày Sản Xuất',
            //         'out_of_date' => 'Hạn Sử Dụng',

            //     ]
            // );

            // nếu trong bảng có lô lot_number rồi, thì cộng thêm
            if (vaccine_hos::where('id_vac', vaccine::where('name', 'like', '%' . $request->input('name') . '%')->first()->id)
                ->where('id_hos', user::find(Auth::id())->id_hos)
                ->where('lot_number',  $request->input('lot_number'))
                ->where('date_of_manufacture',  $request->input('date_of_manufacture'))
                ->where('out_of_date',  $request->input('out_of_date'))->first()
            ) {
                // cộng thêm
                $vac_update = vaccine_hos::where('id_vac', vaccine::where('name', 'like', '%' . $request->input('name') . '%')->first()->id)
                    ->where('id_hos', user::find(Auth::id())->id_hos)
                    ->where('lot_number',  $request->input('lot_number'))
                    ->where('date_of_manufacture',  $request->input('date_of_manufacture'))
                    ->where('out_of_date',  $request->input('out_of_date'))->first();

                // cập nhật công thêm
                vaccine_hos::where('id_vac', vaccine::where('name', 'like', '%' . $request->input('name') . '%')->first()->id)
                    ->where('id_hos', user::find(Auth::id())->id_hos)
                    ->where('lot_number',  $request->input('lot_number'))
                    ->where('date_of_manufacture',  $request->input('date_of_manufacture'))
                    ->where('out_of_date',  $request->input('out_of_date'))
                    ->update([
                        'quantity' => $vac_update->quantity + $request->input('quantity'),
                        'quantity_received' => $vac_update->quantity_received + $request->input('quantity'),
                        'date_add' => date('Y-m-d'),
                        'date_of_manufacture' => $request->input('date_of_manufacture'),
                        'out_of_date' => $request->input('out_of_date')
                    ]);
                return redirect('vaccine/nhap-them-vaccine')->with('done_vac_hos', $request->input('name'));
            }

            // tạo mới 
            vaccine_hos::create([
                'id_vac' => vaccine::where('name', 'like', '%' . $request->input('name') . '%')->first()->id,
                'id_hos' => user::find(Auth::id())->id_hos,
                'quantity' => $request->input('quantity'),
                'quantity_received' => $request->input('quantity'),
                'lot_number' => $request->input('lot_number'),
                'date_add' => date('Y-m-d'),
                'date_of_manufacture' => $request->input('date_of_manufacture'),
                'out_of_date' => $request->input('out_of_date')
            ]);
            return redirect('vaccine/nhap-them-vaccine')->with('done_vac_hos', $request->input('name'));
        }
    }

    // DANH SÁCH LOẠI BỆNH
    function disease_list(Request $request)
    {
        session(['active' => 'danh-sach-loai-benh']);
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $count = 0;
        $list_disease = disease::select('id', 'name')->get()->toArray();
        foreach ($list_disease as $item) {
            $list_disease[$count]['vaccine'] = disease::find($item['id'])->vaccine->toArray();
            $count++;
        }
        // echo "<pre>";
        // print_r($list_disease);
        return view('vaccine.disease_list', compact('list_disease'));
    }

    // (3)
    function delete_disease($id)
    {
        $name = disease::find($id)->name;
        disease::find($id)->delete();
        return redirect('vaccine/danh-sach-loai-benh')->with('delete', $name);
    }

    function edit_disease($id)
    {
        $name = disease::find($id)->name;
        $list_vac = disease::find($id)->vaccine->toArray();
        $list_vac_all = vaccine::select('id', 'name')->get()->toArray();
        // echo "<pre>";
        // print_r($list_vac_all);
        return view('vaccine.edit_disease', compact('id', 'name', 'list_vac', 'list_vac_all'));
    }

    function store_edit_disease($id, Request $request)
    {

        foreach ($request->vaccine as $key => $value) {
            vaccine::find($key)->update([
                'id_disease' => $id
            ]);
        }

        return redirect('vaccine/danh-sach-loai-benh')->with('name', disease::find($id)->name);
    }

    function bin_disease(Request $request)
    {
        session(['active' => 'danh-sach-loai-benh-da-xoa']);
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $count = 0;
        $list_disease = disease::onlyTrashed()->select('id', 'name')
            ->get()->toArray();
        foreach ($list_disease as $item) {
            $list_disease[$count]['vaccine'] = disease::onlyTrashed()->find($item['id'])->vaccine->toArray();
            $count++;
        }
        return view('vaccine.disease_list_bin', compact('list_disease'));
    }

    function restore_bin_disease($id)
    {
        $name = disease::onlyTrashed()->find($id)->name;
        disease::onlyTrashed()->find($id)->restore();
        return redirect('vaccine/danh-sach-loai-benh-da-xoa')->with('restore', $name);
    }

    function delete_disease_bin($id)
    {
        $name = disease::onlyTrashed()->find($id)->name;
        vaccine::where('id_disease', $id)->update([
            'id_disease' => null
        ]);
        disease::onlyTrashed()->find($id)->forceDelete();
        return redirect('vaccine/danh-sach-loai-benh-da-xoa')->with('delete', $name);
    }


    function disease_addnew()
    {
        session(['active' => 'them-moi-loai-benh']);
        return view('vaccine.disease_addnew');
    }

    function store_addnew_disease(Request $request)
    {
        if ($request->input('submit')) {
            $request->validate(
                [
                    'disease' => ['required'],
                    'symptom' => ['required'],
                ],
                [
                    'required' => ':attribute không được để trống'
                ],
                [
                    'disease' => 'Loại Bệnh',
                    'symptom' => 'Triệu Chứng',
                ]
            );
            $list_disease = disease::withTrashed()->where('name', 'like', '%' . $request->input('disease') . '%')->first();

            if ($list_disease) {
                return redirect('vaccine/them-moi-loai-benh')->with('errorNameDisease', $request->input('disease'));
            }
            disease::create(
                [
                    'name' => $request->input('disease'),
                    'symptom' => $request->input('symptom'),
                ]
            );
            return redirect('vaccine/them-moi-loai-benh')->with('nameDisease', $request->input('disease'));
        } else return 1;
    }

    // DANH SÁCH TIÊM CHÍCH
    function todayList(Request $request)
    {
        session(['active' => 'today']);
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }

        $vaccines = vaccine_patient::select('patients.*', 'vaccine_patients.id_disease', 'vaccine_patients.registerTime', 'vaccine_patients.id_vac', 'vaccine_patients.status', 'vaccine_patients.injection_times', 'vaccine_patients.vaccine_1', 'vaccine_patients.vaccine_2', 'vaccine_patients.vaccine_3', 'vaccines.name')
            ->join('patients', 'vaccine_patients.id_card', 'patients.id_card')
            ->leftJoin('vaccines', 'vaccine_patients.id_vac', 'vaccines.id')
            ->where('vaccine_patients.id_hos', user::find(Auth::id())->id_hos)
            ->where('vaccine_patients.done_inject', '0')
            ->where('date', date('Y-m-d'))
            ->where('patients.fullname', 'like', '%' . $keyword . '%')
            ->orderBy('vaccine_patients.registerTime')
            ->with('disease')->paginate(config('app.paginate'));
        return view('vaccine.today-list', compact('vaccines'));
    }


    function confirm_vaccine($id_card, Request $request)
    {

        // ta chỉ lấy dc tên vắc cin = select_vac -> từ cái tên suy ngược ra lấy số vắc xin
        // số lượng
        if (vaccine_hos::join('vaccines', 'vaccines.id', 'vaccine_hos.id_vac')
            ->where('id_vac', vaccine::where('name', 'like', '%' . $request->input('select_vac') . '%')->first()->id)
            ->where('vaccine_hos.id_hos', user::find(Auth::id())->id_hos)
            ->orderBy('date_add', 'ASC')
            ->where('vaccine_hos.quantity', '>', '0')->first()
        ) {
            $quantity = vaccine_hos::join('vaccines', 'vaccines.id', 'vaccine_hos.id_vac')
                ->where('id_vac', vaccine::where('name', 'like', '%' . $request->input('select_vac') . '%')->first()->id)
                ->where('vaccine_hos.id_hos', user::find(Auth::id())->id_hos)
                ->orderBy('date_add', 'ASC')
                ->where('vaccine_hos.quantity', '>', '0')->first()->quantity;
        } else {
            // $name = vaccine::find(vaccine_patient::where('id_card', $id_card)->first()->id_vac)->name;
            $name = $request->input('select_vac');
            return redirect('vaccine/tiem-hom-nay')->with('quantity_zero', $name);
        }
        // nhập tên vắc xin
        if (
            vaccine_patient::where('vaccine_patients.id_hos', user::find(Auth::id())->id_hos)
            ->where('id_card', $id_card)->first()->injection_times == 1
        ) {
            vaccine_patient::where('vaccine_patients.id_hos', user::find(Auth::id())->id_hos)
                ->where('id_card', $id_card)->update([
                    'id_vac' => vaccine::where('name', 'like', '%' . $request->input('select_vac') . '%')->first()->id,
                    'vaccine_1' => $request->input('select_vac'),
                    'done_inject' => '1',
                    'status' => $request->status,
                    'date' => date('Y-m-d')
                ]);
        } else {
            if (
                vaccine_patient::where('vaccine_patients.id_hos', user::find(Auth::id())->id_hos)
                ->where('id_card', $id_card)->first()->injection_times    == 2
            ) {
                vaccine_patient::where('vaccine_patients.id_hos', user::find(Auth::id())->id_hos)
                    ->where('id_card', $id_card)->update([
                        'id_vac' => vaccine::where('name', 'like', '%' . $request->input('select_vac') . '%')->first()->id,
                        'vaccine_2' => $request->input('select_vac'),
                        'done_inject' => '1',
                        'status' => $request->status,
                        'date' => date('Y-m-d')
                    ]);
            } else {
                vaccine_patient::where('vaccine_patients.id_hos', user::find(Auth::id())->id_hos)
                    ->where('id_card', $id_card)->update([
                        'id_vac' => vaccine::where('name', 'like', '%' . $request->input('select_vac') . '%')->first()->id,
                        'vaccine_3' => $request->input('select_vac'),
                        'done_inject' => '1',
                        'status' => $request->status,
                        'date' => date('Y-m-d')
                    ]);
            }
        }
        //cập nhật số lượng vac
        if (vaccine_hos::where('id_hos', user::find(Auth::id())->id_hos)
            ->where('id_vac', vaccine::where('name', 'like', '%' . $request->input('select_vac') . '%')->first()->id)
            ->orderBy('date_add', 'ASC')
            ->where('vaccine_hos.quantity', '>', '0')->first()
        ) {
            vaccine_hos::where('id_hos', user::find(Auth::id())->id_hos)
                ->where('id_vac', vaccine::where('name', 'like', '%' . $request->input('select_vac') . '%')->first()->id)
                ->orderBy('date_add', 'ASC')
                ->where('vaccine_hos.quantity', '>', '0')->first()
                ->update(
                    [
                        'quantity' => $quantity - 1
                    ]
                );
        }

        $name = patient::where('id_card', $id_card)->first()->fullname;
        return redirect('vaccine/tiem-hom-nay')->with('done_patient', $name);
    }


    function delete_patient_vaccine($id_card)
    {
        if (vaccine_patient::where('id_hos', user::find(Auth::id())->id_hos)
            ->where('id_card', $id_card)->first()
        ) {
            $name = patient::where('id_card', $id_card)->first()->fullname;
            vaccine_patient::where('id_hos', user::find(Auth::id())->id_hos)
                ->where('id_card', $id_card)->delete();
            return redirect('vaccine/tiem-hom-nay')->with('delete_vaccine', $name);
        } else {
            $name = patient::where('id_card', $id_card)->first()->fullname;
            vaccine_patient::where('id_hos', user::find(Auth::id())->id_hos)
                ->onlyTrashed()->where('id_card', $id_card)->forceDelete();
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
            ->where('id_hos', user::find(Auth::id())->id_hos)
            ->where('vaccine_patients.done_inject', '0')
            ->where('date', date('Y-m-d'))->onlyTrashed()->paginate(config('app.paginate'));
        $list_vac = vaccine::all();
        return view('vaccine.wait-list', compact('vaccines', 'list_vac'));
    }

    function restorePatient($id_card)
    {
        $name = patient::where('id_card', $id_card)->first()->fullname;
        vaccine_patient::where('id_hos', user::find(Auth::id())->id_hos)
            ->onlyTrashed()->where('id_card', $id_card)->restore();
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
        if ($request->input('created_at')) {
            $created_at = date("Y-m-d", strtotime($request->input('created_at')));
        } else {
            $created_at = date("Y-m-d");
        }
        $vaccines = vaccine_patient::select('patients.*', 'vaccine_patients.injection_times', 'vaccine_patients.id_vac','vaccine_patients.status', 'vaccine_patients.done_inject', 'vaccine_patients.vaccine_1', 'vaccine_patients.vaccine_2', 'vaccine_patients.vaccine_3', 'vaccines.name')
            ->join('patients', 'vaccine_patients.id_card', 'patients.id_card')
            ->leftJoin('vaccines', 'vaccine_patients.id_vac', 'vaccines.id')
            ->where('id_hos', user::find(Auth::id())->id_hos)
            ->where('date', $created_at)->withTrashed()->paginate(config('app.paginate'));
        return view('vaccine.list-to-calander', compact('vaccines', 'created_at'));
    }

    // xét tiên 
    function price_disease(){
        $diseases = disease::all();
        foreach ($diseases as $item) {
            if(!price_disease_hos::where('id_disease',$item->id)->where('id_hos',user::find(Auth::id())->id_hos)->first()){
                price_disease_hos::create([
                    'id_hos' => user::find(Auth::id())->id_hos,
                    'id_disease' => $item->id,
                    'price_vac' => 0
                ]);
            }            
        }

        session(['active' => 'price_dis']);
        $price_dis = DB::table('price_disease_hos')
        ->select('price_disease_hos.id','price_disease_hos.price_vac','diseases.name')
        ->where('id_hos',user::find(Auth::id())->id_hos)
        ->join('diseases','diseases.id','=','price_disease_hos.id_disease')->get();
        return view('vaccine.price_disease',compact('price_dis'));
    }

    function price_disease_edit(Request $request){
        session(['active' => 'price_dis']);
        $price_dis = DB::table('price_disease_hos')
        ->select('price_disease_hos.id','price_disease_hos.price_vac','diseases.name')
        ->where('price_disease_hos.id',$request->id)
        ->join('diseases','diseases.id','=','price_disease_hos.id_disease')->first();
        return view('vaccine.price_disease_edit',compact('price_dis'));
    }

    public function price_update(Request $request){
        price_disease_hos::where('id',$request->id)->update(
            [
                'price_vac' => $request->price_vac
            ]
        );
         
        $id_disease = price_disease_hos::find($request->id)->id_disease;
        $name = disease::find($id_disease)->name;
        return redirect('vaccine/xet-gia-tien-benh')->with('name_vac',$name);
    }

    public function qr(){
        session(['active' => 'qr']);
        return view('vaccine.qr');
    }
}
