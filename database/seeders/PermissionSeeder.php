<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permission
        Permission::create([
            'title' => 'create-permission' ,
            'label' => 'ایجاد دسترسی'
        ]);
        Permission::create([
            'title' => 'update-permission' ,
            'label' => 'ویرایش دسترسی'
        ]);
        Permission::create([
            'title' => 'show-permission' ,
            'label' => 'مشاهده دسترسی'
        ]);
        Permission::create([
            'title' => 'delete-permission' ,
            'label' => 'حذف دسترسی'
        ]);

        //Role
        Permission::create([
            'title' => 'create-role' ,
            'label' => 'ایجاد سطح دسترسی'
        ]);
        Permission::create([
            'title' => 'update-role' ,
            'label' => 'ویرایش سطح دسترسی'
        ]);
        Permission::create([
            'title' => 'show-role' ,
            'label' => 'مشاهده سطح دسترسی'
        ]);
        Permission::create([
            'title' => 'delete-role' ,
            'label' => 'حذف سطح دسترسی'
        ]);

        //User
        Permission::create([
            'title' => 'create-user' ,
            'label' => 'ایجاد کاربر'
        ]);
        Permission::create([
            'title' => 'update-user' ,
            'label' => 'ویرایش کاربر'
        ]);
        Permission::create([
            'title' => 'show-user' ,
            'label' => 'مشاهده کاربر'
        ]);
        Permission::create([
            'title' => 'delete-user' ,
            'label' => 'حذف کاربر'
        ]);

        //Product
        Permission::create([
            'title' => 'create-product' ,
            'label' => 'ایجاد محصول'
        ]);
        Permission::create([
            'title' => 'update-product' ,
            'label' => 'ویرایش محصول'
        ]);
        Permission::create([
            'title' => 'show-product' ,
            'label' => 'مشاهده محصول'
        ]);
        Permission::create([
            'title' => 'delete-product' ,
            'label' => 'حذف محصول'
        ]);

        //Category
        Permission::create([
            'title' => 'show-category' ,
            'label' => 'مشاهده دسته بندی'
        ]);
        Permission::create([
            'title' => 'update-category' ,
            'label' => 'ویرایش دسته بندی'
        ]);
        Permission::create([
            'title' => 'create-category' ,
            'label' => 'ایجاد دسته بندی'
        ]);
        Permission::create([
            'title' => 'delete-category' ,
            'label' => 'حذف دسته بندی'
        ]);

        //Brand
        Permission::create([
            'title' => 'show-brand' ,
            'label' => 'مشاهده برند ها'
        ]);
        Permission::create([
            'title' => 'create-brand' ,
            'label' => 'ایجاد برند'
        ]);
        Permission::create([
            'title' => 'update-brand' ,
            'label' => 'ویرایش برند'
        ]);
        Permission::create([
            'title' => 'delete-brand' ,
            'label' => 'حذف برند'
        ]);

        //Photo
        Permission::create([
            'title' => 'show-photo' ,
            'label' => 'مشاهده گالری تصویر ها'
        ]);
        Permission::create([
            'title' => 'create-photo' ,
            'label' => 'ایجاد گالری تصویر'
        ]);
        Permission::create([
            'title' => 'update-photo' ,
            'label' => 'ویرایش گالری تصویر'
        ]);
        Permission::create([
            'title' => 'delete-photo' ,
            'label' => 'حذف گالری تصویر'
        ]);

        //Discount
        Permission::create([
            'title' => 'show-discount' ,
            'label' => 'مشاهده تخفیف ها'
        ]);
        Permission::create([
            'title' => 'create-discount' ,
            'label' => 'ایجاد تخفیف ها'
        ]);
        Permission::create([
            'title' => 'update-discount' ,
            'label' => 'ویرایش تخفیف ها'
        ]);
        Permission::create([
            'title' => 'delete-discount' ,
            'label' => 'حذف تخفیف ها'
        ]);

        //Discount
        Permission::create([
            'title' => 'show-warehouse' ,
            'label' => 'مشاهده انبار'
        ]);
        Permission::create([
            'title' => 'create-warehouse' ,
            'label' => 'ایجاد موجودی'
        ]);
        Permission::create([
            'title' => 'update-warehouse' ,
            'label' => 'ویرایش موجودی'
        ]);
        Permission::create([
            'title' => 'delete-warehouse' ,
            'label' => 'حذف موجودی'
        ]);


        //Order
        Permission::create([
            'title' => 'show-order' ,
            'label' => 'مشاهده سفارشات'
        ]);
        Permission::create([
            'title' => 'create-order' ,
            'label' => 'ایجاد سفارشات'
        ]);
        Permission::create([
            'title' => 'update-order' ,
            'label' => 'ویرایش سفارشات'
        ]);
        Permission::create([
            'title' => 'delete-order' ,
            'label' => 'حذف سفارشات'
        ]);


        //Setting
        Permission::create([
            'title' => 'show-setting' ,
            'label' => 'مشاهده تنظیمات'
        ]);
        Permission::create([
            'title' => 'update-setting' ,
            'label' => 'ویرایش تنظیمات'
        ]);

        //TransAction
        Permission::create([
            'title' => 'show-self-trans-action' ,
            'label' => 'مشاهده تراکنش های شخصی'
        ]);
        Permission::create([
            'title' => 'show-all-trans-action' ,
            'label' => 'مشاهده همه تراکنش ها'
        ]);

        //Order
        Permission::create([
            'title' => 'show-all-order' ,
            'label' => 'مشاهده همه سفارشات'
        ]);
        Permission::create([
            'title' => 'show-self-order' ,
            'label' => 'مشاهده سفارشات شخصی'
        ]);

        //Monitoring
        Permission::create([
            'title' => 'show-admin-monitoring' ,
            'label' => 'مشاهده مانیتورینگ ادمین'
        ]);
        //Monitoring
        Permission::create([
            'title' => 'show-user-monitoring' ,
            'label' => 'مشاهده مانیتورینگ کاربر'
        ]);

    }
}
