<?php

namespace App\Http\Controllers;

use App\user;
use App\User as AppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // RIÊNG 
    function hospitals(Request $request)
    {
        $keyword = '';
        if($request->input('keyword')){
            $keyword = $request->input('keyword');
        }

        $hospitals = AppUser::where('name','like','%'.$keyword.'%')->where('type','hospital')->paginate(8);
        return view('admin.hospitals.list', compact('hospitals'));
    }
    
    function add_hospitals()
    {
        return view('admin.hospitals.add');
    }
    function store_add_hospitals(Request $request)
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
                ]
            );

            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'type' => $request['type'],
            ]);
            return redirect('admin/hospital')->with('status', 'Thêm thành viên thành công');
        }
    }
    function delete_hospitals($id)
    {
        
        if(user::find($id)){
            $name =  user::find($id)->name;
            user::find($id)->delete();
            return redirect('admin/hospital')->with('delete', $name);
        }
        if(user::onlyTrashed()->find($id)){
            $name =  user::onlyTrashed()->find($id)->name;
            user::onlyTrashed()->find($id)->forceDelete();
            return redirect('admin/hospital/bin')->with('delete', $name);
        }

        
    }
    function bin_hospitals()
    {
        $hospitals = AppUser::onlyTrashed()->paginate(8);
        return view('admin.hospitals.bin', compact('hospitals'));
    }
    function restore_hospitals($id){
        $name = user::onlyTrashed()->find($id)->name;
        user::onlyTrashed()->find($id)->restore();
        return redirect('admin/hospital/bin')->with('restore',$name);  
    }
    
    function edit_hospitals($id)
    {
        $hospital = user::find($id);
        return view('admin.hospitals.edit', compact('hospital'));
    }
    function store_edit_hospitals(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'password_old' => ['required', 'string', 'min:5'],
                'password_new' => ['required', 'string', 'min:5'],
                'password_confirm' => ['required', 'string', 'min:5'],
            ],
            [
                'required' => ':attribute không được để trống',
                'regex' => ':attribute không đúng định dạng',
            ],
            [
                'name' => 'Họ và tên',
                'password_old' => 'Mật khẩu Cũ',
                'password_new' => 'Mật khẩu Mới',
                'password_confirm' => 'Mật khẩu Xác Nhận',
            ]
        );
        $hospital = user::find($request->submit_edit);
        // if ($request->password_old == $hospital->password) {
        //     if ($request->password_new == $request->password_confirm) {
        //         user::find($request->submit_edit)->update(
        //             [
        //                 'name' => $request->name,
        //                 'password' => $request->password_new,
        //             ]
        //         );
        //     }
        //     else{
        //         return back()->with('status','Mật khẩu mới không trùng');
        //     }
        // }else{
        //     return back()->with('status','Mật khẩu cũ không đúng');
        // }
        return redirect('admin/hospitals')->with('update',$request->name);
    }
}
