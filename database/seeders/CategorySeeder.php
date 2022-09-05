<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Photo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $electronic = Category::create([
            'title' => 'electronic-devices' ,
            'label' => 'کالای دیجیتال' ,
            'parent_id' => null
        ]);
        Photo::create([
            "name" => 'electronic-devices-category.jpg' ,
            "title" => 'electronic devices',
            "description" => 'electronic devices' ,
            "category_id" => 1 ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => null ,
            "path" => 'http://livewire.test/image/category/electronic-devices-category.jpg' ,
            "size" => '32770' ,
            "mime" => 'image/jpeg' ,
            "width" => '400' ,
            "height" => '300' ,
        ]);


        $mobile = Category::create([
            'title' => 'mobile' ,
            'label' => 'گوشی موبایل' ,
            'parent_id' => 1
        ]);
        Photo::create([
            "name" => 'mobile-category.jpg' ,
            "title" => 'mobile',
            "description" => 'mobile' ,
            "category_id" => 2 ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => null ,
            "path" => 'http://livewire.test/image/category/mobile-category.jpg' ,
            "size" => '37346' ,
            "mime" => 'image/jpeg' ,
            "width" => '400' ,
            "height" => '300' ,
        ]);


        $laptop = Category::create([
            'title' => 'laptop' ,
            'label' => 'لپ تاپ' ,
            'parent_id' => 1
        ]);
        Photo::create([
            "name" => 'laptop-category.jpg' ,
            "title" => 'laptop',
            "description" => 'laptop' ,
            "category_id" => 3 ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => null ,
            "path" => 'http://livewire.test/image/category/laptop-category.jpg' ,
            "size" => '22194' ,
            "mime" => 'image/jpeg' ,
            "width" => '400' ,
            "height" => '300' ,
        ]);


        $other = Category::create([
            'title' => 'other-mobile-devices' ,
            'label' => 'لوازم جانبی موبایل' ,
            'parent_id' => 2
        ]);
        Photo::create([
            "name" => 'otherMobile-category.jpg' ,
            "title" => 'other-mobile-devices',
            "description" => 'other-mobile-devices' ,
            "category_id" => 4 ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => null ,
            "path" => 'http://livewire.test/image/category/otherMobile-category.jpg' ,
            "size" => '29554' ,
            "mime" => 'image/jpeg' ,
            "width" => '400' ,
            "height" => '300' ,
        ]);

        $watch = Category::create([
            'title' => 'smart-watch' ,
            'label' => 'ساعت هوشمند' ,
            'parent_id' => 1
        ]);
        Photo::create([
            "name" => 'watch-category.jpg' ,
            "title" => 'smart-watch',
            "description" => 'smart-watch' ,
            "category_id" => 5 ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => null ,
            "path" => 'http://livewire.test/image/category/watch-category.jpg' ,
            "size" => '56015' ,
            "mime" => 'image/jpeg' ,
            "width" => '400' ,
            "height" => '300' ,
        ]);

    }
}
