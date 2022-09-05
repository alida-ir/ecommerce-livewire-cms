<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        $normalUser = \App\Models\Role::where('title' , 'normal-user')->first();
        $permissionUser = Permission::where('title' , 'show-self-order')->orWhere('title' , 'show-self-trans-action')->orWhere('title' , 'show-user-monitoring')->pluck('id');
        $normalUser->permissions()->attach($permissionUser);


        $superAdmin = \App\Models\Role::where('title' , 'super-admin')->first();
        $permissionAdmin = Permission::all()->except([46 , 43 , 48]);
        $superAdmin->permissions()->attach($permissionAdmin);

    }
}
