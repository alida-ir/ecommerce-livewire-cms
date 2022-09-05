<div>
    <div class="grid grid-cols-12 gap-12 mt-5 mx-auto">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <div class="grid grid-cols-12 gap-12 mt-5 mx-auto">

                    <div class="intro-y col-span-12 flex items-center mt-2">
                        <h3 class="text-lg font-medium ml-auto">
                            منوی اصلی وبسایت
                        </h3>
                    </div>

                    <div class="intro-y col-span-12 md:col-span-12 lg:col-span-12">
                        <label>آیا زیر منوی همه ی دسته بندی ها نمایش داده شود ؟</label>
                        <input type="checkbox" wire:model="checkbox" class="input border mr-2" id="vertical-remember-me">
                        @error('checkbox')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>

                    <div class="intro-y col-span-6 md:col-span-6 lg:col-span-6">
                        <label>دسته بندی های مدنظر برای نمایش در منو را انتخاب کنید</label>
                        <div>
                            <div wire:ignore class="mt-3">
                                <select class="w-full" id="select2-dropdown" data-placeholder="گزینه مد نظر را انتخاب کنید" multiple>
                                    @foreach($categories as $key => $item)
                                        <option value="{{ $item->id }}"
                                            @foreach($itemMenu as $value)
                                                @if($item->id == $value)
                                                    selected
                                                @endif
                                            @endforeach
                                        >{{ $item->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="intro-y col-span-12 flex items-center mt-8">
                        <h3 class="text-lg font-medium ml-auto">
                            دسترسی سریع
                        </h3>
                    </div>

                    <div class="intro-y col-span-12 md:col-span-12 lg:col-span-12 grid grid-cols-12 gap-12">
                        <div class="mt-2 col-span-5 md:col-span-5 lg:col-span-5 flex h-10 " style="align-items: center">
                            <label style="margin-left: 10px;">برچسب</label>
                            <input type="text" wire:model.defer="inputTitle" value="{{ $inputTitle }}" class="input w-full border mt-2">
                        </div>
                        <div class="mt-2 col-span-7 md:col-span-7 lg:col-span-7 flex h-10" style="align-items: center">
                            <label style="margin-left: 10px;">لینک</label>
                            <input type="text" wire:model.defer="inputLink" value="{{ $inputLink }}" class="input w-full border mt-2">
                        </div>
                        @error('inputTitle')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex col-span-5 md:col-span-5 lg:col-span-5 items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                        @error('inputLink')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex col-span-7 md:col-span-7 lg:col-span-7 items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror


                        <div class="text-right intro-y col-span-12 lg:col-span-12">
                            <button type="submit" wire:click="addToQuick" class="button w-24 bg-theme-1 text-white" >اضافه کردن</button>
                        </div>
                    </div>

                    <div class="intro-y col-span-12 md:col-span-12 lg:col-span-12">
                        @foreach($accessTitles as $key => $item)
                            <div class="flex mb-5">
                                <li class="top__menu--li"><a href="{{ $accessLinks[$key] }}">{{$item}}</a></li>
                                <button wire:click.prevent="deleteAccess('{{$item}}' , '{{ $accessLinks[$key] }}')" class="mr-5">حذف</button>
                            </div>
                        @endforeach
                    </div>

                </div>
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
                    @this.set('itemMenu', data);
                });
            });
        </script>
@endpush



</div>
