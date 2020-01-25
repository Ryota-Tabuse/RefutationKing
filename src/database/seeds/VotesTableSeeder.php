<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertParam(1, 3, 'A');
        $this->insertParam(1, 4, 'A');
        $this->insertParam(1, 9, 'B');
        $this->insertParam(1, 6, 'A');
        $this->insertParam(2, 1, 'A');
        $this->insertParam(2, 4, 'A');
        $this->insertParam(2, 9, 'B');
        $this->insertParam(2, 6, 'A');
        $this->insertParam(3, 2, 'A');
        $this->insertParam(3, 4, 'A');
        $this->insertParam(3, 12, 'B');
        $this->insertParam(3, 6, 'A');
        $this->insertParam(4, 1, 'A');
        $this->insertParam(4, 4, 'A');
        $this->insertParam(4, 9, 'B');
        $this->insertParam(4, 6, 'A');
        $this->insertParam(5, 1, 'A');
        $this->insertParam(5, 4, 'A');
        $this->insertParam(5, 9, 'B');
        $this->insertParam(5, 6, 'A');
        $this->insertParam(6, 2, 'A');
        $this->insertParam(6, 4, 'A');
        $this->insertParam(6, 12, 'B');
        $this->insertParam(6, 6, 'A');
    }

    private function insertParam($room_id, $vote_user_id, $vote_result) {
        $param = [
            'room_id' => $room_id,
            'vote_user_id' => $vote_user_id,
            'vote_result' => $vote_result,
            'created_at' => Carbon::now(), 
            'updated_at' => Carbon::now(),
        ];
        DB::table('votes')->insert($param);
    }
}
