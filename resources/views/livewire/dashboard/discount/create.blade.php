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
            ایجاد محصول
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5 mx-auto">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <form wire:submit.prevent="create" data-file-types="image/jpeg|image/png|image/jpg" enctype="multipart/form-data">
                    <div>
                        <label>نام کد تخفیف</label>
                        <input type="text" wire:model.defer="discount.name" class="input w-full border mt-2">
                        @error('discount.name')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-5">
                        <label>درصد تخفیف</label>
                        <input type="number" wire:model.defer="discount.quantity" class="input w-full border mt-2">
                        @error('discount.quantity')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-5">
                        <label>توضیحات</label>
                        <textarea wire:model.defer="discount.message" class="input w-full border mt-2"></textarea>
                        @error('discount.message')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>دسته بندی</label>
                        <div class="mt-2">
                            <select wire:model.defer="discount.category_id" data-placeholder="Select your favorite actors" class="w-full">
                                <option value="null" >انتخاب کنید</option>
                                 @foreach($categories as $category)
                                    <option value="{{ $category->id }}" >{{ $category->label }}</option>
                                @endforeach
                            </select>
                            @error('discount.category_id')
                            <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                                <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-3">
                        <label>محصول</label>
                        <div class="mt-2">
                            <select wire:model.defer="discount.product_id" data-placeholder="Select your favorite actors" class="w-full">
                                <option value="null" >انتخاب کنید</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" >{{ $product->name }}</option>
                                @endforeach
                            </select>
                            @error('discount.product_id')
                            <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                                <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-5">
                        <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                            <div class="mr-3">وضعیت</div>
                            <input wire:model.defer="discount.status" data-target="#basic-tooltip" class="show-code input input--switch border" type="checkbox">
                        </div>
                    </div>
                    <div class="mt-5">
                        <label>مهلت استفاده</label>
{{--                        <input wire:model.defer="discount.expired" id="hiddenType" type="text">--}}
{{--                        <input  data-timepicker="true" class="datepicker input w-56 border block mx-auto">--}}
{{--                        <button id="datepicker" type="button" class="button w-24 bg-theme-1 text-white" >ثبت</button>--}}
                        <input wire:model.defer="discount.expired" type="datetime-local" wire:model.defer="discount.expired" value="1401/05/04 16:43:26" class="input w-full border mt-2">
                        @error('discount.expired')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div wire:loading><p style="color: #444;margin: 15px 0;">در حال ایجاد تخفیف ...</p></div>

                    <div class="text-right mt-5">
                        <button type="submit" class="button w-24 bg-theme-1 text-white" >ایجاد</button>
                    </div>
                </form>
            </div>
            <!-- END: Form Layout -->
        </div>
    </div>
</div>
