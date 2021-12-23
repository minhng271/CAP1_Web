<?php

use App\hospital;
use App\patient;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([
        //     users::class
        // ]);

        factory(hospital::class,2)->create();
    }
}
