@php
    $user = auth()->user() ;
    $setting = new App\Models\Setting;
    $logo = $setting->where('title' , 'logo')->pluck('value')->first();
    $title = $setting->where('title' , 'title')->pluck('value')->first();
    $favicon = $setting->where('title' , 'favicon')->pluck('value')->first();
@endphp
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <link rel="icon" href="{{ $favicon }}" />
    <meta name="language" content="Fa" />
    <meta name="robots" content="index, follow" />
    <meta name="revised" content="Sunday, September 4th, 2022, 5:15 pm" />

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="{{ env("META_DESCRIPTION") }}" />
    <meta name="keywords" content="{{ env("META_KEYWORDS") }}" />
    <meta name="author" content="Alireza Dadashzadeh , info.alida.ir@gmail.com , alida.ir">
    <meta name="copyright" content="AliDa_ir" />

    <title>{{ $title }} - صفحه اصلی </title>
    <!-- BEGIN: CSS Assets-->
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('assets/dashboard') }}/css/app.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/dashboard') }}/css/cus.css" />

    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->
<body class="app">
<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="" class="w-6" src="{{$logo}}">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler">
            <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i>
        </a>
    </div>
    <ul class="border-t border-theme-24 py-5 hidden">
        <li>
            <a href="{{ route('dashboard') }}" class="menu menu--active">
                <div class="menu__icon"> <i data-feather="home"></i> </div>
                <div class="menu__title"> صفحه اصلی </div>
            </a>
        </li>

    </ul>
</div>
    <!-- END: Mobile Menu -->
