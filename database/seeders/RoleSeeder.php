<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
               'title' => 'normal-user' ,
                'label' => 'کاربر'
            ]);
        Role::create([
                'title' => 'super-admin' ,
                'label' => 'ادمین'
            ]);




    }
}
