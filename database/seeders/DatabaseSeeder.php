<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class ,
            PermissionSeeder::class ,
            PermissionRoleSeeder::class ,
            UserSeeder::class ,
            CategorySeeder::class ,
            BrandSeeder::class ,
            ProductSeeder::class ,
            WarehouseSeeder::class ,
            OrderSeeder::class ,
            OrderItemSeeder::class ,
            DiscountSeeder::class ,
            SettingSeeder::class ,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
