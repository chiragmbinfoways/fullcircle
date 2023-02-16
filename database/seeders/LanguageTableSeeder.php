<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $action=[
            [
                'name' => 'English',
                'slug' => 'en',
            ]
        ];
            DB::table('languages')->insert($action);
    }
}
