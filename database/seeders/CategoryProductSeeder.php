<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::find(1)->categories()->attach(Category::find(1)->pluck('id'));
        Product::find(1)->categories()->attach(Category::find(2)->pluck('id'));
        Product::find(2)->categories()->attach(Category::find(1)->pluck('id'));
        Product::find(2)->categories()->attach(Category::find(3)->pluck('id'));
    }
}
