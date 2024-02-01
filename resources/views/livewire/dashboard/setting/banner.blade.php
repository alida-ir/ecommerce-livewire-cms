<div>
    <div class="grid grid-cols-12 gap-12 mt-5 mx-auto">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <form class="grid grid-cols-12 gap-12 mt-5 " enctype="multipart/form-data">
                    <div style="font-size: 12px;" class="rounded-md intro-y col-span-12 md:col-span-6 lg:col-span-6 flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                        <i data-feather="alert-circle" class="w-6 h-6 ml-2"></i>
                        ابعاد پیشنهادی : طول ۳۷۰ px در عرض ۲۹۰ px
                    </div>

                    <div class="intro-y col-span-12 flex items-center mt-2">
                        <h3 class="text-lg font-medium ml-auto">
                            بنر اول
                        </h3>
                    </div>

                    <div class="intro-y col-span-12 md:col-span-12 lg:col-span-12">
                        <label>آیا بنر اول نمایش داده شود ؟</label>
                        <input type="checkbox" wire:model="checkbox" class="input border mr-2" id="vertical-remember-me">
                        @error('checkbox')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-6 md:col-span-6 lg:col-span-6">
                        <label>بنر جدید را آپلود کنید</label>
                        <input type="file" wire:model="oneBannerNewPhoto" class="input border mr-2" id="vertical-remember-me">
                        @error('oneBannerNewPhoto')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-6 md:col-span-6 lg:col-span-6">
                        <label>لینک بنر جدید را وارد کنید</label>
                        <input type="text" wire:model.lazy="oneBannerNewLink" class="input border mr-2" id="vertical-remember-me">
                        @error('oneBannerNewLink')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 md:col-span-12 lg:col-span-12">
                        @if($oneBannerPhoto)
                            <div class="intro-y col-span-12 md:col-span-12 lg:col-span-12">
                                <a href="{{ $oneBanner->value }}"><img src="{{ $oneBannerPhoto->path }}" alt=""></a>
                            </div>
                        @endif
                    </div>


                    <div class="intro-y col-span-12 flex items-center mt-2">
                        <h3 class="text-lg font-medium ml-auto">
                            بنر دوم
                        </h3>
                    </div>

                    <div class="intro-y col-span-12 md:col-span-12 lg:col-span-12">
                        <label>آیا بنر دوم نمایش داده شود ؟</label>
                        <input type="checkbox" wire:model="checkbox2" class="input border mr-2" id="vertical-remember-me">
                        @error('checkbox2')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-6 md:col-span-6 lg:col-span-6">
                        <label>بنر جدید را آپلود کنید</label>
                        <input type="file" wire:model="twoBannerNewPhoto" class="input border mr-2" id="vertical-remember-me">
                        @error('twoBannerNewPhoto')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-6 md:col-span-6 lg:col-span-6">
                        <label>لینک بنر جدید را وارد کنید</label>
                        <input type="text" wire:model.lazy="twoBannerNewLink" class="input border mr-2" id="vertical-remember-me">
                        @error('twoBannerNewLink')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="intro-y col-span-12 md:col-span-12 lg:col-span-12">
                        @if($twoBannerPhoto)
                            <div class="intro-y col-span-12 md:col-span-12 lg:col-span-12">
                                <a href="{{ $twoBanner->value }}"><img src="{{ $twoBannerPhoto->path }}" alt=""></a>
                            </div>
                        @endif
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

</div>
