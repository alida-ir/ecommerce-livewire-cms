<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        User::create([
            'name' => 'AliDa' ,
            'email' => 'info.alida.ir@gmail.com' ,
            'number' => '091212345678' ,
            'role_id' => 2 ,
            'approved' => 1 ,
            'approved_code' => '78520' ,
            'password' =>  Hash::make('12345678') ,
        ]);
    }
}
