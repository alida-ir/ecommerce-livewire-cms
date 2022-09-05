<div>
    <div class="grid grid-cols-12 gap-12 mt-5 mx-auto">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <form class="grid grid-cols-12 gap-12 mt-5 mx-auto" enctype="multipart/form-data">

                    <div class="intro-y col-span-12 flex items-center mt-2">
                        <h3 class="text-lg font-medium ml-auto">
                            اسلایدر اصلی وبسایت
                        </h3>
                    </div>

                    <div class="intro-y col-span-12 md:col-span-12 lg:col-span-12">
                        <label>آیا اسلایدر اصلی نمایش داده شود ؟</label>
                        <input type="checkbox" wire:model="checkbox" class="input border mr-2" id="vertical-remember-me">
                        @error('checkbox')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    @if($checkbox)
                        <div style="font-size: 12px;" class="rounded-md intro-y col-span-12 md:col-span-6 lg:col-span-6 flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                            <i data-feather="alert-circle" class="w-6 h-6 ml-2"></i>
                            ابعاد پیشنهادی : طول ۱۲۶۶ px در عرض ۲۵۰ px
                        </div>
                    @endif


                    <div class="intro-y col-span-12 md:col-span-12 lg:col-span-12 grid grid-cols-12 gap-12">
                        <div class="mt-2 col-span-5 md:col-span-5 lg:col-span-5 flex h-10 " style="align-items: center">
                            <label style="margin-left: 10px;">عکس</label>
                            <input type="file" wire:model.defer="photo">
                        </div>
                        <div class="mt-2 col-span-7 md:col-span-7 lg:col-span-7 flex h-10" style="align-items: center">
                            <label style="margin-left: 10px;">لینک</label>
                            <input type="text" wire:model.defer="Link" value="{{ $Link }}" class="input w-full border mt-2">
                        </div>
                        @error('photo')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex col-span-5 md:col-span-5 lg:col-span-5 items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                        @error('Link')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex col-span-7 md:col-span-7 lg:col-span-7 items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror


                        <div class="text-right intro-y col-span-12 lg:col-span-12">
                            <button type="submit" wire:click="addToSlider" class="button w-24 bg-theme-1 text-white" >اضافه کردن</button>
                        </div>
                    </div>

                    <div style="font-size: 12px;" class="rounded-md intro-y col-span-12 md:col-span-6 lg:col-span-6 flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                        <i data-feather="alert-circle" class="w-6 h-6 ml-2"></i>
                        اگر بعد از اضافه کردن اسلاید آن را مشاهده نکردید ؛ کش مرورگر خود را پاک کنید !
                    </div>
                    <div style="font-size: 12px;" class="rounded-md intro-y col-span-12 md:col-span-6 lg:col-span-6 flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                        <i data-feather="alert-circle" class="w-6 h-6 ml-2"></i>
                        لینک ها نباید تکراری باشند ؛ در غیر اینطورت در حذف کردن هر دو لینک حذف میشود
                    </div>

                    <div class="intro-y col-span-12 md:col-span-12 lg:col-span-12 grid grid-cols-12 gap-12">
                        @foreach($sliders as $key => $item)
                            <div class="intro-y col-span-6 md:col-span-6 lg:col-span-6">
                                <a href="{{ $item->value }}"><img src="{{ $item->photos[0]->path }}" alt=""></a>
                                <button wire:click.prevent="deleteSlider('{{$item->value}}')" class="btn--delete--slider">حذف</button>
                            </div>
                        @endforeach
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
