<div>
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium ml-auto">
            تنظیمات وبسایت
        </h2>
    </div>

    <div class="grid grid-cols-12 gap-12 mt-5 mx-auto">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <form class="grid grid-cols-12 gap-12 mt-5 mx-auto" wire:submit.prevent="setting" enctype="multipart/form-data">

                    <div class="intro-y col-span-12 flex items-center mt-2">
                        <h3 class="text-lg font-medium ml-auto">
                            تنظیمات صفحه اصلی
                        </h3>
                    </div>
                    <div class="intro-y col-span-12 md:col-span-12 lg:col-span-12">
                        <label>دسته بندی های مدنظر برای نمایش در صفحه اول را انتخاب کنید</label>
                        <div>
                            <div wire:ignore class="mt-3">
                                <select class="select2 w-full" id="select2-dropdown" data-placeholder="گزینه مد نظر را انتخاب کنید" multiple>
                                    @foreach($categories as $key => $item)
                                        <option value="{{ $item['id'] }}"
                                                @foreach($itemCategory as $value)
                                                    @if($item['id'] == $value)
                                                        selected
                                                     @endif
                                                @endforeach
                                        >{{ $item['label'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div style="font-size: 12px;" class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 mt-3 text-white">
                            <i data-feather="alert-circle" class="w-6 h-6 ml-2"></i>
                            دسته بندی هایی را مجاز به انتخاب هستید که حداقل ۷ محصول داشته باشند !
                            ( به دلیل خالی بود صفحه اصلی سایت ؛ یک دسته بندی شامل این فیلتر نمیباشد ! )
                        </div>
                    </div>

                    <div class="intro-y col-span-12 md:col-span-12 lg:col-span-12">
                        <label>آیا بخش آخرین محصولات نمایش داده شود ؟</label>
                        <input type="checkbox" wire:model="showLastProduct" class="input border mr-2" id="vertical-remember-me">
                        @error('showLastProduct')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>




                    <div class="intro-y col-span-12 flex items-center mt-2">
                        <h3 class="text-lg font-medium ml-auto">
                            تنظیمات فروشگاه
                        </h3>
                    </div>

                    <div class="intro-y col-span-12 flex items-center mt-2">
                        <h3 class="text-lg font-medium ml-auto">
                            مشخصات فروشگاه
                        </h3>
                    </div>

                    <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4">
                        <label>نام فروشگاه</label>
                        <div class="mt-2">
                            <input type="text" wire:model.defer="shopping_name.value" value="{{ $shopping_name->value }}" class="input w-full border mt-2">
                        </div>
                        @error('shopping_name.value')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-5 intro-y col-span-12 md:col-span-6 lg:col-span-4">
                        <label>عنوان فروشگاه</label>
                        <div class="mt-2">
                            <input type="text" wire:model.defer="shopping_title.value" value="{{ $shopping_title->value }}"  class="input w-full border mt-2">
                        </div>
                        @error('shopping_title.value')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                        <div class="rounded-md mt-5 px-5 py-4 mb-2 bg-theme-12 text-white"> در بالای صفحه ( قسمت تب ها ) نشان داده میشود</div>
                    </div>

                    <div class="mt-5 intro-y col-span-12 md:col-span-6 lg:col-span-4">
                        <label>لوگوی فروشگاه</label>
                        <div class="mt-2">
                            <input type="file" name="logo" wire:model="logo" class="input w-full border mt-2">
                        </div>
                        @error('logo')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                        @if ($logo)
                            <img src="{{ $logo->temporaryUrl() }}" style="margin: 15px" width="200px" alt="Logo" />
                        @endif
                        @if(!$logo && $logoUrl)
                            <img src="{{ $logoUrl }}" style="margin: 15px" width="200px" alt="Logo" />
                        @endif
                        <div class="rounded-md mt-5 px-5 py-4 mb-2 bg-theme-12 text-white">ابعاد پیشنهادی : طول ۱۵۵ px و عرض 55 تا ۷۰ px</div>
                    </div>

                    <div class="mt-5 intro-y col-span-12 md:col-span-6 lg:col-span-4">
                        <label>فاوآیکون فروشگاه</label>
                        <div class="mt-2">
                            <input type="file" wire:model="favicon" class="input w-full border mt-2">
                        </div>
                        @error('favicon')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                        @if ($favicon)
                            <img src="{{ $favicon->temporaryUrl() }}" style="margin: 15px" width="200px" alt="Logo" />
                        @endif
                        @if(!$favicon && $faviconUrl)
                            <img src="{{ $faviconUrl }}" style="margin: 15px" width="200px" alt="Logo" />
                        @endif
                        <div class="rounded-md mt-5 px-5 py-4 mb-2 bg-theme-12 text-white"> ابعاد پیشنهادی : طول ۱۶ px و عرض ۱۶ px فرمت پیشنهادی : png ؛ ico ؛ gif</div>
                    </div>


                    <div class="mt-5 intro-y col-span-12 md:col-span-6 lg:col-span-4">
                        <label>آدرس فروشگاه</label>
                        <div class="mt-2">
                            <input type="text" wire:model.defer="shopping_address.value" value="{{ $shopping_address['value'] }}"  class="input w-full border mt-2">
                        </div>
                        @error('shopping_address.value')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-5 intro-y col-span-12 md:col-span-6 lg:col-span-4">
                        <label>شماره فروشگاه</label>
                        <div class="mt-2">
                            <input type="text" wire:model.defer="shopping_number.value" value="{{ $shopping_number->value }}"  class="input w-full border mt-2">
                        </div>
                        @error('shopping_number.value')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-5 intro-y col-span-12 md:col-span-6 lg:col-span-4">
                        <label>ایمیل فروشگاه</label>
                        <div class="mt-2">
                            <input type="text" wire:model.defer="shopping_email.value" value="{{ $shopping_email->value }}"  class="input w-full border mt-2">
                        </div>
                        @error('shopping_email.value')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>

                    <div class="intro-y col-span-12 flex items-center mt-8">
                        <h3 class="text-lg font-medium ml-auto">
                            شبکه های اجتماعی
                        </h3>
                    </div>


                    <div class="mt-5 intro-y col-span-12 md:col-span-6 lg:col-span-4">
                        <label>تلگرام</label>
                        <div class="mt-2">
                            <input type="text" wire:model.defer="shopping_telegram.value" value="{{ $shopping_telegram->value }}"  class="input w-full border mt-2">
                        </div>
                        @error('shopping_telegram.value')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-5 intro-y col-span-12 md:col-span-6 lg:col-span-4">
                        <label>اینیستاگرام</label>
                        <div class="mt-2">
                            <input type="text" wire:model.defer="shopping_instagram.value" value="{{ $shopping_instagram->value }}"  class="input w-full border mt-2">
                        </div>
                        @error('shopping_instagram.value')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-5 intro-y col-span-12 md:col-span-6 lg:col-span-4">
                        <label>توییتر</label>
                        <div class="mt-2">
                            <input type="text" wire:model.defer="shopping_twitter.value" value="{{ $shopping_twitter->value }}"  class="input w-full border mt-2">
                        </div>
                        @error('shopping_twitter.value')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>


                    <div class="text-right mt-5 intro-y col-span-12 lg:col-span-12">
                        <button type="submit" class="button w-24 bg-theme-1 text-white" >ویرایش</button>
                    </div>
                </form>
            </div>
            <!-- END: Form Layout -->
        </div>
    </div>
    @if($message)
        <script>
            Swal.fire({
                title: 'موفقیت آمیز',
                text: "ویرایش با موفقیت انجام شد !",
                icon: 'success',
                showCancelButton: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    @php
                        $this->emit('okSave')
                    @endphp
                }
            })
        </script>
    @endif

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#select2-dropdown').select2();
                $('#select2-dropdown').on('change', function (e) {
                    var data = $('#select2-dropdown').select2("val");
                    @this.set('itemCategory', data);
                });
            });
        </script>

    @endpush
</div>

