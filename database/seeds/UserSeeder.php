<?php

use Illuminate\Database\Seeder;

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
            'name' => 'Hoàng Văn Dương',
            'email' => 'hduong1207.uet@gmail.com',
            'password' => Hash::make('12071998'),
        ]);
    }
}
