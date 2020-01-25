<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'スイカは野菜か果物か？',
            'option_a' => '野菜',
            'option_b' => '果物',
            'created_at' => Carbon::now(), 
            'updated_at' => Carbon::now(),
        ];
        DB::table('themes')->insert($param);
        $param = [
            'name' => 'お茶といえば緑茶か麦茶か？',
            'option_a' => '緑茶',
            'option_b' => '麦茶',
            'created_at' => Carbon::now(), 
            'updated_at' => Carbon::now(),
        ];
        DB::table('themes')->insert($param);
        $param = [
            'name' => '田伏は人参に似ているか似ていないか？',
            'option_a' => '似ている',
            'option_b' => '似ていない',
            'created_at' => Carbon::now(), 
            'updated_at' => Carbon::now(),
        ];
        DB::table('themes')->insert($param);
    }
}
