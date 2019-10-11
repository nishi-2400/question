<?php

use Illuminate\Database\Seeder;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	'name' => 'yusuke',
        	'email' => 'yusuke@test.com',
        	'password' => 'testtest'
        ];

        DB::table('users')->insert($data);

        $data = [
            'name' => 'daisuke',
            'email' => 'daisuke@test.com',
            'password' => 'testtest'
        ];

        DB::table('users')->insert($data);

        $data = [
            'name' => 'kosuke',
            'email' => 'kosuke@test.com',
            'password' => 'testtest'
        ];

        DB::table('users')->insert($data);

        $data = [
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => 'testtest'
        ];

        DB::table('users')->insert($data);

        
    }
}
