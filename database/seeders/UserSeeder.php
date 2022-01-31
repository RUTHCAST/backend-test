<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	[
	        	'name' => 'admin',
	        	'email' => 'admin@admin.com',
	        	'password' => '$2y$10$sB9zKFIzNbm9ZYqN47HhEurImVT3tIrYJl5XtfBcJy9CbEHq1dna6'
        	],
        ]);
    }
}
