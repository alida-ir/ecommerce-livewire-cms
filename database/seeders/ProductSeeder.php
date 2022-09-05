<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::create([
            'user_id' => 1,
            'brand_id' => 1 ,
            'name' => 'گوشی موبایل موتورولا' ,
            'price' => '3900000' ,
            'content' => '<p>test</p>' ,
            'keywords' => "گوشی,موبایل,موبایل ارزان,گوشی موتورولا,گوشی با کیفیت,گوشی ارزان" ,
            'description' => "گوشی با کیفیت موتورولا با درصد رضایت بالا و قیمت مناسب با دوربین باکیفیت مناسب برای عکاسی"
        ]);
        $product->categories()->attach([1 , 2]);
        Photo::create([
            "name" => 'mobile-1.jpg' ,
            "title" => 'mobile',
            "description" => 'mobile' ,
            "category_id" => null ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => 1 ,
            "path" => env('APP_URL') . '/image/product/mobile-1.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '800' ,
            "height" => '800' ,
        ]);
        Photo::create([
            "name" => 'mobile-2.jpg' ,
            "title" => 'mobile',
            "description" => 'mobile' ,
            "category_id" => null ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => 1 ,
            "path" => env('APP_URL') . '/image/product/mobile-2.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '800' ,
            "height" => '800' ,
        ]);
        Photo::create([
            "name" => 'mobile-3.jpg' ,
            "title" => 'mobile',
            "description" => 'mobile' ,
            "category_id" => null ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => 1 ,
            "path" => env('APP_URL') . '/image/product/mobile-3.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '800' ,
            "height" => '800' ,
        ]);
        Photo::create([
            "name" => 'mobile-4.jpg' ,
            "title" => 'mobile',
            "description" => 'mobile' ,
            "category_id" => null ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => 1 ,
            "path" => env('APP_URL') . '/image/product/mobile-4.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '800' ,
            "height" => '800' ,
        ]);


        $product2 = Product::create([
            'user_id' => 1,
            'brand_id' => 2,
            'name' => 'ساعت شیائومی Mi band 7' ,
            'price' => '1500000' ,
            'content' => '<p>test</p>',
            'keywords' => "ساعت,ساعت ارزان,ساعت شیائومی,ساعت با کیفیت,ساعت شیائومی ارزان" ,
            'description' => "ساعت با کیفیت شیائومی با درصد رضایت بالا و قیمت مناسب با حسگر های متنوع و باکیفیت مناسب برای ورزشکاران"
        ]);
        $product2->categories()->attach([1 , 5]);
        Photo::create([
            "name" => 'watch-1.jpg' ,
            "title" => 'watch',
            "description" => 'watch' ,
            "category_id" => null ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => 2 ,
            "path" => env('APP_URL') . '/image/product/watch-1.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '800' ,
            "height" => '800' ,
        ]);
        Photo::create([
            "name" => 'watch-2.jpg' ,
            "title" => 'watch',
            "description" => 'watch' ,
            "category_id" => null ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => 2 ,
            "path" => env('APP_URL') . '/image/product/watch-2.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '800' ,
            "height" => '800' ,
        ]);
        Photo::create([
            "name" => 'watch-3.jpg' ,
            "title" => 'watch',
            "description" => 'watch' ,
            "category_id" => null ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => 2 ,
            "path" => env('APP_URL') . '/image/product/watch-3.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '800' ,
            "height" => '800' ,
        ]);
        Photo::create([
            "name" => 'watch-4.jpg' ,
            "title" => 'watch',
            "description" => 'watch' ,
            "category_id" => null ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => 2 ,
            "path" => env('APP_URL') . '/image/product/watch-4.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '800' ,
            "height" => '800' ,
        ]);

        $product3 = Product::create([
            'user_id' => 1,
            'brand_id' => 3,
            'name' => 'لپ تاپ 14 اینچی ایسوس مدل R465FA-EB028' ,
            'price' => '9990000' ,
            'content' => '<p>test</p>',
            'keywords' => "لپ تاپ,لپ تاپ ارزان,لپ تاپ ایسوس,لپ تاپ با کیفیت,لپ تاپ ایسوس ارزان" ,
            'description' => "لپ تاپ با کیفیت ایسوس با درصد رضایت بالا و قیمت مناسب با رم ۸ گیگ مناسب برای برنامه نویسان"
        ]);
        $product3->categories()->attach([1 , 3]);
        Photo::create([
            "name" => 'laptop-1.jpg' ,
            "title" => 'laptop',
            "description" => 'laptop' ,
            "category_id" => null ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => 3 ,
            "path" => env('APP_URL') . '/image/product/laptop-1.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '800' ,
            "height" => '800' ,
        ]);
        Photo::create([
            "name" => 'laptop-2.jpg' ,
            "title" => 'laptop',
            "description" => 'laptop' ,
            "category_id" => null ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => 3,
            "path" => env('APP_URL') . '/image/product/laptop-2.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '800' ,
            "height" => '800' ,
        ]);
        Photo::create([
            "name" => 'laptop-3.jpg' ,
            "title" => 'laptop',
            "description" => 'laptop' ,
            "category_id" => null ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => 3,
            "path" => env('APP_URL') . '/image/product/laptop-3.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '800' ,
            "height" => '800' ,
        ]);
        Photo::create([
            "name" => 'laptop-4.jpg' ,
            "title" => 'laptop',
            "description" => 'laptop' ,
            "category_id" => null ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => 3,
            "path" => env('APP_URL') . '/image/product/laptop-4.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '800' ,
            "height" => '800' ,
        ]);

        $product4 = Product::create([
            'user_id' => 1,
            'brand_id' => 2,
            'name' => 'شارژر همراه شیائومی مدل Redmi ظرفیت 20000 میلی آمپرساعت' ,
            'price' => '580000' ,
            'content' => '<p>test</p>',
            'keywords' => "شارژر همراه,شارژر همراه ارزان,شارژر همراه شیائومی,شارژر همراه با کیفیت,شارژر همراه شیائومی ارزان" ,
            'description' => "شارژر همراه با کیفیت شیائومی با درصد رضایت بالا و قیمت مناسب با قابلیت نگه داری شارژ تا ۲ روز"
        ]);
        $product4->categories()->attach([1 , 4]);
        Photo::create([
            "name" => 'power-1.jpg' ,
            "title" => 'power',
            "description" => 'power' ,
            "category_id" => null ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => 4,
            "path" => env('APP_URL') . '/image/product/power-1.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '800' ,
            "height" => '800' ,
        ]);
        Photo::create([
            "name" => 'power-2.jpg' ,
            "title" => 'power',
            "description" => 'power' ,
            "category_id" => null ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => 4 ,
            "path" => env('APP_URL') . '/image/product/power-2.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '800' ,
            "height" => '800' ,
        ]);
        Photo::create([
            "name" => 'power-3.jpg' ,
            "title" => 'power',
            "description" => 'power' ,
            "category_id" => null ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => 4 ,
            "path" => env('APP_URL') . '/image/product/power-3.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '800' ,
            "height" => '800' ,
        ]);
        Photo::create([
            "name" => 'power-4.jpg' ,
            "title" => 'power',
            "description" => 'power' ,
            "category_id" => null ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => 4,
            "path" => env('APP_URL') . '/image/product/power-4.jpg' ,
            "size" => '108526' ,
            "mime" => 'image/jpeg' ,
            "width" => '800' ,
            "height" => '800' ,
        ]);


    }
}
