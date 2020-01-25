<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '暇です！誰か！',
            'thema_id' => 1,
            'option_a_user_id' => 2,
            'option_b_user_id' => 3,
            'created_at' => Carbon::now(), 
            'updated_at' => Carbon::now(),
        ];
        DB::table('rooms')->insert($param);
        $param = [
            'name' => '喉渇いた',
            'thema_id' => 2,
            'option_a_user_id' => 3,
            'option_b_user_id' => 2,
            'created_at' => Carbon::now(), 
            'updated_at' => Carbon::now(),
        ];
        DB::table('rooms')->insert($param);
        $param = [
            'name' => '正味どうでもいい',
            'thema_id' => 3,
            'option_a_user_id' => 1,
            'option_b_user_id' => 5,
            'created_at' => Carbon::now(), 
            'updated_at' => Carbon::now(),
        ];
        DB::table('rooms')->insert($param);

    }
}
