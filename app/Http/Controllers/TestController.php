<?php

namespace App\Http\Controllers;

use App\disease;
use App\hospital;
use App\limit_web_mobile;
use App\patient;
use App\price_disease_hos;
use App\test;
use App\test_patient;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Json;

class TestController extends Controller
{

    function dashboard()
    {
        // echo Auth::id();
        session(['active' => 'dashboard']);

        // tổng đã xét nghiệm hôm qua
        $sum_count_now = test_patient::where('id_hos', user::find(Auth::id())->id_hos)
            ->where('date', date('Y-m-d'))->get()->count();
        $sum_count_now_old = test_patient::where('id_hos', user::find(Auth::id())->id_hos)
            ->where('date', date('Y-m-d', strtotime('-1 days')))->get()->count();
        if ($sum_count_now == 0) {
            $ratio_sum_count_now = 0;
        } else {
            if ($sum_count_now_old == 0) {
                $ratio_sum_count_now = 100;
            } else {
                $ratio_sum_count_now = round($sum_count_now * 100 / $sum_count_now_old - 100, 2);
            }
        }

        // tổng đã xét nghiệm trong tháng   
        $sum_test_done = test_patient::where('id_hos', user::find(Auth::id())->id_hos)
            ->whereNotNull('result')->whereBetween('date', [date('Y-m-01'), date('Y-m-t')])->get()->count();
        $sum_test_done_old = test_patient::whereNotNull('result')->whereBetween('date', [date('Y-m-01', strtotime('-1 month')), date('Y-m-t', strtotime('-1 month'))])->get()->count();
        if ($sum_test_done == 0) {
            $ratio_sum_test_done = 0;
        } else {
            if ($sum_test_done_old == 0) {
                $ratio_sum_test_done = 100;
            } else {
                $ratio_sum_test_done = round($sum_test_done * 100 / $sum_test_done_old - 100, 2);
            }
        }

        // tổng âm tính 
        $sum_negative = test_patient::where('id_hos', user::find(Auth::id())->id_hos)
            ->where('result', '0')->whereBetween('date', [date('Y-m-01'), date('Y-m-t')])->get()->count();
        $sum_negative_old = test_patient::where('id_hos', user::find(Auth::id())->id_hos)
            ->where('result', '0')->whereBetween('date', [date('Y-m-01', strtotime('-1 month')), date('Y-m-t', strtotime('-1 month'))])->get()->count();
        if ($sum_negative == 0) {
            $ratio_sum_negative = 0;
        } else {
            if ($sum_negative_old == 0) {
                $ratio_sum_negative = 100;
            } else {
                $ratio_sum_negative = round($sum_negative * 100 / $sum_negative_old - 100, 2);
            }
        }
        // tổng dương tính 
        $sum_positive = test_patient::where('id_hos', user::find(Auth::id())->id_hos)
            ->where('result', '1')->whereBetween('date', [date('Y-m-01'), date('Y-m-t')])->get()->count();
        $sum_positive_old = test_patient::where('id_hos', user::find(Auth::id())->id_hos)
            ->where('result', '1')->whereBetween('date', [date('Y-m-01', strtotime('-1 month')), date('Y-m-t', strtotime('-1 month'))])->get()->count();
        if ($sum_positive == 0) {
            $ratio_sum_positive = 0;
        } else {
            if ($sum_positive_old == 0) {
                $ratio_sum_positive = 100;
            } else {
                $ratio_sum_positive = round($sum_positive * 100 / $sum_positive_old - 100, 2);
            }
        }

        $sum_count = test_patient::where('id_hos', user::find(Auth::id())->id_hos)
            ->selectRaw('Month(date) as month,count(*) as count')
            ->whereYear('date', date('Y'))
            ->whereNotNull('result')
            ->groupByRaw('Month(date)')->pluck('count');

        $sum_month = test_patient::where('id_hos', user::find(Auth::id())->id_hos)
            ->selectRaw('Month(date) as month,count(*) as count')
            ->whereYear('date', date('Y'))
            ->whereNotNull('result')
            ->groupByRaw('Month(date)')->pluck('month');

        $data = ['0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'];
        foreach ($sum_month as $index => $month) {
            $month--;
            $data[$month] = $sum_count[$index];
        }

        $sum_count_am = test_patient::where('id_hos', user::find(Auth::id())->id_hos)
            ->selectRaw('Month(date) as month,count(*) as count')
            ->whereYear('date', date('Y'))
            ->where('result', '0')
            ->groupByRaw('Month(date)')->pluck('count');

        $sum_month_am = test_patient::where('id_hos', user::find(Auth::id())->id_hos)
            ->selectRaw('Month(date) as month,count(*) as count')
            ->whereYear('date', date('Y'))
            ->where('result', '0')
            ->groupByRaw('Month(date)')->pluck('month');

        $data2 = ['0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'];
        foreach ($sum_month_am as $index => $month) {
            $month--;
            $data2[$month] = $sum_count_am[$index];
        }

        $sum_count_duong = test_patient::where('id_hos', user::find(Auth::id())->id_hos)
            ->selectRaw('Month(date) as month,count(*) as count')
            ->whereYear('date', date('Y'))
            ->where('result', '1')
            ->groupByRaw('Month(date)')->pluck('count');

        $sum_month_duong = test_patient::where('id_hos', user::find(Auth::id())->id_hos)
            ->selectRaw('Month(date) as month,count(*) as count')
            ->whereYear('date', date('Y'))
            ->where('result', '1')
            ->groupByRaw('Month(date)')->pluck('month');

        $data3 = ['0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'];
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

    function limit()
    {
        session(['active' => 'limit']);

        // lần đầu tiên đăng nhập
        if(!limit_web_mobile::where('id_hos', user::find(Auth::id())->id_hos)->where('date', date('Y-m-d'))->first()){
            limit_web_mobile::create([
                'date' =>  date('Y-m-d'),
                'id_hos' => user::find(Auth::id())->id_hos,
                'limit_test' => 0
            ]);
            
            // tạo các ngày tiếp theo
            for ($i = 1; $i < 9; $i++) {
                limit_web_mobile::create([
                    'date' =>  date('Y-m-d', strtotime('+' . $i . "day")),
                    'id_hos' => user::find(Auth::id())->id_hos,
                    'limit_test' => 0
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
                            'limit_test' => 0
                        ]);
            }
        }

        $limits =  limit_web_mobile::where('id_hos', user::find(Auth::id())->id_hos)->where('date', '>', date('Y-m-d'))->get();
        $date_now = limit_web_mobile::where('id_hos', user::find(Auth::id())->id_hos)->where('date', date('Y-m-d'))->first();
        return view('test.limit', compact('limits', 'date_now'));
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
        return view('test.edit_limit', compact('limits', 'date_now'));
    }

    function store_edit_limit(Request $request)
    {
        if ($request->input('submit')) {
            if (limit_web_mobile::where('id_hos', user::find(Auth::id())->id_hos)->where('date', date('Y-m-d'))->first()) {

                // hom nay 
                limit_web_mobile::where('id_hos', user::find(Auth::id())->id_hos)
                    ->where('date', date('Y-m-d'))->update([
                        'limit_test' => $request->limit_now
                    ]);
                // ngay sau
                for ($i = 2; $i <= 9; $i++) {
                    $day = $i - 1;
                    limit_web_mobile::where('id_hos', user::find(Auth::id())->id_hos)
                        ->where('date', date('Y-m-d', strtotime("+ $day" . "day")))->update([
                            'limit_test' => $request->$i
                        ]);
                }

                return redirect('test/limit')->with('limit', 'Thay Đổi Giới Hạn Đăng Ký Thành Công');
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
        return view('test.profile', compact('hospital'));
    }
    function edit_profile()
    {
        $hospital = hospital::select('hospitals.*', 'users.email', 'users.phone')
            ->join('users', 'hospitals.id', 'users.id_hos')
            ->where('id_hos', user::find(Auth::id())->id_hos)
            ->where('users.id', Auth::id())->first();
        return view('test.edit_profile', compact('hospital'));
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
        return redirect('test/profile')->with('success', 'CẬP NHẬT THÔNG TIN BỆNH VIỆN THÀNH CÔNG');
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
            ->where('test_patient.id_hos', User::find(Auth::id())->id_hos)
            ->where('test_patient.wait_at', '0')
            ->where('date', date('Y-m-d'))
            ->where('patients.fullname', 'like', '%' . $keyword . '%')->paginate(config('app.paginate'));
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
            ->where('test_patient.id_hos', User::find(Auth::id())->id_hos)
            ->where('test_patient.wait_at', '0')
            ->where('date', date('Y-m-d'))
            ->where('patients.fullname', 'like', '%' . $keyword . '%')->paginate(config('app.paginate'));
        // echo "<pre>";
        // print_r($patients);
        return view('test.softDelete-list', compact('patients'));
    }
    function done_patient($id_card)
    {
        test_patient::where('id_card', $id_card)
            ->where('id_hos', user::find(Auth::id())->id_hos)
            ->update(['wait_at' => '1']);
        $fullname = patient::where('id_card', $id_card)->first()->fullname;
        return redirect('test/xet-nghiem-hom-nay')->with('done_patient', $fullname);
    }

    function restore_patient($id_card)
    {
        test_patient::onlyTrashed()->where('id_card', $id_card)
            ->where('id_hos', user::find(Auth::id())->id_hos)->restore();
        $fullname = patient::where('id_card', $id_card)->first()->fullname;
        return redirect('test/danh-sach-xoa-tam')->with('restore_patient', $fullname);
    }

    function delete_patient($id_card)
    {
        $fullname = patient::where('id_card', $id_card)->first()->fullname;
        test_patient::where('id_card', $id_card)
            ->where('id_hos', user::find(Auth::id())->id_hos)->delete();
        return redirect('test/xet-nghiem-hom-nay')->with('delete_patient', $fullname);
    }

    function delete_patient_softDelete($id_card)
    {
        $fullname = patient::where('id_card', $id_card)->first()->fullname;
        test_patient::onlyTrashed()->where('id_card', $id_card)
            ->where('id_hos', user::find(Auth::id())->id_hos)->forceDelete();
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
            ->where('test_patient.id_hos', User::find(Auth::id())->id_hos)
            ->where('test_patient.wait_at', '1')->whereNull('result')
            ->where('date', date('Y-m-d'))
            ->where('patients.fullname', 'like', '%' . $keyword . '%')->paginate(config('app.paginate'));
        return view('test.wait-list', compact('patients'));
    }

    function result(Request $request)
    {
        $list_id = $request->input('check');
        $list_result = $request->input('result');
        foreach ($list_id as $item) {
            test_patient::where('id_card', $item)
                ->where('test_patient.id_hos', User::find(Auth::id())->id_hos)
                ->update(['result' => $list_result[$item]]);
        }
        return redirect('test/danh-sach-cho')->with('status', 'Đã Xác Nhận thành công!!!');
    }

    //DS theo lịch
    function list_to_calander(Request $request)
    {
        session(['active' => 'list_to_calander']);
        if ($request->input('created_at')) {
            $created_at = date("Y-m-d", strtotime($request->input('created_at')));
        } else {
            $created_at = date("Y-m-d");
        }
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }


        $patients = test_patient::select('patients.*', 'test_patient.*')
            ->join('patients', 'test_patient.id_card', 'patients.id_card')
            ->join('hospitals', 'test_patient.id_hos', 'hospitals.id')
            ->where('test_patient.id_hos', User::find(Auth::id())->id_hos)
            ->where('test_patient.date', $created_at)
            ->where('patients.fullname', 'like', '%' . $keyword . '%')->paginate(config('app.paginate'));
        // echo "<pre>";
        // print_r($patients);
        return view('test.list-to-calander', compact('patients', 'created_at'));
    }
    function price_disease(){
        $diseases = disease::all();
        foreach ($diseases as $item) {
            if(!price_disease_hos::where('id_disease',$item->id)->where('id_hos',user::find(Auth::id())->id_hos)->first()){
                price_disease_hos::create([
                    'id_hos' => user::find(Auth::id())->id_hos,
                    'id_disease' => $item->id,
                    'price_test' => 0
                ]);
            }            
        }
        session(['active' => 'price_dis']);
        $price_dis = DB::table('price_disease_hos')
        ->select('price_disease_hos.id','price_disease_hos.price_test','diseases.name')
        ->where('id_hos',user::find(Auth::id())->id_hos)
        ->join('diseases','diseases.id','=','price_disease_hos.id_disease')->get();
        return view('test.price_disease',compact('price_dis'));
    }

    function price_disease_edit(Request $request){
        session(['active' => 'price_dis']);
        $price_dis = DB::table('price_disease_hos')
        ->select('price_disease_hos.id','price_disease_hos.price_test','diseases.name')
        ->where('price_disease_hos.id',$request->id)
        ->join('diseases','diseases.id','=','price_disease_hos.id_disease')->first();
        return view('test.price_disease_edit',compact('price_dis'));
    }

    public function price_update(Request $request){
        price_disease_hos::where('id',$request->id)->update(
            [
                'price_test' => $request->price_test
            ]
        );
         
        $id_disease = price_disease_hos::find($request->id)->id_disease;
        $name = disease::find($id_disease)->name;
        return redirect('test/xet-gia-tien-benh')->with('name_vac',$name);
    }

    public function qr(){

        return view('test.qr');
    }

}
