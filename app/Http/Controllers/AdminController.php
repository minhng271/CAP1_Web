<?php

namespace App\Http\Controllers;

use App\city;
use App\hospital;
use App\patient;
use App\province;
use App\user;
use App\User as AppUser;
use App\ward;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    // dashboard
    function dashboard()
    {
        session(['active' => 'dashboard']);
        // tổng bệnh viện trong năm
        $sum_count_hos_moth = hospital::whereYear('created_at', date('Y'))->get()->count();
        $sum_count_hos_moth_old = hospital::whereBetween('created_at', [date('Y-01-01', strtotime('-1 year')), date('Y-12-t', strtotime('-1 year'))])->get()->count();
        if ($sum_count_hos_moth == 0) {
            $ratio_sum_count_hos_moth = 0;
        } else {
            if ($sum_count_hos_moth_old == 0) {
                $ratio_sum_count_hos_moth = 100;
            } else {
                
                $ratio_sum_count_hos_moth = round($sum_count_hos_moth*100/$sum_count_hos_moth_old,2);
            }
        }


        // tổng bệnh viện trong tháng   
        $sum_hos_moth = hospital::whereBetween('created_at', [date('Y-m-01'), date('Y-m-t')])->get()->count();
        $sum_hos_moth_old = hospital::whereBetween('created_at', [date('Y-m-01', strtotime('-1 month')), date('Y-m-t', strtotime('-1 month'))])->get()->count();
        if ($sum_hos_moth == 0) {
            $ratio_sum_hos_moth = 0;
        } else {
            if ($sum_hos_moth_old == 0) {
                $ratio_sum_hos_moth = 100;
            } else {
                $ratio_sum_hos_moth = round($sum_hos_moth * 100 / $sum_hos_moth_old - 100, 2);
            }
        }



        // tổng người dùng trong năm
        $sum_count_user_moth = patient::whereYear('created_at', date('Y'))->get()->count();;
        $sum_count_user_moth_old = patient::whereBetween('created_at', [date('Y-01-01', strtotime('-1 year')), date('Y-12-t', strtotime('-1 year'))])->get()->count();
        if ($sum_count_user_moth == 0) {
            $ratio_sum_count_user_moth = 0;
        } else {
            if ($sum_count_user_moth_old == 0) {
                $ratio_sum_count_user_moth = 100;
            } else {
                $ratio_sum_count_user_moth = round($sum_count_user_moth * 100 / $sum_count_user_moth_old - 100, 2);
            }
        }



        // tổng người dùng trong tháng   
        $sum_user_moth = patient::whereBetween('created_at', [date('Y-m-01'), date('Y-m-t')])->get()->count();
        $sum_user_moth_old = patient::whereBetween('created_at', [date('Y-m-01', strtotime('-1 month')), date('Y-m-t', strtotime('-1 month'))])->get()->count();
        if ($sum_user_moth == 0) {
            $ratio_sum_user_moth = 0;
        } else {
            if ($sum_user_moth_old == 0) {
                $ratio_sum_user_moth = 100;
            } else {
                $ratio_sum_user_moth = round($sum_user_moth * 100 / $sum_user_moth_old - 100, 2);
            }
        }

        $sum_hos_count = hospital::selectRaw('Month(created_at) as month,count(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupByRaw('Month(created_at)')->pluck('count');

        $sum_hos_month = hospital::selectRaw('Month(created_at) as month,count(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupByRaw('Month(created_at)')->pluck('month');

        $data_hos = ['0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'];
        foreach ($sum_hos_month as $index => $month) {
            $month--;
            $data_hos[$month] = $sum_hos_count[$index];
        }

        $sum_pat_count = patient::selectRaw('Month(created_at) as month,count(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupByRaw('Month(created_at)')->pluck('count');

        $sum_pat_month = patient::selectRaw('Month(created_at) as month,count(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupByRaw('Month(created_at)')->pluck('month');

        $data_pat = ['0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'];
        foreach ($sum_pat_month as $index => $month) {
            $month--;
            $data_pat[$month] = $sum_pat_count[$index];
        }


        return view('admin.dashboard', compact(
            'sum_count_hos_moth',
            'sum_count_hos_moth_old',
            'ratio_sum_count_hos_moth',
            'sum_hos_moth',
            'ratio_sum_hos_moth',
            'sum_count_user_moth',
            'sum_count_user_moth_old',
            'ratio_sum_count_user_moth',
            'sum_user_moth',
            'ratio_sum_user_moth',
            'data_hos',
            'data_pat'
        ));
    }
    // LIST HOSPITAL ACCOUNT
    function hospitals(Request $request)
    {
        session(['active' => 'hos_lis']);
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $hospitals = user::select('hospitals.*', 'users.id as id_user', 'users.phone', 'users.created_at as date_create', 'users.email', 'users.type_hos')
            ->join('hospitals', 'users.id_hos', 'hospitals.id')
            ->where('hospitals.name', 'like', '%' . $keyword . '%')
            ->orderBy('date_create','DESC')->paginate(8);

        return view('admin.hospitals.list', compact('hospitals'));
    }


    // ADD HOSPITAL account
    function add_hospitals()
    {
        session(['active' => 'hos_add']);
        $hospital = hospital::select('name')->get();
        return view('admin.hospitals.add', compact('hospital'));
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
                    'unique' => ':attribute đã tồn tại',
                    'email' => 'Email không đúng định dạng',
                    'regex' => ':attribute không đúng định dạng',
                ],
                [
                    'name' => 'Họ và tên',
                    'email' => 'Email',
                    'password' => 'Mật khẩu',
                ]
            );
            // return $request->input();
            User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'type' => $request->type,
                'type_hos' => $request->type_hos,
                'phone' => $request->phone,
                'id_hos' => hospital::where('name', $request->name)->first()->id,
            ]);
            return redirect('admin/hospital-acc')->with('status', 'Tạo Mới Tài Khoản Bệnh Viện Thành Công.');
        }
    }

    // DELETE BIN
    function delete_hospitals($id)
    {
        if (user::find($id)) {
            $name =  user::find($id)->email;
            user::find($id)->delete();
            return redirect('admin/hospital-acc')->with('delete', $name);
        }
        if (user::onlyTrashed()->find($id)) {
            $name =  user::find($id)->email;
            user::onlyTrashed()->find($id)->forceDelete();
            return redirect('admin/hospital-acc/bin')->with('delete', $name);
        }
    }


    function delete_hospitals_bin($id)
    {
        if (user::onlyTrashed()->find($id)) {
            $name =  user::onlyTrashed()->find($id)->email;
            user::onlyTrashed()->find($id)->forceDelete();
            return redirect('admin/hospital-acc/bin')->with('delete', $name);
        }
    }
    function bin_hospitals(Request $request)
    {
        session(['active' => 'hos_bin']);
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $hospitals = user::select('hospitals.*', 'users.id as id_user', 'users.phone', 'users.email', 'users.type_hos')
            ->join('hospitals', 'users.id_hos', 'hospitals.id')->onlyTrashed()
            ->where('hospitals.name', 'like', '%' . $keyword . '%')->paginate(8);

        return view('admin.hospitals.bin', compact('hospitals'));
    }

    function restore_hospitals($id)
    {
        if (user::onlyTrashed()->find($id)) {
            $name =  user::onlyTrashed()->find($id)->email;
            user::onlyTrashed()->find($id)->restore();
            return redirect('admin/hospital-acc/bin')->with('restore', $name);
        }
    }


    // EDIT HOSPITAL
    function edit_hospitals($id)
    {
        $hospital = user::select('hospitals.*', 'users.id as id_user', 'users.phone', 'users.email', 'users.type_hos')
            ->join('hospitals', 'users.id_hos', 'hospitals.id')
            ->where('users.id', $id)->first();
        return view('admin.hospitals.edit', compact('hospital'));
    }

    function store_edit_hospitals(Request $request)
    {
        if ($request->submit_edit) {
            user::where('id',$request->id_user)->update([
                'email' => $request->email,
                'type_hos' => $request->type_hos,
                'phone' => $request->phone,
            ]);

            hospital::where('id',$request->submit_edit)->update([
                'address' => $request->input('address'),
            ]);
            return redirect('admin/hospital-acc')->with('update', $request->name);
        }
    }

    // --------------------------------------------------------------------------


    // LIST HOSPITAL
    function list_hos(Request $request)
    {
        session(['active' => 'hos_lis1']);
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $hospitals = hospital::where('hospitals.name', 'like', '%' . $keyword . '%')->orderByRaw('created_at DESC')->paginate(8);

        return view('admin.hospitals.hospital.list', compact('hospitals'));
    }


    // ADD HOSPITAL
    function add_hos()
    {
        session(['active' => 'hos_add1']);
        $city = city::all();
        return view('admin.hospitals.hospital.add', compact('city'));
    }

    public function select_delivery(Request $request)
    {
        $data = $request->all();
        if ($data['action'] == "city") {
            $output = '';
            $select_province = province::where('matp', $data['ma_id'])->orderBy('maqh', 'ASC')->get();
            $output = '<option value="" selected="">Chọn Quận/ Huyện</option>';
            foreach ($select_province as $province) {
                $output .= '<option value="' . $province->maqh . '" >' . $province->name_province . '</option>';
            }
        } else {
            $select_wards = ward::where('maqh', $data['ma_id'])->orderBy('xaid', 'ASC')->get();
            $output = '<option value="" selected="">Chọn Phường/ Xã</option>';
            foreach ($select_wards as $ward) {
                $output .= '<option value="' . $ward->xaid . '" >' . $ward->name_wards . '</option>';
            }
        }
        echo $output;
    }
    public function select_delivery_edit(Request $request)
    {
        $data = $request->all();
        if ($data['action'] == "city") {
            $output = '';
            $select_province = province::where('matp', $data['ma_id'])->orderBy('maqh', 'ASC')->get();
            $output = '<option value="" selected="">Chọn Quận/ Huyện</option>';
            foreach ($select_province as $province) {
                $output .= '<option value="' . $province->maqh . '" >' . $province->name_province . '</option>';
            }
        } else {
            $select_wards = ward::where('maqh', $data['ma_id'])->orderBy('xaid', 'ASC')->get();
            $output = '<option value="" selected="">Chọn Phường/ Xã</option>';
            foreach ($select_wards as $ward) {
                $output .= '<option value="' . $ward->xaid . '" >' . $ward->name_wards . '</option>';
            }
        }
        echo $output;
    }

    function store_add_hos(Request $request)
    {
        // return $request->all();
        if ($request->input('submit')) {
            $request->validate(
                [
                    'name' => ['required', 'string', 'max:255'],
                    'city' => ['required', 'string', 'max:255'],
                    'province' => ['required', 'string', 'max:255'],
                    'ward' => ['required', 'string', 'max:255'],
                    'address' => ['required', 'string', 'max:255'],

                ],
                [
                    'required' => ':attribute không được để trống',
                ],
                [
                    'name' => 'Họ và tên',
                    'city' => 'Tỉnh/ Thành Phố',
                    'province' => 'Quận/ Huyện',
                    'ward' => 'Phường/ Xã',
                    'address' => 'Địa Chỉ/ Số Nhà',
                ]
            );

            $city = city::where('matp', $request->city)->first()->name_city;
            $province = province::where('maqh', $request->province)->first()->name_province;
            $ward = ward::where('xaid', $request->ward)->first()->name_wards;
            hospital::create([
                'name' => $request->name,
                'address' => $request->address,
                'city' => $city,
                'province' => $province,
                'ward' => $ward,
            ]);

            return redirect('admin/hospital')->with('status', 'Tạo Mới Bệnh Viện Thành Công.');
        }
    }

    // DELETE BIN
    function delete_hos($id)
    {
        if (hospital::find($id)) {
            $name =  hospital::find($id)->name;
            hospital::find($id)->delete();
            return redirect('admin/hospital')->with('delete', $name);
        }
    }


    function delete_hos_bin($id)
    {
        if (hospital::onlyTrashed()->find($id)) {
            $name =  hospital::onlyTrashed()->find($id)->name;
            hospital::onlyTrashed()->find($id)->forceDelete();
            return redirect('admin/hospital/bin')->with('delete', $name);
        }
    }

    function bin_hos(Request $request)
    {
        session(['active' => 'hos_bin1']);
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $hospitals = hospital::onlyTrashed()
            ->where('hospitals.name', 'like', '%' . $keyword . '%')->paginate(8);

        return view('admin.hospitals.hospital.bin', compact('hospitals'));
    }

    function restore_hos($id)
    {
        if (hospital::onlyTrashed()->find($id)) {
            $name =  hospital::onlyTrashed()->find($id)->name;
            hospital::onlyTrashed()->find($id)->restore();
            return redirect('admin/hospital/bin')->with('restore', $name);
        }
    }


    // EDIT HOSPITAL
    function edit_hos($id)
    {
        $hospital = hospital::find($id);
        $city = city::all();
        $province = province::all();
        $ward = ward::all();
        return view('admin.hospitals.hospital.edit', compact('hospital', 'city', 'ward', 'province'));
    }

    function store_edit_hos(Request $request)
    {
        if ($request->submit_edit) {
            $request->validate(
                [
                    'name' => ['required', 'string', 'max:255'],
                    'address' => ['required', 'string', 'max:255'],
                    'city' => ['required', 'string', 'max:255'],
                    'province' => ['required', 'string', 'max:255'],
                    'ward' => ['required', 'string', 'max:255'],
                    'address' => ['required', 'string', 'max:255'],
                ],
                [
                    'required' => ':attribute không được để trống',
                ],
                [
                    'name' => 'Họ và tên',
                    'address' => 'Địa Chỉ',
                    'city' => 'Tỉnh/ Thành Phố',
                    'province' => 'Quận/ Huyện',
                    'ward' => 'Phường/ Xã',
                ]
            );

            $city = city::where('matp', $request->city)->first()->name_city;
            $province = province::where('maqh', $request->province)->first()->name_province;
            $ward = ward::where('xaid', $request->ward)->first()->name_wards;

            hospital::find($request->submit_edit)->update([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'city' => $city,
                'province' => $province,
                'ward' => $ward,
            ]);
            return redirect('admin/hospital')->with('update', $request->name);
        }
    }


    // LIST USER
    function users(Request $request)
    {
        session(['active' => 'user_list']);
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }

        $patients = patient::where('fullname', 'like', '%' . $keyword . '%')->orderByRaw('created_at DESC')
            ->paginate(8);
        return view('admin.users.list', compact('patients'));
    }


    // ADD user
    function add_users()
    {
        session(['active' => 'user_add']);
        $city = city::all();
        return view('admin.users.add', compact('city'));
    }
    function store_add_users(Request $request)
    {
        if ($request->input('submit')) {
            $request->validate(
                [
                    'id_card' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:5'],
                    'address' => ['required'],
                ],
                [
                    'required' => ':attribute không được để trống',
                    'email' => 'Email không đúng định dạng',
                    'regex' => ':attribute không đúng định dạng',
                ],
                [
                    'id_card' => 'CMND/CCCD',
                    'email' => 'Email',
                    'password' => 'Mật khẩu',
                    'city' => 'Tỉnh/ Thành Phố',
                    'district' => 'Quận/ Huyện',
                    'ward' => 'Phường/ Xã',
                ]
            );
            $city = city::where('matp', $request->city)->first()->name_city;
            $province = province::where('maqh', $request->province)->first()->name_province;
            $ward = ward::where('xaid', $request->ward)->first()->name_wards;

            patient::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'fullname' => $request->fullname,
                'id_card' => $request->id_card,
                'health_card' => $request->health_card,
                'gender' => $request->gender,
                'birthDate' => $request->birthDate,
                'job' => $request->job,
                'phone' => $request->phone,
                'address' => $request->address,
                'ward' => $ward,
                'district' => $province,
                'city' => $city,
                'country' => $request->country,
                'nation' => $request->nation,
            ]);
            return redirect('admin/users')->with('status', 'Tạo Mới Bệnh Viện Thành Công.');
        }
    }

    // DELETE BIN
    function delete_users($id_card)
    {

        if (patient::where('id_card', $id_card)) {
            $name = patient::where('id_card', $id_card)->first()->fullname;
            patient::where('id_card', $id_card)->delete();
            return redirect('admin/users')->with('delete', $name);
        }
    }
    function delete_user_bin($id_card)
    {
        if (patient::onlyTrashed()->where('id_card', $id_card)) {
            $name = patient::onlyTrashed()->where('id_card', $id_card)->first()->fullname;
            patient::onlyTrashed()->where('id_card', $id_card)->forceDelete();
            return redirect('admin/user/bin')->with('delete', $name);
        }
    }
    function bin_users(Request $request)
    {
        session(['active', 'user_bin']);
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }

        $patients = patient::onlyTrashed()->where('fullname', 'like', '%' . $keyword . '%')
            ->paginate(8);
        return view('admin.users.bin', compact('patients'));
    }
    function restore_users($id_card)
    {
        if (patient::onlyTrashed()->where('id_card', $id_card)) {
            $name = patient::onlyTrashed()->where('id_card', $id_card)->first()->fullname;
            patient::onlyTrashed()->where('id_card', $id_card)->restore();
            return redirect('admin/user/bin')->with('restore', $name);
        }
    }


    // EDIT user
    function edit_users($id_card)
    {
        $patient = patient::where('id_card', $id_card)->first();
        $city = city::all();
        $province = province::all();
        $ward = ward::all();
        return view('admin.users.edit', compact('patient', 'city', 'ward', 'province'));
    }
    function store_edit_users(Request $request)
    {
        if ($request->submit_edit) {
            $request->validate(
                [
                    'id_card' => ['required', 'string', 'max:255'],
                    'city' => ['required', 'string', 'max:255'],
                    'district' => ['required', 'string', 'max:255'],
                    'ward' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                ],
                [
                    'required' => ':attribute không được để trống',
                    'email' => 'Email không đúng định dạng',
                    'regex' => ':attribute không đúng định dạng',
                ],
                [
                    'id_card' => 'CMND/CCCD',
                    'email' => 'Email',
                    'city' => 'Tỉnh/ Thành Phố',
                    'province' => 'Quận/ Huyện',
                    'ward' => 'Phường/ Xã',
                ]
            );

            $city = city::where('matp', $request->city)->first()->name_city;
            $province = province::where('maqh', $request->province)->first()->name_province;
            $ward = ward::where('xaid', $request->ward)->first()->name_wards;

            patient::where('id_card', $request->submit_edit)->update([
                'email' => $request->email,
                'fullname' => $request->fullname,
                'id_card' => $request->id_card,
                'health_card' => $request->health_card,
                'gender' => $request->gender,
                'birthDate' => $request->birthDate,
                'job' => $request->job,
                'phone' => $request->phone,
                'address' => $request->address,
                'ward' => $ward,
                'district' => $province,
                'city' => $city,
                'country' => $request->country,
                'nation' => $request->nation,
            ]);
            return redirect('admin/users')->with('update', $request->name);
        }
    }

    function data_backup()
    {
        session(['active' => 'backup']);
        return view('admin.data.backup');
    }

    function data_restore()
    {
        session(['active' => 'restore']);
        return view('admin.data.restore');
    }

    public function our_backup_database(Request $request){
        $ar_hos = isset($request->hospitals)?$request->hospitals:''; 
        $ar_user = isset($request->users)?$request->users:''; 
        $ar_patient = isset($request->patients)?$request->patients:''; 
        
        //ENTER THE RELEVANT INFO BELOW
        $mysqlHostName      = env('DB_HOST');
        $mysqlUserName      = env('DB_USERNAME');
        $mysqlPassword      = env('DB_PASSWORD');
        $DbName             = env('DB_DATABASE');
        $backup_name        = "c1se10.sql";
        $tables             = array($ar_hos,$ar_user,$ar_patient); //here your tables...

        $connect = new \PDO("mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword",array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $get_all_table_query = "SHOW TABLES";
        $statement = $connect->prepare($get_all_table_query);
        $statement->execute();
        $result = $statement->fetchAll();


        $output = '';
        foreach($tables as $table)
        {
         $show_table_query = "SHOW CREATE TABLE " . $table . "";
         $statement = $connect->prepare($show_table_query);
         $statement->execute();
         $show_table_result = $statement->fetchAll();

         foreach($show_table_result as $show_table_row)
         {
          $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
         }
         $select_query = "SELECT * FROM " . $table . "";
         $statement = $connect->prepare($select_query);
         $statement->execute();
         $total_row = $statement->rowCount();

         for($count=0; $count<$total_row; $count++)
         {
          $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
          $table_column_array = array_keys($single_result);
          $table_value_array = array_values($single_result);
          $output .= "\nINSERT INTO $table (";
          $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
          $output .= "'" . implode("','", $table_value_array) . "');\n";
         }
        }
        $file_name = 'database_MTAC_backup_on_' . date('d-m-Y') . '.sql';
        $file_handle = fopen($file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
           header('Pragma: public');
           header('Content-Length: ' . filesize($file_name));
           ob_clean();
           flush();
           readfile($file_name);
           unlink($file_name);


}
}

