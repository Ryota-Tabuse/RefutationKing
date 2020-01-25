<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = '下から生えるものは、「野菜」という通説がありますが、それに則るとスイカは野菜とするのが定説ではあるまいか。';
        $this->insertParam($content, 4, 2, 3 );
        
        $content = '落ち着け、スイカは甘い。甘いものは全て果物と決まっているではないか。他の果物は全て甘い。よって甘いものは全て果物なのです。';
        $this->insertParam($content, 4, 3, 2 );

        $content = '選ばれたのは、綾鷹ですよね？ということは緑茶ということになりませんか？';
        $this->insertParam($content, 5, 3, 2 );
        
        $content = 'そうきましたか、完敗です。麦茶を乾杯。';
        $this->insertParam($content, 5, 2, 3 );

        $content = '顎がとても鋭く、輪郭が同じである。よって似ているのである。';
        $this->insertParam($content, 6, 1, 5 );
        
        $content = '野菜と人間が似ていることは断じてない！';
        $this->insertParam($content, 6, 5, 1 );
    }

    private function insertParam($content, $room_id, $sending_user_id,$recieving_user_id ) {
        $param = [
            'content' => $content,
            'room_id' => $room_id,
            'sending_user_id' => $sending_user_id,
            'recieving_user_id' => $recieving_user_id,
            'created_at' => Carbon::now(), 
            'updated_at' => Carbon::now(),
        ];
        DB::table('comments')->insert($param);
    }
}
