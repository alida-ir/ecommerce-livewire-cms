<?php

namespace Database\Seeders;

use App\Models\Photo;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'title' => 'name' ,
            'value' => 'فروشگاه اینترنتی'
        ]);

        Setting::create([
            'title' => 'title' ,
            'value' => 'فروشگاه'
        ]);

        Setting::create([
            'title' => 'logo' ,
            'value' => asset('image/logo/logo.png')
        ]);

        Setting::create([
            'title' => 'favicon' ,
            'value' => asset('image/logo/favicon.png')
        ]);

        Setting::create([
            'title' => 'address' ,
            'value' => 'تهران ؛ آزادی کوچه آزادی پلاک ۱۴ طبقه اول'
        ]);

        Setting::create([
            'title' => 'number' ,
            'value' => '09224316017'
        ]);

        Setting::create([
            'title' => 'email' ,
            'value' => 'info.alida.ir@gmail.com'
        ]);

        Setting::create([
            'title' => 'telegram' ,
            'value' => 'alida_ir'
        ]);

        Setting::create([
            'title' => 'instagram' ,
            'value' => 'alida_ir'
        ]);

        Setting::create([
            'title' => 'twitter' ,
            'value' => 'alida_ir'
        ]);

        Setting::create([
            'title' => 'AllCategoryInMenu' ,
            'value' => true
        ]);

        Setting::create([
            'title' => 'menu' ,
            'value' => '1'
        ]);

        Setting::create([
            'title' => 'menu' ,
            'value' => '2'
        ]);

        Setting::create([
            'title' => 'menu' ,
            'value' => '3'
        ]);

        Setting::create([
            'title' => 'menu' ,
            'value' => '4'
        ]);

        Setting::create([
            'title' => 'menu' ,
            'value' => '5'
        ]);


        Setting::create([
            'title' => 'quickAccess' ,
            'value' => 'صفحه اصلی'
        ]);

        Setting::create([
            'title' => 'quickAccess' ,
            'value' => env('APP_URL')
        ]);


        Setting::create([
            'title' => 'quickAccess' ,
            'value' => 'محصولات'
        ]);

        Setting::create([
            'title' => 'quickAccess' ,
            'value' => route('categories.index')
        ]);

        Setting::create([
            'title' => 'quickAccess' ,
            'value' => 'بگرد و پیدا کن'
        ]);

        Setting::create([
            'title' => 'quickAccess' ,
            'value' => route('search')
        ]);

        Setting::create([
            'title' => 'quickAccess' ,
            'value' => 'پنل کاربری'
        ]);

        Setting::create([
            'title' => 'quickAccess' ,
            'value' => route('dashboard')
        ]);



        Setting::create([
            'title' => 'showSlider' ,
            'value' => true
        ]);


        $sliderOne = Setting::create([
            'title' => 'slider' ,
            'value' => route('categories.item' , 'electronic-devices')
        ]);

        Photo::create([
            "name" => 'slider-1.jpg' ,
            "title" => 'slider',
            "description" => 'slider' ,
            "setting_id" => $sliderOne['id'] ,
            "path" => env('APP_URL') . '/image/slider/slider-1.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '250' ,
            "height" => '1266' ,
        ]);


        $sliderTwo = Setting::create([
            'title' => 'slider' ,
            'value' => route('categories.item' , 'mobile')
        ]);


        Photo::create([
            "name" => 'slider-2.jpg' ,
            "title" => 'slider',
            "description" => 'slider' ,
            "category_id" => null ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => null ,
            "setting_id" => $sliderTwo->id ,
            "path" => env('APP_URL') . '/image/slider/slider-2.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '250' ,
            "height" => '1266' ,
        ]);




        $sliderTree = Setting::create([
            'title' => 'slider' ,
            'value' => route('categories.item' , 'laptop')
        ]);

        Photo::create([
            "name" => 'slider-3.jpg' ,
            "title" => 'slider',
            "description" => 'slider' ,
            "category_id" => null ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => null ,
            "setting_id" => $sliderTree->id ,
            "path" => env('APP_URL') . '/image/slider/slider-3.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '250' ,
            "height" => '1266' ,
        ]);



        $sliderFour = Setting::create([
            'title' => 'slider' ,
            'value' => route('categories.item' , 'other-mobile-devices')
        ]);

        Photo::create([
            "name" => 'slider-4.jpg' ,
            "title" => 'slider',
            "description" => 'slider' ,
            "category_id" => null ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => null ,
            "setting_id" => $sliderFour->id ,
            "path" => env('APP_URL') . '/image/slider/slider-4.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '250' ,
            "height" => '1266' ,
        ]);


        Setting::create([
            'title' => 'showOneBanner' ,
            'value' => true
        ]);
        Setting::create([
            'title' => 'showTwoBanner' ,
            'value' => true
        ]);

        $bannerOne = Setting::create([
            'title' => 'oneBanner' ,
            'value' => route('categories.index')
        ]);
        Photo::create([
            "name" => 'link-1.jpg' ,
            "title" => 'link',
            "description" => 'link' ,
            "category_id" => null ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => null ,
            "setting_id" => $bannerOne->id ,
            "path" => env('APP_URL') . '/image/banner/link-1.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '250' ,
            "height" => '1266' ,
        ]);


        $bannerTwo = Setting::create([
            'title' => 'twoBanner' ,
            'value' => route('categories.index')
        ]);
        Photo::create([
            "name" => 'link-2.jpg' ,
            "title" => 'link',
            "description" => 'link' ,
            "category_id" => null ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => null ,
            "setting_id" => $bannerTwo->id ,
            "path" => env('APP_URL') . '/image/banner/link-2.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '250' ,
            "height" => '1266' ,
        ]);




        Setting::create([
            'title' => 'showLastProduct' ,
            'value' => true
        ]);


        Setting::create([
            'title' => 'categoryFirstPage' ,
            'value' => 1
        ]);
    }
}
