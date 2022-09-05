<div>
    <div wire:loading>
        <div class="col-span-6 mt-4 mr-2 mb-5 sm:col-span-3 xl:col-span-2 flex items-center">
            <div class="text-center text-md ml-5">در حال پردازش اطلاعات ...</div>
            <i data-loading-icon="bars" class="w-8 h-8"></i>
        </div>
    </div>
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium ml-auto">
            ایجاد کاربر
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5 mx-auto">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <form wire:submit.prevent="create">
                    <div>
                        <label>نام کاربر</label>
                        <input type="text" wire:model.defer="user.name" class="input w-full border mt-2">
                        @error('user.name')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>ایمیل</label>
                        <input type="text" wire:model.defer="user.email" class="input w-full border mt-2">
                        @error('user.email')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>شماره همراه</label>
                        <input type="text" wire:model.defer="user.number" class="input w-full border mt-2">
                        @error('user.number')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>دسترسی کاربر</label>
                        <div class="mt-2">
                            <select wire:model.defer="user_roles" data-placeholder="Select your favorite actors" class="w-full">
                                <option value="null" >انتخاب کنید</option>
                            @foreach($roles as $role)
                                    <option value="{{ $role->id }}" >{{ $role->label }}</option>
                            @endforeach
                            </select>
                            @error('user_roles')
                            {{--                                @dd($errors->messages('user_roles'))--}}
                            <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                                <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>

                    <div class="rounded-md mt-5 px-5 py-4 mb-2 bg-theme-12 text-white"> رمز عبور کاربران شماره همراه آن ها خواهد بود
                        . بلافاصله بعد از ورود به داشبرد رمز عبور را بازنشانی کنید</div>
                    <div class="text-right mt-5">
                        <button type="submit" class="button w-24 bg-theme-1 text-white" >ایجاد</button>
                    </div>
                </form>
            </div>
            <!-- END: Form Layout -->
        </div>
    </div>
</div>
