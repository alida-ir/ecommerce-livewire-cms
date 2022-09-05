<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <link rel="icon" href="{{ $favicon }}"/>
    <meta name="language" content="Fa" />
    <meta name="robots" content="index, follow" />
    <meta name="revised" content="Sunday, September 4th, 2022, 5:15 pm" />

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#EEEEEE"/>

    <meta name="keywords"
          content="{{ env("META_KEYWORDS") }}">

    <meta name="description"
          content="{{ env("META_DESCRIPTION") }}">

    <meta name="copyright" content="AliDa_ir" />
    <meta name="author" content="Alireza Dadashzadeh , info.alida.ir@gmail.com , alida.ir">


    <title>{{ env('APP_TITLE') }} - ورود | ثبت‌نام</title>

    <!-- Link CSS -->
    @livewireStyles

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vazir-font/30.1.0/Farsi-Digits/font-face-FD.min.css"  rel="preload" as="style" onload="this.rel='stylesheet'">

    <link rel="stylesheet" href="{{asset('assets/web')}}/css/login.css"  rel="preload" as="style" onload="this.rel='stylesheet'">


</head>
<body>
{{ $slot }}
@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('/assets/web/js/login.js') }}"></script>

@if(\Illuminate\Support\Facades\Session::has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: ' موفقیت آمیز ...',
            text: '{{ \Illuminate\Support\Facades\Session::get('success')[0]  }}',
        })
    </script>
@endif
</body>
</html>
