<?php

namespace App\Http\Controllers;

use App\hospital;
use App\patient;
use App\user;
use App\User as AppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    // dashboard
    function dashboard(){
        session(['active' => 'dashboard']);

        // tổng bệnh viện
        $sum_count_hos_moth = hospital::all()->count();
        

        // tổng bệnh viện trong tháng   
        $sum_hos_moth = hospital::join('users','users.id','hospitals.id_user')
        ->whereBetween('users.created_at', [date('Y-m-01'), date('Y-m-t')])->get()->count();
        $sum_hos_moth_old = hospital::join('users','users.id','hospitals.id_user')
        ->whereBetween('users.created_at', [date('Y-m-01', strtotime('-1 month')), date('Y-m-t', strtotime('-1 month'))])->get()->count();
        if ($sum_hos_moth == 0) {
            $ratio_sum_hos_moth = 0;
        } else {
            if ($sum_hos_moth_old == 0) {
                $ratio_sum_hos_moth = 100;
            } else {
                $ratio_sum_hos_moth = round($sum_hos_moth * 100 / $sum_hos_moth_old - 100,2);
            }
        }

        

        // tổng người dùng
        $sum_count_user_moth = patient::all()->count();
        

        // tổng người dùng trong tháng   
        $sum_user_moth = patient::whereBetween('created_at', [date('Y-m-01'), date('Y-m-t')])->get()->count();
        $sum_user_moth_old = patient::whereBetween('created_at', [date('Y-m-01', strtotime('-1 month')), date('Y-m-t', strtotime('-1 month'))])->get()->count();
        if ($sum_user_moth == 0) {
            $ratio_sum_user_moth = 0;
        } else {
            if ($sum_user_moth_old == 0) {
                $ratio_sum_user_moth = 100;
            } else {
                $ratio_sum_user_moth = round($sum_user_moth * 100 / $sum_user_moth_old - 100,2);
            }
        }

        $sum_hos_count = hospital::selectRaw('Month(users.created_at) as month,count(*) as count')
        ->join('users','users.id','hospitals.id_user')
        ->whereYear('users.created_at',date('Y'))
        ->groupByRaw('Month(users.created_at)')->pluck('count');
        
        $sum_hos_month = hospital::selectRaw('Month(users.created_at) as month,count(*) as count')
        ->join('users','users.id','hospitals.id_user')
        ->whereYear('users.created_at',date('Y'))
        ->groupByRaw('Month(users.created_at)')->pluck('month');

        $data_hos = ['0','0','0','0','0','0','0','0','0','0','0','0'];
        foreach ($sum_hos_month as $index => $month) {
            $month--;
            $data_hos[$month] = $sum_hos_count[$index];
        }

        $sum_pat_count = patient::selectRaw('Month(created_at) as month,count(*) as count')
        ->whereYear('created_at',date('Y'))
        ->groupByRaw('Month(created_at)')->pluck('count');
        
        $sum_pat_month = patient::selectRaw('Month(created_at) as month,count(*) as count')
        ->whereYear('created_at',date('Y'))
        ->groupByRaw('Month(created_at)')->pluck('month');

        $data_pat = ['0','0','0','0','0','0','0','0','0','0','0','0'];
        foreach ($sum_pat_month as $index => $month) {
            $month--;
            $data_pat[$month] = $sum_pat_count[$index];
        }
        

        return view('admin.dashboard', compact(
            'sum_count_hos_moth',
            'sum_hos_moth',
            'ratio_sum_hos_moth',
            'sum_count_user_moth',
            'sum_user_moth',
            'ratio_sum_user_moth',
            'data_hos',
            'data_pat'
        ));
    }
    // LIST HOSPITAL
    function hospitals(Request $request)
    {
        session(['active' => 'hos_lis']);
        $keyword = '';
        if($request->input('keyword')){
            $keyword = $request->input('keyword');
        }
        $hospitals = hospital::select('hospitals.*','users.email')
        ->join('users','hospitals.id_user','users.id')
        ->where('hospitals.name','like','%'.$keyword.'%')->paginate(8);
        
        return view('admin.hospitals.list', compact('hospitals'));
    }
    

    // ADD HOSPITAL
    function add_hospitals()
    {
        session(['active' => 'hos_add']);
        return view('admin.hospitals.add');
    }
    function store_add_hospitals(Request $request)
    {
        if ($request->input('submit')) {
            $request->validate(
                [
                    'name' => ['required', 'string', 'max:255'],
                    'address' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:5'],
                ],
                [
                    'required' => ':attribute không được để trống',
                    'unique' => ':attribute đã tồn tại',
                    'email' => 'Email không đúng định dạng',
                    'regex' => ':attribute không đúng định dạng',
                ],
                [
                    'name' => 'Họ và tên',
                    'email' => 'Email',
                    'password' => 'Mật khẩu',
                    'address' => 'Địa Chỉ',
                ]
            );

            User::create([
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'type' => $request['type'],
            ]);
            hospital::create([
                'name' => $request['name'],
                'address' => $request['address'],
                'id_user' => user::where('email',$request['email'])->first()->id,
            ]);
            return redirect('admin/hospitals')->with('status', 'Tạo Mới Bệnh Viện Thành Công.');
        }
    }

    // DELETE BIN
    function delete_hospitals($id)
    {
        
        if(hospital::find($id)){
            $name =  hospital::find($id)->name;
            $id_user = hospital::find($id)->id_user;
            hospital::find($id)->delete();
            user::find($id_user)->delete();
            return redirect('admin/hospitals')->with('delete', $name);
        }
        if(hospital::onlyTrashed()->find($id)){
            $name =  hospital::onlyTrashed()->find($id)->name;
            $id_user = hospital::onlyTrashed()->find($id)->id_user;
            user::onlyTrashed()->find($id_user)->forceDelete();
            return redirect('admin/hospital/bin')->with('delete', $name);
        }
    }
    function bin_hospitals(Request $request)
    {
        session(['active' => 'hos_bin']);
        $keyword = '';
        if($request->input('keyword')){
            $keyword = $request->input('keyword');
        }
        $hospitals = hospital::select('hospitals.*','users.email')
        ->join('users','hospitals.id_user','users.id')->onlyTrashed()
        ->where('hospitals.name','like','%'.$keyword.'%')->paginate(8);
        return view('admin.hospitals.bin', compact('hospitals'));
    }

    function restore_hospitals($id){       
        if(hospital::onlyTrashed()->find($id)){
            $name =  hospital::onlyTrashed()->find($id)->name;
            $id_user = hospital::onlyTrashed()->find($id)->id_user;
            user::onlyTrashed()->find($id_user)->restore();
            hospital::onlyTrashed()->find($id)->restore();
            return redirect('admin/hospital/bin')->with('restore', $name);
        }
       
    }
    

    // EDIT HOSPITAL
    function edit_hospitals($id)
    {
        $hospital = hospital::select('hospitals.*','users.email')
        ->join('users','hospitals.id_user','users.id')->where('hospitals.id',$id)->first();
        return view('admin.hospitals.edit', compact('hospital'));
    }
    function store_edit_hospitals(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
            ],
            [
                'required' => ':attribute không được để trống',
                'regex' => ':attribute không đúng định dạng',
            ],
            [
                'name' => 'Họ và tên',
                'address' => 'Địa Chỉ',
            ]
        );

    
        hospital::find($request->submit_edit)->update([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
        ]);
        return redirect('admin/hospitals')->with('update',$request->name);
    }


    
    // LIST USER
    function users(Request $request)
    {
        session(['active' => 'user_list']);
        $keyword = '';
        if($request->input('keyword')){
            $keyword = $request->input('keyword');
        }

        $patients = patient::where('fullname','like','%'.$keyword.'%')
        ->paginate(8);
        return view('admin.users.list', compact('patients'));
    }
    

    // ADD user
    function add_users()
    {
        session(['active' => 'user_add']);
        return view('admin.users.add');
    }
    function store_add_users(Request $request)
    {
        if ($request->input('submit')) {
            $request->validate(
                [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:5'],
                ],
                [
                    'required' => ':attribute không được để trống',
                    'email' => 'Email không đúng định dạng',
                    'regex' => ':attribute không đúng định dạng',
                ],
                [
                    'name' => 'Họ và tên',
                    'email' => 'Email',
                    'password' => 'Mật khẩu',
                    'address' => 'Địa Chỉ',
                ]
            );

            User::create([
                'name' => $request['name'],
                'address' => 'Nghệ An',
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'type' => $request['type'],
            ]);
            return redirect('admin/users')->with('status', 'Tạo Mới Bệnh Viện Thành Công.');
        }
    }

    // DELETE BIN
    function delete_users($id_card)
    {
        
        if(patient::where('id_card',$id_card)){
            $name = patient::where('id_card',$id_card)->first()->fullname;
            patient::where('id_card',$id_card)->delete();
            return redirect('admin/users')->with('delete', $name);
        }   
    }
    function delete_user_bin($id_card)
    {
        if(patient::onlyTrashed()->where('id_card',$id_card)){
            $name = patient::onlyTrashed()->where('id_card',$id_card)->first()->fullname;
            patient::onlyTrashed()->where('id_card',$id_card)->forceDelete();
            return redirect('admin/user/bin')->with('delete', $name);
        }
    }
    function bin_users(Request $request)
    {
        session(['active','user_bin']);
        $keyword = '';
        if($request->input('keyword')){
            $keyword = $request->input('keyword');
        }

        $patients = patient::onlyTrashed()->where('fullname','like','%'.$keyword.'%')
        ->paginate(8);
        return view('admin.users.bin', compact('patients'));
    }
    function restore_users($id_card){
        if(patient::onlyTrashed()->where('id_card',$id_card)){
            $name = patient::onlyTrashed()->where('id_card',$id_card)->first()->fullname;
            patient::onlyTrashed()->where('id_card',$id_card)->restore();
            return redirect('admin/user/bin')->with('restore',$name); 
        } 
    }
    

    // EDIT user
    function edit_users($id)
    {
        $user = user::find($id);
        return view('admin.users.edit', compact('user'));
    }
    function store_edit_users(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                
            ],
            [
                'required' => ':attribute không được để trống',
                'regex' => ':attribute không đúng định dạng',
            ],
            [
                'name' => 'Họ và tên',
            ]
        );
        $id = user::find($request->submit_edit);
        user::find($id->id)->update([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
        ]);
        return redirect('admin/users')->with('update',$request->name);
    }


    
}
