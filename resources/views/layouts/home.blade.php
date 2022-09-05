@php
    $setting = $setting ?? \App\Models\Setting::all();

    $logo = $setting->where('title' , 'logo')->first();
    $favicon = $setting->where('title' , 'favicon')->pluck('value')->first();
    $titleSite = $setting->where('title' , 'title')->pluck('value')[0];
    $numberSite = $setting->where('title' , 'number')->pluck('value')[0];
    $emailSite = $setting->where('title' , 'email')->pluck('value')[0];
    $addressSite = $setting->where('title' , 'address')->pluck('value')[0];
    $telegramSite = $setting->where('title' , 'telegram')->pluck('value')[0];
    $instagramSite = $setting->where('title' , 'instagram')->pluck('value')[0];
    $twitterSite = $setting->where('title' , 'twitter')->pluck('value')[0];
    $categoryOption = $setting->where('title' , 'AllCategoryInMenu')->pluck('value')[0];
    $menuSite = $setting->where('title' , 'menu')->pluck('value')->toArray();
    $quickAccessSite = $setting->where('title' , 'quickAccess')->all();
    $category = [];
    $aceessTitles = [];
    $aceessLinks = [];
    $category = \App\Models\Category::findMany($menuSite)->pluck('label' , 'slug')->toArray();
    foreach ($quickAccessSite as $key => $item) {
        if (is_integer($key / 2)){
            $aceessTitles[] = $item->value;
        }else{
            $aceessLinks[] = $item->value;
        }
    }
@endphp
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <link rel="icon" href="{{ $favicon }}"/>
    <meta charset="UTF-8">
    <meta name="language" content="Fa" />
    <meta name="robots" content="index, follow" />
    <meta name="revised" content="Sunday, September 4th, 2022, 5:15 pm" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#EEEEEE"/>
    <meta name="keywords" content="{{ $meta['keywords'] ?? env("META_KEYWORDS") }}">
    <meta name="description" content="{{ $meta['description'] ?? env("META_DESCRIPTION") }}">
    <meta name="copyright" content="AliDa_ir" />
    <meta name="author" content="Alireza Dadashzadeh , info.alida.ir@gmail.com , alida.ir">
    <noscript>این سایت برای اجرا به جاوا اسکریپت مرورگر نیاز دارد ...x</noscript>
    <title>{{ $titleSite ?? env('APP_TITLE') }} @if(!empty($title)) - {{ $title }} @endif</title>
    <!-- Link CSS -->
    @livewireStyles
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vazir-font/30.1.0/Farsi-Digits/font-face-FD.min.css"  rel="preload" as="style" onload="this.rel='stylesheet'">
    <link rel="stylesheet" href="{{ asset('assets/web') }}/css/app.css"  rel="preload" as="style" onload="this.rel='stylesheet'">
    @if(!empty($style))
        <link rel="stylesheet" href="{{ asset('assets/web') }}/css/{{$style}}"  rel="preload" as="style" onload="this.rel='stylesheet'">
    @endif
    <link rel="stylesheet" href="{{ asset('assets/web') }}/css/res.css"  rel="preload" as="style" onload="this.rel='stylesheet'">
