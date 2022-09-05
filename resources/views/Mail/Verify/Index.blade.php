@component('mail::message')
    # احراز هویت

    {{$data['name']}} عزیز !
    برای تایید حساب کاربری خود ؛ کد زیر را در وبسایت وارد نمایید.

    @component('mail::button' , ['url' => ''])
        {{$data['code']}}
    @endcomponent

    با تشکر,<br>
    {{ config('app.name') }}
@endcomponent
