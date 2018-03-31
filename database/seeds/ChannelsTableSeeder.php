<?php

use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('channels')->insert([
        'name' => 'CH1',
        'code' => '01',
        'zone' => '001',
        ]);
        DB::table('channels')->insert([
        'name' => 'CH2',
        'code' => '02',
        'zone' => '002',
        ]);
        DB::table('channels')->insert([
        'name' => 'CH3',
        'code' => '03',
        'zone' => '003',
        ]);
    }
}
