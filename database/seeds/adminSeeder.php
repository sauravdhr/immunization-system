<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'id' => 'admin',
            'password' => '512110809',
			'first_name' => 'admin'	,
			'last_name' => 'admin',
			'gender' => ' ',
			'designation' => 'admin',
			'mobile_no' => ' ',
			'address' => ' ',
			'email' => ' '
        ]);
    }
}
