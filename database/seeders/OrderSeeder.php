<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::create([
            'user_id' => 1 ,
            'transportation_cost' => '25000' ,
            'transportation_cost_status' => false ,
            'total_price' => 0 ,
            'payment_price' => 0 ,
            'payment_status' => false ,
            'zip_code' => '181626354' ,
            'address' => 'Iran , Tehran , Mosalla , Kooche Abedi ' ,
            'state' => 'Tehran' ,
        ]);
    }
}
