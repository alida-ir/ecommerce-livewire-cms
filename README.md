
<!-- PROJECT LOGO -->  
<br />  
<p align="center">  
  <a href="httpshttps://github.com/alida-ir/ecommerce-laravel-cms">  
    <img src="logo.png" alt="Logo" height="200" alt="Ecommerce Laravel CMS">  
  </a>  

<h3 align="center">Ecommerce Laravel CMS</h3>

  <p align="center">  
    یک فروشگاه نسبتا کامل و آماده برای استفاده شما
    <br />  
    <a href="https://alida.ir/blog/ecommerce-laravel-cms"><strong>توضیحات کامل »</strong></a>  
    <br />  
    <br />  
    <a href="https://t.me/alida_ir/43">یاری در توسعه این پروژه</a>  
    |
    <a href="https://alida.ir">وبسایت من</a>  
    |
    <a href="https://instagram.com/alida_ir">اینستاگرام من</a>  
    |
    <a href="https://github.com/alida-ir/ecommerce-laravel-cms/issues">گزارش مشکل</a>  
  </p>  
</p>  

<br>  
<p align="center">
	<a href="https://github.com/alida-ir/ecommerce-laravel-cms/graphs/contributors"><img src="https://img.shields.io/github/contributors/alida-ir/ecommerce-laravel-cms.svg" alt="contributors"></a>
	<a href="https://github.com/alida-ir/ecommerce-laravel-cms/network/members"><img src="https://img.shields.io/github/forks/alida-ir/ecommerce-laravel-cms.svg" alt="forks"></a>
	<a href="https://github.com/alida-ir/ecommerce-laravel-cms/stargazers"><img src="https://img.shields.io/github/stars/alida-ir/ecommerce-laravel-cms.svg" alt="stars"></a>
	<a href="https://github.com/alida-ir/ecommerce-laravel-cms/issues"><img src="https://img.shields.io/github/issues/alida-ir/ecommerce-laravel-cms.svg" alt="issues"></a>
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
<p dir="rtl">ساده‌ترین راه برای نصب این پکیج استفاده از Composer است:</p>  

```sh  
    composer require alida-ir/ecommerce-laravel-cms  
```  
<p dir="rtl" id="install-fa">
<a href="https://getcomposer.org/">Composer</a> سامانه‌ای برای مدیریت بسته‌های زبان PHP است که به شما امکان مدیریت (نصب / به روزرسانی) پکیج‌های نوشته شده در این زبان را می‌دهد. اگر با کامپوزر آشنایی ندارید، می‌توانید از طریق سایت <a href="https://getcomposer.org/">getcomposer.org</a> مستندات آن را مطالعه و اقدام به بارگیری و نصب آن کنید.
</p>
<p dir="rtl">
در صورت عدم تمایل به استفاده از کامپوزر، می‌توانید این CMS را از <a href="https://github.com/alida-ir/Ecommerce-Laravel-CMS/archive/master.zip">اینجا</a> دانلود کرده و محتویات فایل زیپ را استخراج کنید.و یا با دستور زیر در سیستم خود clone کنید
</p>

```sh  
    git clone https://github.com/alida-ir/ecommerce-laravel-cms.git  
``` 

<p dir="rtl">
    سپس نیازمندی های این پروژه را با دستور زیر نصب کنید :
</p>


```sh  
    composer install  
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
<p dir="rtl">اگر در local هستید ؛ با دستور زیر میتوانید پروژه را در مرورگر ببینید</p>

```sh  
   php artisan serve
``` 

<p dir="rtl">برای مشاهده بخش مدیریت وبسایت ابتدا با اطلاعات زیر اقدام به ورود به وبسایت با لینک زیر کنید ؛ بعد از ورود مستقیم به پنل کاربری هدایت میشوید</p>  
<br>
<p dir="rtl">شماره موبایل :</p>

```sh  
   091212345678
``` 

<p dir="rtl">رمز عبور :</p>

```sh  
   12345678
``` 

[Login Address](https://localhost:8000/login)

<p dir="rtl">بعد از ورود به پنل کاربری ؛ از قسمت ویرایش پروفایل اقدام به تعویض رمز عبور کنید </p>  
