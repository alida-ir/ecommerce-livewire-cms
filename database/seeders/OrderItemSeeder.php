<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderItem::create([
            'order_id' => 1 ,
            'product_id' => 1 ,
            'price' => '5000000' ,
            'quantity' => 3 ,
            'total' => '15000000'
        ]);
        OrderItem::create([
            'order_id' => 1 ,
            'product_id' => 2 ,
            'price' => '1500000' ,
            'quantity' => 2 ,
            'total' => '3000000'
        ]);
    }
}