</head>
<body>
<div class="container">
    <header>
        <div class="top__menu">
            <div class="fluid">
                <ul class="top__menu--ul">
                    @foreach($aceessTitles as $key => $item)
                      <li class="top__menu--li"><a href="{{ $aceessLinks[$key] }}">{{$item}}</a></li>
                    @endforeach
                </ul>
                <div class="middle__content">
                    <div class="logo">
                        <a href="{{ route('home') }}"><img src="{{ $logo->value }}" alt=""></a>
                    </div>
                    <div class="search">
                        <form action="{{ route('search') }}" method="get">
                            <input type="text" name="q"
                                   @if(request()->has('q'))
                                    value="{{ request()->get('q') }}"
                                   @endif
                                   placeholder="عبارت موردنظر را وارد کنید">
                            <button type="submit"><img src="{{ asset('assets/web/image') }}/search.svg" alt=""></button>
                        </form>
                    </div>
                    <div class="cart">
                        @if(auth()->user())
                            <a href="{{ route('checkout.index') }}">
                                <img src="{{ asset('assets/web/image') }}/cart.svg" alt="">
                                <span>سبد خرید</span>
{{--                                <span class="number">{{ $cartItem ?? "0" }}</span>--}}
                            </a>
                        @else
                            <a href="{{ route('login') }}">
                                <img src="{{ asset('assets/web/image') }}/login.svg" class="ImgCustom" alt="">
                                <span>ورود | ثبت نام</span>
                            </a>
                        @endif
                        <div class="top__menu--res">
                            <img class="top__menu--res__img" id="top__menu__open" src="{{ asset('assets/web/image') }}/menu.svg" alt="">
                            <img class="top__menu--res__img" id="top__menu__close" src="{{ asset('assets/web/image') }}/close.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="bottom__menu">
                    <nav>
                        <ul class="bottom__menu--ul">
                            @if($categoryOption)
                              <li class="bottom__menu--li"><a href="{{ route('categories.index') }}">دسته بندی ها</a></li>
                            @endif

                            @if($category)
                                @foreach($category as $key => $item)
                                    <li class="bottom__menu--li"><a href="{{ route('categories.item' , $key) }}">{{ $item }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="top__mobile">
            <div class="menuSearch">
                <form action="{{ route('search') }}" method="get">
                    <input type="text" name="q"
                           @if(request()->has('q'))
                               value="{{ request()->get('q') }}"
                           @endif
                           placeholder="عبارت موردنظر را وارد کنید">
                    <button type="button"><img src="{{ asset('assets/web/image') }}/search.svg" alt=""></button>
                </form>
            </div>
            <div class="menuUl">
                <nav>
                    <ul class="bottom__menu--ul">
                        @if($categoryOption)
                            <li class="bottom__menu--li"><a href="{{ route('categories.index') }}">دسته بندی ها</a></li>
                        @endif

                        @if($category)
                            @foreach($category as $key => $item)
                                <li class="bottom__menu--li"><a href="{{ route('categories.item' , $key) }}">{{ $item }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </nav>
            </div>
            <h4>دسترسی سریع</h4>
            <ul class="shortMenuUl">
                @foreach($aceessTitles as $key => $item)
                    <li><a href="{{ $aceessLinks[$key] }}">{{$item}}</a></li>
                @endforeach
            </ul>
        </div>
        <div id="top__mask"></div>
    </header>


    <main>
        {{ $slot }}
    </main>

    <footer>
        <div class="footer__content">

            <div class="footer__content--description">
                <h5>درباره ما</h5>

                <div>
{{--                    <span class="limit-text_6">یک خرید اینترنتی مطمئن، نیازمند فروشگاهی است که بتواند کالاهایی متنوع، باکیفیت و دارای قیمت مناسب را در مدت زمانی کوتاه به دست مشتریان خود برساند و ضمانت بازگشت کالا هم داشته باشد؛ ویژگی‌هایی که فروشگاه اینترنتی دیجی‌کالا سال‌هاست بر روی آن‌ها کار کرده و توانسته از این طریق مشتریان ثابت خود را داشته باشد.</span>--}}
{{--                    <div class="call_custom">--}}
                        @if($numberSite)
                            <span>شماره تماس :</span>
                            <span>{{ $numberSite }}</span>
                            <br>
                        @endif

                        @if($emailSite)
                            <span>ایمیل :</span>
                            <span>{{ $emailSite }}</span>
                            <br>
                        @endif
                        @if($addressSite)
                            <span>آدرس :</span>
                            <span>{{ $addressSite }}</span>
                            <br>
                        @endif
{{--                    </div>--}}
{{--                    <span>آدرس : <span>تهران ؛ میدان آزادی ؛ دوراه قپون ؛ خانه مش ممدعلی</span></span>--}}
                </div>
            </div>
            <div class="footer__content--socialMedia">
                <h5>شبکه های اجتماعی</h5>
                <div>
                    @if($instagramSite)
                        <a target="_blank" href="https://instagram.com/{{$instagramSite}}"><span>اینستاگرام</span><img src="{{ asset('assets/web/image') }}/social/9741883171561032669.svg" alt="{{$instagramSite}}"></a>
                    @endif
                    @if($telegramSite)
                        <a target="_blank" href="https://t.me/{{ $telegramSite }}"><span>تلگرام</span><img src="{{ asset('assets/web/image') }}/social/9243149191579518949.svg" alt="{{$telegramSite}}"></a>
                    @endif
                    @if($twitterSite)
                        <a target="_blank" href="https://twitter.com/{{ $twitterSite }}"><span>توییتر</span><img src="{{ asset('assets/web/image') }}/social/13728386351561032650.svg" alt="{{ $twitterSite }}"></a>
                    @endif
                </div>
            </div>
            <div class="footer__content--bottomMenu">
                <h5>دسترسی سریع</h5>
                <ul class="top__menu--ul">
                    @foreach($aceessTitles as $key => $item)
                        <li class="top__menu--li">
                            <a href="{{ $aceessLinks[$key] }}">{{$item}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="footer__content--enamad">
                <h5>نماد اعتماد الکترونیکی</h5>
                <div>
                    <a href="#"><img src="{{ asset('assets/web/image') }}/samandehi-logo.png" alt=""></a>
                    <a href="#"><img src="{{ asset('assets/web/image') }}/enamad.webp" alt=""></a>
                </div>
            </div>
        </div>
        <div class="footer__content--copyright">
            © کلیه حقوق این وب‌سایت متعلق به <a target="_blank" href="https://alida.ir" nofollow>علیرضا داداش زاده</a> می‌باشد.
        </div>
    </footer>

</div>
@livewireScripts
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>

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

@if(!empty($script))
    <script src="{{asset('assets/web/js')}}/{{$script}}"></script>
@endif
</body>
</html>
