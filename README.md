
<!-- PROJECT LOGO -->  
<br />  
<p align="center">  
  <a href="https://github.com/alida-ir/ecommerce-livewire
-cms">  
    <img src="logo.png" alt="Logo" height="200" alt="Ecommerce Livewire CMS">  
  </a>  

<h3 align="center">Ecommerce Livewire CMS</h3>

  <p align="center">  
    یک فروشگاه نسبتا کامل و آماده برای استفاده شما
    <br />  
    <a href="https://alida.ir/blog/ecommerce-livewire-cms"><strong>توضیحات کامل »</strong></a>  
    <br />  
    <br />  
    <a href="https://t.me/alida_ir/43">یاری در توسعه این پروژه</a>  
    |
    <a href="https://alida.ir">وبسایت من</a>  
    |
    <a href="https://instagram.com/alida_ir">اینستاگرام من</a>  
    |
    <a href="https://github.com/alida-ir/ecommerce-livewire-cms/issues">گزارش مشکل</a>  
  </p>  
</p>  

<br>  
<p align="center">
	<a href="https://github.com/alida-ir/ecommerce-livewire-cms/graphs/contributors"><img src="https://img.shields.io/github/contributors/alida-ir/ecommerce-livewire-cms.svg" alt="contributors"></a>
	<a href="https://github.com/alida-ir/ecommerce-livewire-cms/network/members"><img src="https://img.shields.io/github/forks/alida-ir/ecommerce-livewire-cms.svg" alt="forks"></a>
	<a href="https://github.com/alida-ir/ecommerce-livewire-cms/stargazers"><img src="https://img.shields.io/github/stars/alida-ir/ecommerce-livewire-cms.svg" alt="stars"></a>
	<a href="https://github.com/alida-ir/ecommerce-livewire-cms/issues"><img src="https://img.shields.io/github/issues/alida-ir/ecommerce-livewire-cms.svg" alt="issues"></a>
	<a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/badge/License-MIT-green.svg" alt="license"></a>
</p>

<p align="center">  
    <a href="#table-of-contents-fa">مستندات فارسی</a>  
</p>
<h2 dir="rtl" id="table-of-contents-fa">فهرست مطالب </h2>

<ul dir="rtl">
	<li><a href="#install-fa">نصب</a></li>
	<li><a href="#usage-fa">استفاده</a></li>
</ul>


<h2 dir="rtl" id="install-fa">نصب</h2>

<p dir="rtl">
    برای دریافت پروژه میتوانید از این <a href="https://github.com/alida-ir/ecommerce-livewire-cms/archive/master.zip">لینک</a> استفاده کنید یا در صورتی که گیت روی سیستم شما نصب باشد میتوانید از دستور زیر برای دریافت پروژه استفاده کنید
</p>

```sh  
    git clone https://github.com/alida-ir/ecommerce-livewire-cms.git  
``` 

<p dir="rtl">
    سپس نیازمندی های این پروژه را با دستور زیر نصب کنید :
</p>


```sh  
    composer install  
``` 

<p dir="rtl">
    سپس با دستور زیر یک کلید برای اپلیکیشن خود ایجاد کنید
</p>

```sh  
    php artisan key:generate  
``` 


<p dir="rtl">
    سپس فایل .env.example را به .evn تغییر نام دهید ؛ و این فایل را ویرایش کنید و اطلاعات مربوطه را ذخیره کنید ؛ سپس با دستورات زیر اقدام به ایجاد دیتابیس و نوشتن اطلاعات اولیه کنید
</p>

```sh  
    php artisan migrate  
``` 

<p dir="rtl">
  ثبت اطلاعات اولیه و مورد نیاز :
</p>


```sh  
    php artisan db:seed  
``` 

<h2 dir="rtl" id="usage-fa">استفاده</h2>
<p dir="rtl">با باز کردن آدرس سایت خود در مرورگر میتوانید این فروشگاه آنلاین را مشاهده کنید</p>  
<p dir="rtl">اگر در local هستید ؛ با دستور زیر میتوانید پروژه را در مرورگر ببینید ( در این صورت قبل از ایجاد جدول های مورد نیاز ؛ آدرس وبسایت در فایل .env را تغییر دهید ) </p>

```sh  
   php artisan serve
``` 

<p dir="rtl">برای مشاهده بخش مدیریت وبسایت ابتدا با اطلاعات زیر اقدام به ورود به وبسایت با لینک زیر کنید ؛ بعد از ورود مستقیم به پنل کاربری هدایت میشوید</p>  
<br>

[Login Address](http://localhost:8000/login)
<br>
<p dir="rtl">شماره موبایل :</p>

```sh  
   091212345678
``` 

<p dir="rtl">رمز عبور :</p>

```sh  
   12345678
``` 

<p dir="rtl">بعد از ورود به پنل کاربری ؛ از قسمت ویرایش پروفایل اقدام به تعویض رمز عبور کنید </p>  
