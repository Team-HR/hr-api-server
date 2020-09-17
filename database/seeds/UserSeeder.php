<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'Franz Joshua Valencia',
            'username' => 'fjavalencia',
            'roles' => json_encode(['sys_admin']),
            'password' => Hash::make('1234'),
        ]);
        DB::table('users')->insert([
            'name' => 'Jane Doe',
            'username' => 'jdoe',
            'roles' => json_encode(['sys_admin']),
            'password' => Hash::make('1234'),
        ]);
    }
}
