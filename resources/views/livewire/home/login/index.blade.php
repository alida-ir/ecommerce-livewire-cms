<div class="container">
    <div class="row">
        <div class="box">
            <div class="box_back">
                <a href="#" wire:click.prevent="Back"><img src="{{asset('assets/web')}}/image/back.svg" alt=""></a>
            </div>
            <div class="box_logo">
                <a href="{{ route('home') }}">
                    <img src="{{ $logo }}" alt="Logo">
                </a>
            </div>
            @if($LoginUser)
                <div class="box_details">
                    <p>ورود | ثبت‌نام</p>
                    <p>سلام!</p>
                    <p>لطفا شماره موبایل یا ایمیل خود را وارد کنید</p>
                </div>
                <div class="box_login">
                <form wire:submit.prevent="Login">
                    <input wire:model.defer="username" type="text" autofocus>
                    @error('username')
                        <span class="box_danger">{{ $message }}</span>
                    @enderror
                    <button type="submit">ورود</button>
                </form>
            </div>
            @endif
            @if($UsePassword)
                <div class="box_details">
                    <p>رمز عبور را وارد کنید</p>
                </div>
                <div class="box_login">
                <form wire:submit.prevent="UsePassword">
                    <input wire:model.defer="password" type="password">
                    @error('password')
                        <span class="box_danger">{{ $message }}</span>
                    @enderror
                    <span class="useCode" wire:click="submitUseCode">ورود با رمز عبور یکبارمصرف</span>
                    <span class="forgetPass" wire:click="submitForgetPassword">فراموشی رمز عبور</span>
                    <button type="submit">ورود</button>
                </form>
            </div>
            @endif
            @if($numberVerification)
                <div class="box_details">
                    <p>کد تایید را وارد کنید</p>
                    <p class="newCaption">حساب کاربری با شماره موبایل {{ $user->number }} وجود ندارد. برای ساخت حساب جدید،کد تایید برای این شماره ارسال گردید.</p>
                </div>
                <div class="box_login">
                <form wire:submit.prevent="submitCode">
                    <input wire:model.defer="Code" type="text">
                    @error('Code')
                        <span class="box_danger">{{ $message }}</span>
                    @enderror
                    <button type="submit">ورود</button>
                </form>
            </div>
            @endif
            @if($dontUsePassword)
                <div class="box_details">
                    <p>کد یکبار مصرف را وارد کنید</p>
                    <p class="newCaption">کد یکبار مصرف ارسال شده به {{$user->number}} را برای ورود به حساب کاربری خود وارد کنید</p>
                </div>
                <div class="box_login">
                <form wire:submit.prevent="submitUseCodeByLogin">
                    <input wire:model.defer="UseCodeByLogin" type="text">
                    @error('UseCodeByLogin')
                        <span class="box_danger">{{ $message }}</span>
                    @enderror
                    <button type="submit">ورود</button>
                </form>
            </div>
            @endif
            @if($ForgetPassword)
                <div class="box_details">
                    <p>ایمیل خود را وارد کنید</p>
                    <p class="newCaption">لینک بازنشانی پسورد به ایمیل شما ارسال میشود</p>
                </div>
                <div class="box_login">
                <form wire:submit.prevent="submitEmailForgetPassword">
                    <input wire:model.defer="EmailForgetPassword" type="text">
                    @error('EmailForgetPassword')
                        <span class="box_danger">{{ $message }}</span>
                    @enderror
                    <button type="submit">بازنشانی</button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
