<?php

use Illuminate\Database\Seeder;

class statusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            ['name' => 'TODO'],
            ['name' => 'DOING'],
            ['name' => 'DONE'],
        ]);
    }
}
