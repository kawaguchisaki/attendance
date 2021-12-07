<?php

use Illuminate\Database\Seeder;

class HousemakersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('housemakers')->insert([
            'company' => '株式会社テラビックキョーワ',
            'get_help' => 0,
        ]);
    }
}
