<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class hospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hospitals')->insert([
            'name' => 'fakername',
            'address' => "12a",
            'ward' => 'Phường Thanh Khê Tây',
            'province' => 'Quận Thanh Khê',
            'city' => 'Thành Phố Đà Nẵng',
        ]);
    }
}
