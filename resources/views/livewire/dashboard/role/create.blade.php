<div>
    <style>
        option{
            border-bottom: 1px solid #ececec;
        }
        select{
            border: 1px solid #ececec;
        }
    </style>
    <div wire:loading>
        <div class="col-span-6 mt-4 mr-2 mb-5 sm:col-span-3 xl:col-span-2 flex items-center">
            <div class="text-center text-md ml-5">در حال پردازش اطلاعات ...</div>
            <i data-loading-icon="bars" class="w-8 h-8"></i>
        </div>
    </div>
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium ml-auto">
            ساخت سطح دسترسی
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5 mx-auto">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <form wire:submit.prevent="create">
                    <div>
                        <label>نام دسترسی</label>
                        <input type="text" wire:model.defer="role.title" class="input w-full border mt-2">
                        @error('role.title')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>برچسب</label>
                        <input type="text" wire:model.defer="role.label" class="input w-full border mt-2">
                        @error('role.label')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>مجوز ها</label>
                        <div class="mt-2">
                            <select wire:model.defer="permission" data-placeholder="Select your favorite actors" class="w-full" multiple>
                                @foreach($permissions as $permission_value)
                                    <option value="{{ $permission_value->id }}" >{{ $permission_value->label }}</option>
                                    {{--                                <option value="2">PC & Laptop</option>--}}
                                    {{--                                <option value="3" selected>Smartphone & Tablet</option>--}}
                                    {{--                                <option value="4">Photography</option>--}}
                                @endforeach
                            </select>
                            @error('permission')
                            <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                                <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-right mt-5">
                        <button type="submit" class="button w-24 bg-theme-1 text-white" >ایجاد</button>
                    </div>
                </form>
            </div>
            <!-- END: Form Layout -->
        </div>
    </div>
</div>
