<?php

use Illuminate\Database\Seeder;

class AdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('ads')->insert([
        'name' => 'Anuncio Seat León',
        'duration' => '00:00:25',
        'tipo' => 'Fill',
        'code' => '5465465465',
        'announcer' => 'Seat',
        ]);
        DB::table('ads')->insert([
        'name' => 'Anuncio Coca Cola',
        'duration' => '00:00:20',
        'tipo' => 'Sch',
        'code' => '6546546545',
        'announcer' => 'Coca Cola',
        ]);
        DB::table('ads')->insert([
        'name' => 'Panaderías Miguelito',
        'duration' => '00:00:15',
        'tipo' => 'Fill',
        'code' => '6546546598',
        'announcer' => 'Miguelillo Inc.',
        ]);
    }
}
