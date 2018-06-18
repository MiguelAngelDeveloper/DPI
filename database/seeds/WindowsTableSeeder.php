<?php

use Illuminate\Database\Seeder;

class WindowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('windows')->insert([
        'init_date' => '2018-06-17 00:00:00',
        'channel_id' => 1,
        'duration' => '05:00',
        ]);
        DB::table('windows')->insert([
        'init_date' => '2018-06-17 06:00:00',
        'channel_id' => 1,
        'duration' => '03:00',
        ]);
    }
}