<div class="flex">
    <!-- BEGIN: Side Menu -->
    <nav class="side-nav">
        <a href="{{ route('dashboard') }}" class="intro-x flex items-center pl-5 pt-4">
            <img alt="Midone Tailwind HTML Admin Template" class="w-12" src="{{ $logo }}">
            <span class="hidden xl:block text-white text-lg ml-3 mr-3"> {{ $title }} </span>
        </a>
        <div class="side-nav__devider my-6"></div>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}" class="side-menu {{ url()->current() ==  route('dashboard') ? "side-menu--active" : "" }}">
                    <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                    <div class="side-menu__title mr-2"> صفحه اصلی </div>
                </a>
            </li>

            {{--Start Admin Menu--}}
            @if(auth()->user()->can('viewAny' , [\App\Models\User::class , auth()->user()]))
                <li class="sub-menu">
                    <a style="cursor: pointer" class="side-menu {{ (request()->is("dashboard/users") || request()->is("dashboard/users/*")) ? "side-menu--active" : "" }}">
                        <div class="side-menu__icon"> <i data-feather="hard-drive"></i> </div>
                        <div class="side-menu__title mr-2"> کاربران </div>
                    </a>
                    <ul class="side-menu__sub-open {{ request()->is('dashboard/users')  ? "sub-menu-active" : "sub-menu-not-active" }}" id="submenu">
                        <li>
                            <a href="{{ route('users.index') }}" class="side-menu @if(request()->is('dashboard/users')) side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> همه کاربر ها </div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(auth()->user()->can('viewAny' , [\App\Models\Role::class , auth()->user()]))
                <li class="sub-menu">
                    <a style="cursor: pointer" class="side-menu {{ (request()->is("dashboard/roles") || request()->is("dashboard/roles/* ") || request()->is("dashboard/role/*") ) ? "side-menu--active" : "" }}">
                        <div class="side-menu__icon"> <i data-feather="hard-drive"></i> </div>
                        <div class="side-menu__title mr-2"> سطوح دسترسی </div>
                    </a>
                    <ul class="side-menu__sub-open {{( request()->is('dashboard/roles') || request()->is('dashboard/role/*') || request()->is('dashboard/permissions') ) ? "sub-menu-active" : "sub-menu-not-active" }}" id="submenu">
                        <li>
                            <a href="{{ route('role.index') }}" class="side-menu @if(request()->is('dashboard/role')) side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> همه سطوح دسترسی </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('permission.index') }}" class="side-menu @if(request()->is('dashboard/permissions')) side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> مجوز ها </div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(auth()->user()->can('viewAny' , [\App\Models\Category::class , auth()->user()]))
                <li class="sub-menu">
                    <a style="cursor: pointer" class="side-menu {{ (request()->is("dashboard/categories") || request()->is("dashboard/category/*")) ? "side-menu--active" : "" }}">
                        <div class="side-menu__icon"> <i data-feather="hard-drive"></i> </div>
                        <div class="side-menu__title mr-2"> دسته بندی ها </div>
                    </a>
                    <ul class="side-menu__sub-open {{ request()->is('dashboard/category')  ? "sub-menu-active" : "sub-menu-not-active" }}" id="submenu">
                        <li>
                            <a href="{{ route('category.index') }}" class="side-menu @if(request()->is('dashboard/categories') || request()->is('dashboard/category/*')) side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> همه دسته بندی ها </div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(auth()->user()->can('viewAny' , [\App\Models\Brand::class , auth()->user()]))
                <li class="sub-menu">
                    <a style="cursor: pointer" class="side-menu {{ (request()->is("dashboard/brands") || request()->is("dashboard/brand/*")) ? "side-menu--active" : "" }}">
                        <div class="side-menu__icon"> <i data-feather="hard-drive"></i> </div>
                        <div class="side-menu__title mr-2"> برند ها </div>
                    </a>
                    <ul class="side-menu__sub-open {{ request()->is('dashboard/category')  ? "sub-menu-active" : "sub-menu-not-active" }}" id="submenu">
                        <li>
                            <a href="{{ route('brand.index') }}" class="side-menu @if(request()->is('dashboard/brands') || request()->is('dashboard/brand/*')) side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> برند ها </div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(auth()->user()->can('viewAny' , [\App\Models\Product::class , auth()->user()]))
                <li class="sub-menu">
                    <a style="cursor: pointer" class="side-menu {{ (request()->is("dashboard/products") || request()->is("dashboard/product/*")) ? "side-menu--active" : "" }}">
                        <div class="side-menu__icon"> <i data-feather="hard-drive"></i> </div>
                        <div class="side-menu__title mr-2"> محصولات </div>
                    </a>
                    <ul class="side-menu__sub-open {{ request()->is('dashboard/product')  ? "sub-menu-active" : "sub-menu-not-active" }}" id="submenu">
                        <li>
                            <a href="{{ route('product.index') }}" class="side-menu @if(request()->is('dashboard/products')) side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> همه محصولات </div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(auth()->user()->can('viewAny' , [\App\Models\Discount::class , auth()->user()]))
                <li class="sub-menu">
                    <a style="cursor: pointer" class="side-menu {{ (request()->is("dashboard/discounts") || request()->is("dashboard/discount/*")) ? "side-menu--active" : "" }}">
                        <div class="side-menu__icon"> <i data-feather="hard-drive"></i> </div>
                        <div class="side-menu__title mr-2"> تخفیف ها </div>
                    </a>
                    <ul class="side-menu__sub-open {{ request()->is('dashboard/discount')  ? "sub-menu-active" : "sub-menu-not-active" }}" id="submenu">
                        <li>
                            <a href="{{ route('discount.index') }}" class="side-menu @if(request()->is('dashboard/discounts')) side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> همه تخفیف ها </div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(auth()->user()->can('viewAny' , [\App\Models\Warehouse::class , auth()->user()]))
                <li class="sub-menu">
                    <a style="cursor: pointer" class="side-menu {{ (request()->is("dashboard/warehouses") || request()->is("dashboard/warehouse/*")) ? "side-menu--active" : "" }}">
                        <div class="side-menu__icon"> <i data-feather="hard-drive"></i> </div>
                        <div class="side-menu__title mr-2"> انبار </div>
                    </a>
                    <ul class="side-menu__sub-open {{ request()->is('dashboard/warehouse')  ? "sub-menu-active" : "sub-menu-not-active" }}" id="submenu">
                        <li>
                            <a href="{{ route('warehouse.index') }}" class="side-menu @if(request()->is('dashboard/warehouses')) side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> همه موجودی انبار </div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(auth()->user()->can('viewAny' , [\App\Models\TransAction::class , auth()->user()]))
                <li class="sub-menu">
                    <a style="cursor: pointer" class="side-menu {{ (request()->is("dashboard/payments") || request()->is("dashboard/payment/*")) ? "side-menu--active" : "" }}">
                        <div class="side-menu__icon"> <i data-feather="hard-drive"></i> </div>
                        <div class="side-menu__title mr-2"> تراکنش ها </div>
                    </a>
                    <ul class="side-menu__sub-open {{ request()->is('dashboard/payments')  ? "sub-menu-active" : "sub-menu-not-active" }}" id="submenu">
                        <li>
                            <a href="{{ route('payment.index') }}" class="side-menu @if(request()->is('dashboard/payments')) side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> همه تراکنش ها </div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(auth()->user()->can('viewAny' , [\App\Models\Order::class , auth()->user()]))
                <li class="sub-menu">
                    <a style="cursor: pointer" class="side-menu {{ (request()->is("dashboard/orders") || request()->is("dashboard/bills") || request()->is("dashboard/order/*")) ? "side-menu--active" : "" }}">
                        <div class="side-menu__icon"> <i data-feather="hard-drive"></i> </div>
                        <div class="side-menu__title mr-2"> سفارشات </div>
                    </a>
                    <ul class="side-menu__sub-open {{ request()->is('dashboard/orders') || request()->is("dashboard/bills")  ? "sub-menu-active" : "sub-menu-not-active" }}" id="submenu">
                        <li>
                            <a href="{{ route('order.index') }}" class="side-menu @if(request()->is('dashboard/orders')) side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> همه سفارشات </div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(auth()->user()->can('viewAny' , [\App\Models\Setting::class]))
                <li class="sub-menu">
                    <a style="cursor: pointer" class="side-menu {{ (request()->is("dashboard/settings")  || request()->is("dashboard/settings/*")) ? "side-menu--active" : "" }}">
                        <div class="side-menu__icon"> <i data-feather="hard-drive"></i> </div>
                        <div class="side-menu__title mr-2"> تنظیمات </div>
                    </a>
                    <ul class="side-menu__sub-open {{ request()->is('dashboard/settings') || request()->is("dashboard/settings/*")  ? "sub-menu-active" : "sub-menu-not-active" }}" id="submenu">
                        <li>
                            <a href="{{ route('setting.index') }}" class="side-menu @if(request()->is('dashboard/settings')) side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title">تنظیمات اصلی</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('setting.menu') }}" class="side-menu @if(request()->is('dashboard/settings/menu')) side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> منو ها </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('setting.slider') }}" class="side-menu @if(request()->is('dashboard/settings/slider')) side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title">اسلایدر</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('setting.banner') }}" class="side-menu @if(request()->is('dashboard/settings/banner')) side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title">بنر ها</div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            {{--End Admin Menu--}}
        </ul>
    </nav>
    <!-- END: Side Menu -->
    <!-- BEGIN: Content -->
    <div class="content">
        <!-- BEGIN: Top Bar -->
        <div class="top-bar">
            <!-- BEGIN: Search -->

            <!-- END: Search -->
            <!-- BEGIN: Breadcrumb -->

            <div class="-intro-x breadcrumb ml-auto hidden sm:flex mr-3">
                <a href="{{ route('dashboard') }}" class="">صفحه اصلی پنل کاربری</a>
                @if(!empty($breads))
                    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
                    @foreach($breads as $key => $bread)
                        @php
                            $bread['params'] = $bread['params'] ?? null
                        @endphp
                        @if(($key + 1) == count($breads))
                            <a href="{{ route($bread['name'] , $bread['params']) }}" class="breadcrumb--active">{{ $bread['title'] }}</a>
                        @else
                            <a href="{{ route($bread['name']) }}" class="">{{ $bread['title'] }}</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i>
                        @endif
                    @endforeach
                @endif
            </div>
            <!-- END: Breadcrumb -->
            <!-- BEGIN: Account Menu -->
            <div class="intro-x dropdown w-8 h-8 relative">
                <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                    <img alt="Midone Tailwind HTML Admin Template" src="{{ asset('assets/dashboard') }}/images/profile-12.jpg">
                </div>
                <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                    <div class="dropdown-box__content box bg-theme-38 text-white">
                        <div class="p-4 border-b border-theme-40">

                            <div class="font-medium">{{ $user->name ?? $user->number}}</div>
                            <div class="text-xs text-theme-41">کاربر</div>
                        </div>
                        <div class="p-2">
                            {{--                            <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> پروفایل </a>--}}
                            <a href="{{ route('users.edit' ,$user->id ) }}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="edit" class="w-4 h-4 mr-2 ml-2"></i> ویرایش پروفایل  </a>
                            {{--                            <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>--}}
                            {{--                            <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="help-circle" class="w-4 h-4 mr-2"></i> Help </a>--}}
                        </div>
                        <div class="p-2 border-t border-theme-40">
                            <a onclick="document.getElementById('logout').submit()" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="toggle-right" class="w-4 h-4 mr-2 ml-2"></i> خروج </a>
                            <form name="logout" id="logout" action="{{ route('dashboard-logout') }}" method="post">@csrf</form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Account Menu -->
        </div>
        <!-- END: Top Bar -->
        {{ $slot }}

    </div>
    <!-- END: Content -->
</div>
<!-- BEGIN: JS Assets-->
@livewireScripts
<script src="{{ asset('assets/dashboard') }}/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@stack('scripts')
<script>
    $("#Order").click(function (){
        $('.Box_Address').toggleClass('active')
    });
    $(window).on('load change', function (){
        setTimeout(function (){
            var Numbers = document.querySelectorAll('#tuman');
            for (var i = 0 ; i < Numbers.length ; i++){
                Number = Numbers[i].innerText;
                Number = Number.replace(',', '');
                x = Number.split('.');
                y = x[0];
                z= x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(y))
                    y= y.replace(rgx, '$1' + ',' + '$2');
                Numbers[i].innerHTML = '';
                Numbers[i].innerHTML = y;
            }
        } , 1000)
    })
</script>
@if(\Illuminate\Support\Facades\Session::has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: ' خطا ...',
            text: '{{ \Illuminate\Support\Facades\Session::get('error')[0]  }}',
        })
    </script>
@endif
@if(\Illuminate\Support\Facades\Session::has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: ' موفقیت آمیز ...',
            text: '{{ \Illuminate\Support\Facades\Session::get('success')[0]  }}',
        })
    </script>
@endif
@if(\Illuminate\Support\Facades\Session::has('info'))
    <script>
        Swal.fire({
            icon: 'info',
            text: '{{ \Illuminate\Support\Facades\Session::get('info')[0]  }}',
        })
    </script>
@endif
<!-- END: JS Assets-->
</body>
</html>
