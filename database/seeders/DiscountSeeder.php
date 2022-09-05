<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Discount::create([
            'name' => 'CreateWebsite' ,
            'quantity' => '25' ,
            'product_id' => '2' ,
            'category_id' => null ,
            'message' => 'none message !' ,
            'status' => true ,
            'expired' => now()->addDays(5) ,
        ]);
    }
}
