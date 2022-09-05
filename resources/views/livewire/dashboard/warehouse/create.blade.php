<div>
    <div wire:loading>
        <div class="col-span-6 mt-4 mr-2 mb-5 sm:col-span-3 xl:col-span-2 flex items-center">
            <div class="text-center text-md ml-5">در حال پردازش اطلاعات ...</div>
            <i data-loading-icon="bars" class="w-8 h-8"></i>
        </div>
    </div>
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium ml-auto">
            ایجاد موجودی انبار
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5 mx-auto">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <form wire:submit.prevent="create">
                    <div>

                        <label>نام محصول</label>
                        <div class="mt-2">
                            <select wire:model.defer="warehouse.product_id" class="input input--sm border mr-2 w-full">
                            <option value="null">انتخاب کنید</option>
                            @foreach($products as $product)
                                    <option value="{{$product->id}}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('warehouse.product_id')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-5">
                        <label>رنگ محصول</label>
                        <div class="mt-2">
                            <input wire:model.defer="warehouse.color" class="input w-full border mt-2">
                        </div>
                        @error('warehouse.color')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                        <div class="rounded-md mt-5 px-5 py-4 mb-2 bg-theme-12 text-white"> فیلد رنگ محصول میتواند خالی باشد , این به این معناست که محصول از ویژگی رنگ استفاده نمیکند </div>
                    </div>
                    <div class="mt-5">
                        <label>کد رنگ محصول</label>
                        <div class="mt-2">
                            <input wire:model.defer="warehouse.hex" class="input w-full border mt-2">
                        </div>
                        @error('warehouse.hex')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                        <div class="rounded-md mt-5 px-5 py-4 mb-2 bg-theme-12 text-white">اگر رنگی برای محصول وارد کردید کد رنگی مرتبط با رنگ را نیز وارد کنید</div>
                    </div>
                    <div class="mt-5">
                        <label>سایز محصول</label>
                        <div class="mt-2">
                            <input wire:model.defer="warehouse.size" class="input w-full border mt-2">
                        </div>
                        @error('warehouse.size')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                        <div class="rounded-md mt-5 px-5 py-4 mb-2 bg-theme-12 text-white"> فیلد سایز محصول میتواند خالی باشد , این به این معناست که محصول از ویژگی سایز استفاده نمیکند </div>
                    </div>
                    <div class="mt-5">
                        <label>تعداد محصول</label>
                        <div class="mt-2">
                            <input type="number" wire:model.defer="warehouse.quantity" class="input w-full border mt-2">
                        </div>
                        @error('warehouse.quantity')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-5">
                        <label>قیمت محصول</label>
                        <div class="mt-2">
                            <input type="number" wire:model.defer="warehouse.price" class="input w-full border mt-2">
                        </div>
                        @error('warehouse.price')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                        <div class="rounded-md mt-5 px-5 py-4 mb-2 bg-theme-12 text-white"> قیمت را به تومان و بدون خط تیره , فاصله و ویرگول وارد کنید </div>
                    </div>
                    <div class="mt-5">
                        <label>هزینه ارسال محصول</label>
                        <div class="mt-2">
                            <input type="number" value="{{ env('TRANSPORTATION_CONST' , 7500) }}" wire:model.defer="warehouse.transportation_cost" class="input w-full border mt-2">
                        </div>
                        @error('warehouse.transportation_cost')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
{{--                        <div class="rounded-md mt-5 px-5 py-4 mb-2 bg-theme-12 text-white"> هزینه ارسال محصول به صورت خودکار از env. خوانده میشود </div>--}}
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
