<div class="container">
    <div class="row">
        <div class="box">
            <div class="box_back">
                <a href="#"><img src="{{asset('assets/web')}}/image/back.svg" alt=""></a>
            </div>
            <div class="box_logo"><img src="{{asset('assets/web')}}/image/logo-3.jpg" alt=""></div>
                <div class="box_details">
                    <p>بازیابی رمز عبور</p>
                    <p>لطفا رمز عبور جدید را وارد کنید</p>
                </div>
                <div class="box_login">
                    <form wire:submit.prevent="submit">
                        <input wire:model.defer="email" type="hidden" class="text text--left" value="{{ $email }}" >

                        <input wire:model.defer="password" type="password" class="text text--left" placeholder="رمز عبور">
                        @error('password')
                        <p class="text-danger-error">{{ $message }}</p>
                        @enderror
                        <input style="margin-top: 15px" wire:model.defer="password_confirmation" type="password" class="text text--left" placeholder="تکرار رمز عبور">
                        @error('password_confirmation')
                        <p class="text-danger-error">{{ $message }}</p>
                        @enderror

                        <button type="submit">بازیابی</button>
                    </form>
                </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="sign-page">
        <h1 class="sign-page__title">بازیابی رمز عبور</h1>

        <form class="sign-page__form" wire:submit.prevent="submit">
            <div wire:loading><p style="color: #444;">در حال پردازش اطلاعات ...</p></div>
            <input wire:model.defer="email" type="text" class="text text--left" placeholder="ایمیل" value="{{ $email }}" >
            @error('email')
            <p class="text-danger-error">{{ $message }}</p>
            @enderror
            <input wire:model.defer="password" type="password" class="text text--left" placeholder="رمز عبور">
            @error('password')
            <p class="text-danger-error">{{ $message }}</p>
            @enderror
            <input wire:model.defer="password_confirmation" type="password" class="text text--left" placeholder="تکرار رمز عبور">
            @error('password_confirmation')
            <p class="text-danger-error">{{ $message }}</p>
            @enderror
            <button class="btn btn--blue btn--shadow-blue width-100 " type="submit">بازیابی</button>
        </form>
    </div>
</div>
