<?php

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
        $this->call(ThemesTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(VotesTableSeeder::class);
    }
}
