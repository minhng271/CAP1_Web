<?php

use App\patient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class patientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        patient::insert(
            [
                [
                    'id_card'   =>'132456798',
                    'fullname'  =>'Thái Bá Tuấn Anh',
                    'birthDate' => '2000-02-26',
                    'gender' => 'male',
                    'health_card' => '123456789123',
                    'phone'=> '0123465789',
                    'email'=> 'tuananh@gmail.com',
                    'job'=> 'student',
                    'address'=>'Quyết Thắng',
                    'ward'=>'Diễn Bích', 
                    'district'=>'Diễn Châu', 
                    'city'=>'Nghệ An', 
                    'country'=>'Việt Nam', 
                    'nation'=>'Kinh', 
                    'password'=>Hash::make('13246798') 
                ],
                [
                    'id_card'   =>'132476798',
                    'fullname'  =>'Nguyễn Ngọc Thùy Minh',
                    'birthDate' => '2000-01-27',
                    'gender' => 'female',
                    'health_card' => '123356789123',
                    'phone'=> '0123465719',
                    'email'=> 'thuyminh@gmail.com',
                    'job'=> 'student',
                    'address'=>'Quyết Thắng',
                    'ward'=>'Diễn Bích', 
                    'district'=>'Diễn Châu', 
                    'city'=>'Nghệ An', 
                    'country'=>'Việt Nam', 
                    'nation'=>'Kinh', 
                    'password'=>Hash::make('13246798') 
                ],
                [
                    'id_card'   =>'112456798',
                    'fullname'  =>'Mai Bá Long',
                    'birthDate' => '2000-02-21',
                    'gender' => 'male',
                    'health_card' => '123456739123',
                    'phone'=> '0123465782',
                    'email'=> 'balong@gmail.com',
                    'job'=> 'student',
                    'address'=>'Quyết Thắng',
                    'ward'=>'Diễn Bích', 
                    'district'=>'Diễn Châu', 
                    'city'=>'Nghệ An', 
                    'country'=>'Việt Nam', 
                    'nation'=>'Kinh', 
                    'password'=>Hash::make('13246798') 
                ],
                [
                    'id_card'   =>'116456798',
                    'fullname'  =>'Lê Hoàng Quốc Việt',
                    'birthDate' => '2000-02-13',
                    'gender' => 'male',
                    'health_card' => '123456799123',
                    'phone'=> '0123465786',
                    'email'=> 'quocviet@gmail.com',
                    'job'=> 'student',
                    'address'=>'Quyết Thắng',
                    'ward'=>'Diễn Bích', 
                    'district'=>'Diễn Châu', 
                    'city'=>'Nghệ An', 
                    'country'=>'Việt Nam', 
                    'nation'=>'Kinh', 
                    'password'=>Hash::make('13246798') 
                ],
                [
                    'id_card'   =>'132456123',
                    'fullname'  =>'Nguyễn Đỗ Quốc Huy',
                    'birthDate' => '2000-02-28',
                    'gender' => 'male',
                    'health_card' => '123456129123',
                    'phone'=> '0123465789',
                    'email'=> 'quochuy@gmail.com',
                    'job'=> 'student',
                    'address'=>'Quyết Thắng',
                    'ward'=>'Diễn Bích', 
                    'district'=>'Diễn Châu', 
                    'city'=>'Nghệ An', 
                    'country'=>'Việt Nam', 
                    'nation'=>'Kinh', 
                    'password'=>Hash::make('13246798') 

                ],
            ]
            );
    }
}
