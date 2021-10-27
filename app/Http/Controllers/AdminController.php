<?php

namespace App\Http\Controllers;

use App\user;
use App\User as AppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // LIST HOSPITAL
    function hospitals(Request $request)
    {
        $keyword = '';
        if($request->input('keyword')){
            $keyword = $request->input('keyword');
        }

        $hospitals = AppUser::where('name','like','%'.$keyword.'%')->where('type','hospital')->paginate(8);
        return view('admin.hospitals.list', compact('hospitals'));
    }
    

    // ADD HOSPITAL
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
                    'address' => ['required', 'string', 'max:255'],
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
                'address' => $request['address'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'type' => $request['type'],
            ]);
            return redirect('admin/hospitals')->with('status', 'Tạo Mới Bệnh Viện Thành Công.');
        }
    }

    // DELETE BIN
    function delete_hospitals($id)
    {
        
        if(user::find($id)){
            $name =  user::find($id)->name;
            user::find($id)->delete();
            return redirect('admin/hospitals')->with('delete', $name);
        }
        if(user::onlyTrashed()->find($id)){
            $name =  user::onlyTrashed()->find($id)->name;
            user::onlyTrashed()->find($id)->forceDelete();
            return redirect('admin/hospital/bin')->with('delete', $name);
        }

        
    }
    function bin_hospitals()
    {
        $hospitals = AppUser::onlyTrashed()->where('type','hospital')->paginate(8);
        return view('admin.hospitals.bin', compact('hospitals'));
    }
    function restore_hospitals($id){
        $name = user::onlyTrashed()->find($id)->name;
        user::onlyTrashed()->find($id)->restore();
        return redirect('admin/hospital/bin')->with('restore',$name);  
    }
    

    // EDIT HOSPITAL
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

        $id = user::find($request->submit_edit);
        user::find($id->id)->update([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
        ]);
        return redirect('admin/hospitals')->with('update',$request->name);
    }


    
    // LIST USER
    function users(Request $request)
    {
        $keyword = '';
        if($request->input('keyword')){
            $keyword = $request->input('keyword');
        }

        $users = AppUser::where('name','like','%'.$keyword.'%')->where('type','user')->paginate(8);
        return view('admin.users.list', compact('users'));
    }
    

    // ADD user
    function add_users()
    {
        return view('admin.users.add');
    }
    function store_add_users(Request $request)
    {
        if ($request->input('submit')) {
            // $request->validate(
            //     [
            //         'name' => ['required', 'string', 'max:255'],
            //         'address' => ['required', 'string', 'max:255'],
            //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //         'password' => ['required', 'string', 'min:5'],
            //     ],
            //     [
            //         'required' => ':attribute không được để trống',
            //         'email' => 'Email không đúng định dạng',
            //         'regex' => ':attribute không đúng định dạng',
            //     ],
            //     [
            //         'name' => 'Họ và tên',
            //         'email' => 'Email',
            //         'password' => 'Mật khẩu',
            //         'address' => 'Địa Chỉ',
            //     ]
            // );

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
    function delete_users($id)
    {
        
        if(user::find($id)){
            $name =  user::find($id)->name;
            user::find($id)->delete();
            return redirect('admin/users')->with('delete', $name);
        }
        if(user::onlyTrashed()->find($id)){
            $name =  user::onlyTrashed()->find($id)->name;
            user::onlyTrashed()->find($id)->forceDelete();
            return redirect('admin/user/bin')->with('delete', $name);
        }

        
    }
    function bin_users()
    {
        $users = AppUser::onlyTrashed()->where('type','user')->paginate(8);
        return view('admin.users.bin', compact('users'));
    }
    function restore_users($id){
        $name = user::onlyTrashed()->find($id)->name;
        user::onlyTrashed()->find($id)->restore();
        return redirect('admin/user/bin')->with('restore',$name);  
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
