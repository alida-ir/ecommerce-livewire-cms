<div>
    <div wire:loading>
        <div class="col-span-6 mt-4 mr-2 mb-5 sm:col-span-3 xl:col-span-2 flex items-center">
            <div class="text-center text-md ml-5">در حال پردازش اطلاعات ...</div>
            <i data-loading-icon="bars" class="w-8 h-8"></i>
        </div>
    </div>
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium ml-auto">
            ویرایش پروفایل کاربری
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5 mx-auto">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            <div wire:loading><p style="color: #444;margin: 20px 0;">در حال پردازش اطلاعات ...</p></div>

            <div class="intro-y box p-5">
                <form wire:submit.prevent="edit">
                    <div>
                        <label>نام و نام خانوادگی</label>
                        <input type="text" wire:model.defer="user.name" class="input w-full border mt-2" value="{{ $user->name }}">
                        @error('user.name')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>شماره موبایل</label>
                        <input type="text" wire:model.defer="user.number" class="input number_show w-full border mt-2" value="{{ $user->number }}">
                        @error('user.number')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>ایمیل</label>
                        <input type="email" wire:model.defer="user.email" class="input w-full border mt-2" value="{{ $user->email }}" >
                        @error('user.email')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    @if($user->password != null)
                        <div class="mt-3">
                            <label>رمز عبور فعلی</label>
                            <input type="password" wire:model.defer="current_password" class="input w-full border mt-2" >
                            @error('current_password')
                            <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                                <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                            @enderror
                        </div>
                        <div style="font-size: 12px;" class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 mt-3 text-white"> <i data-feather="alert-circle" class="w-6 h-6 ml-2"></i> در صورتی که نمیخواهید رمز عبور خودرا تعویض کنید
                            این قسمت ها را خالی بگذارید</div>
                    @endif
                    <div class="mt-3">
                        <label>رمز عبور جدید</label>
                        <input  type="password" wire:model.defer="new_password" class="input w-full border mt-2" >
                        @error('new_password')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>تکرار رمز عبور جدید</label>
                        <input wire:model.defer="password_confirmation" type="password" class="input w-full border mt-2" >
                        @error('password_confirmation')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    @if(auth()->user()->can('updateAny' , [auth()->user()]))
                        <div class="mt-3">
                                            <label>نقش کاربر</label>
                                            <div class="mt-2">
                                                <select wire:model.defer="user.role_id" class="w-full">
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}"
                                                                @if($role->id === $user->role_id)
                                                                    selected
                                                              @endif
                                                            wire:key="{{$role->id}}"
                                                        >{{ $role->label }}</option>
                                                    @endforeach
                                                    @error('role')
                                                    <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                                                        <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                                                    @enderror
                                                </select>
                                            </div>
                        </div>
                          <div class="mt-5">
                            <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                                <div class="mr-3">آیا ایمیل کاربر تایید شده است ؟</div>
                                <input wire:model="user.approved" data-target="#basic-tooltip" class="show-code input input--switch border" type="checkbox"
                                       @if($user->approved)
                                           checked
                                         @endif
                                >
                            </div>
                        </div>
                    @endif

                    <div class="text-right mt-5">
                        <button type="submit" class="button w-24 bg-theme-1 text-white" >ذخیره</button>
                    </div>
                </form>
            </div>
            <!-- END: Form Layout -->
        </div>
    </div>
    <script>
        var number = document.querySelector(".number_show").value ;
        number.replace(/^0+/, '');
        document.querySelector(".number_show").value = number ;
    </script>
</div>
