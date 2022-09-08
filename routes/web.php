<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Payment\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire;

Route::get('/', Livewire\Home::class)->name('home');
Route::get('/search', Livewire\Web\Search\Index::class)->name('search');

Route::get('products' , Livewire\Web\Product\Index::class)->name('products');
Route::get('product/{slug}' , Livewire\Web\Product\Show::class)->name('product.item');
Route::get('checkout/cart' , Livewire\Web\Cart\Index::class)->name('checkout.index');


Route::get('categories' , Livewire\Web\Categories\Index::class)->name('categories.index');
Route::get('categories/{slug}' , Livewire\Web\Categories\Item::class)->name('categories.item');

Route::get('/pay/callback' , [PaymentController::class , 'callback'])->middleware('auth:web')->name('pay.callback');
Route::get('/pay/fail' , [PaymentController::class , 'fail'])->name('pay.fail')->middleware('auth:web');


Route::middleware('guest')->group(function () {
    Route::get('login', Livewire\Home\Login\Index::class)->name('login');
    Route::get('reset-password/{token}', Livewire\Home\Password\ResetPassword::class)->name('password.reset');
});


Route::prefix('dashboard')->middleware('auth:web')->group(function (){
    Route::get('/users' , Livewire\Dashboard\User\Index::class)->name('users.index');
    Route::get('/user/{id}/edit' , Livewire\Dashboard\User\Edit::class)->name('users.edit');
    Route::get('/user/create' , Livewire\Dashboard\User\Create::class)->name('users.create');

    Route::get('/roles'  , Livewire\Dashboard\Role\Index::class)->name('role.index');
    Route::get('/role/{id}/edit'  , Livewire\Dashboard\Role\Edit::class)->name('role.edit');
    Route::get('/role/create'  , Livewire\Dashboard\Role\Create::class)->name('role.create');

    Route::get('/permissions'  , Livewire\Dashboard\Permission\Index::class)->name('permission.index');
    Route::get('/permission/{id}/edit'  , Livewire\Dashboard\Permission\Edit::class)->name('permission.edit');
    Route::get('/permission/create'  , Livewire\Dashboard\Permission\Create::class)->name('permission.create');

    Route::get('/categories'  , Livewire\Dashboard\Category\Index::class)->name('category.index');
    Route::get('/category/{id}/edit'  , Livewire\Dashboard\Category\Edit::class)->name('category.edit');
    Route::get('/category/create'  , Livewire\Dashboard\Category\Create::class)->name('category.create');

    Route::get('/brands'  , Livewire\Dashboard\Brand\Index::class)->name('brand.index');
    Route::get('/brand/{id}/edit'  , Livewire\Dashboard\Brand\Edit::class)->name('brand.edit');
    Route::get('/brand/create'  , Livewire\Dashboard\Brand\Create::class)->name('brand.create');

    Route::get('/products'  , Livewire\Dashboard\Product\Index::class)->name('product.index');
    Route::get('/product/{id}/edit'  , Livewire\Dashboard\Product\Edit::class)->name('product.edit');
    Route::get('/product/create'  , Livewire\Dashboard\Product\Create::class)->name('product.create');

    Route::get('/discounts'  , Livewire\Dashboard\Discount\Index::class)->name('discount.index');
    Route::get('/discount/{id}/edit'  , Livewire\Dashboard\Discount\Edit::class)->name('discount.edit');
    Route::get('/discount/create'  , Livewire\Dashboard\Discount\Create::class)->name('discount.create');

    Route::get('/warehouses'  , Livewire\Dashboard\Warehouse\Index::class)->name('warehouse.index');
    Route::get('/warehouse/{id}/edit'  , Livewire\Dashboard\Warehouse\Edit::class)->name('warehouse.edit');
    Route::get('/warehouse/create'  , Livewire\Dashboard\Warehouse\Create::class)->name('warehouse.create');

    Route::get('/payments'  , Livewire\Dashboard\Payment\Index::class)->name('payment.index');

    Route::get('/orders'  , Livewire\Dashboard\Order\Index::class)->name('order.index');
    Route::get('/order/{id}/detail'  , Livewire\Dashboard\Order\Detail::class)->name('order.detail');

    Route::get('/settings'  , Livewire\Dashboard\Setting\Index::class)->name('setting.index');
    Route::get('/settings/menu'  , Livewire\Dashboard\Setting\Menu::class)->name('setting.menu');
    Route::get('/settings/slider'  , Livewire\Dashboard\Setting\Slider::class)->name('setting.slider');
    Route::get('/settings/banner'  , Livewire\Dashboard\Setting\Banner::class)->name('setting.banner');

    Route::post('/upload'  , [DashboardController::class , 'upload'])->name('editor-upload');

    Route::get('/', Livewire\Dashboard\Index::class)->name('dashboard');

    Route::post('/logout', [ DashboardController::class , 'logout' ])->name('dashboard-logout');
});
