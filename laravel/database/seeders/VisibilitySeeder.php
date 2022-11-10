<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisibilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('visibilities')->insert([
            'name' => "public",
        ]);
        DB::table('visibilities')->insert([
            'name' => "contacts",
        ]);
        DB::table('visibilities')->insert([
            'name' => "private",
        ]);
    }
}
