<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Warehouse::create([
            'product_id' => 1 ,
            'color' => "سفید" ,
            'hex' => "#FFF" ,
            'available' => true ,
            'quantity' => 10 ,
            'price' => '3900000' ,
            'transportation_cost' => 35000
        ]);
        Warehouse::create([
            'product_id' => 1 ,
            'color' => "مشکی" ,
            'hex' => "#000" ,
            'available' => true ,
            'quantity' => 15 ,
            'price' => '3900000' ,
            'transportation_cost' => 35000
        ]);
        Warehouse::create([
            'product_id' => 2 ,
            'color' => "مشکی" ,
            'hex' => "#000" ,
            'available' => true ,
            'quantity' => 15 ,
            'price' => '1500000' ,
            'transportation_cost' => 35000
        ]);
        Warehouse::create([
            'product_id' => 3 ,
            'color' => "مشکی" ,
            'hex' => "#000" ,
            'available' => true ,
            'quantity' => 15 ,
            'price' => '9900000' ,
            'transportation_cost' => 35000
        ]);
        Warehouse::create([
            'product_id' => 4 ,
            'color' => "سفید" ,
            'hex' => "#fff" ,
            'available' => true ,
            'quantity' => 15 ,
            'price' => '580000' ,
            'transportation_cost' => 35000
        ]);
    }
}
