<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1, 3) as $num) {
            DB::table('users')->insert([
                'name' => 'タブセ',
                'email' => 'bububutase.0107+' . $num .'@gmail.com',
                'password' => 'tabuse' . $num,
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
