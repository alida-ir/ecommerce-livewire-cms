<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Photo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'title' =>'motorola' ,
            'label' =>  'موتورولا'  ,
        ]);

        Brand::create([
            'title' => 'xiaomi' ,
            'label' => 'شیائومی' ,
        ]);

        Brand::create([
            'title' => 'asus' ,
            'label' => 'ایسوس' ,
        ]);

    }
}
