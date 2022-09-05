<div>
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium ml-auto">
            ویرایش محصول
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5 mx-auto">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <form wire:submit.prevent="edit" class="grid grid-cols-12 gap-12 mt-5 mx-auto" data-file-types="image/jpeg|image/png|image/jpg" enctype="multipart/form-data">
                    <div class="col-span-12 lg:col-span-6">
                        <label>نام محصول</label>
                        <input type="text" wire:model.defer="product.name" class="input w-full border mt-2"value="{{ $product->name }}">
                        @error('product.name')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="col-span-12 lg:col-span-6">
                        <label>متاتگ keywords</label>
                        <textarea wire:model.defer="product.keywords" class="input w-full border mt-2"></textarea>
                        @error('product.keywords')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                        <div class="rounded-md mt-5 px-5 py-4 mb-2 bg-theme-12 text-white">*بین کلمات کلیدی در متا تگ keywords از کاراکتر , استفاده کنید.
                            برای سایت‌های فارسی از 200 کاراکتر بیشتر استفاده نشود.</div>
                    </div>
                    <div wire:ignore class="mt-5 col-span-12 lg:col-span-6 flex" style="flex-direction: column">
                        <label>محتوا محصول</label>
                        <textarea
                            x-data="ckeditor()"
                            x-init="init($dispatch)"
                            wire:key="ckEditor"
                            x-ref="ckEditor"
                            name="editor1" id="editor" class="ProductContent input w-full border mt-2">{{ $product->content }}</textarea>
                        @error('product.content')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-5 col-span-12 lg:col-span-6">
                        <label>متاتگ description</label>
                        <textarea wire:model.defer="product.description" class="input w-full border mt-2"></textarea>
                        @error('product.description')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                        <div class="rounded-md mt-5 px-5 py-4 mb-2 bg-theme-12 text-white">*متا تگ دیسکریپشن باید نهایتا 150 کلمه باشد.</div>
                    </div>
                    <div class="mt-3 col-span-12 lg:col-span-6">
                        <label>دسته بندی</label>
                        <div wire:ignore class="mt-2">
                            <select id="categorySelect" data-placeholder="گزینه های مورد نظر را انتخاب کنید ..." class="w-full" multiple>
                                @foreach($categories_item as $category)
                                    <option value="{{ $category->id }}"
                                            @foreach($product->categories as $productCategory)
                                                @if($productCategory->id == $category->id)
                                                    selected
                                                @endif
                                            @endforeach
                                            >{{ $category->label }}</option>
                                @endforeach
                            </select>
                            @error('categories')
                            <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                                <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-3 col-span-12 lg:col-span-6">
                        <label>برند محصول</label>
                        <div class="mt-2">
                            <select wire:model.defer="brand" class="input w-full">
                                <option value="null" >انتخاب کنید</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->label }}</option>
                                @endforeach
                            </select>
                            @error('brand')
                            <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                                <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-5 col-span-12 lg:col-span-6">
                        <label>قیمت محصول</label>
                        <input type="text" wire:model.defer="product.price" class="input w-full border mt-2"value="{{ $product->price }}">
                        @error('product.price')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-5 col-span-12 lg:col-span-6"></div>
                    <div class="mt-3 col-span-12 lg:col-span-6">
                        <label>گالری محصول</label>
                        <div class="intro-y box mt-5">
                            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                                <h2 class="font-medium text-base ml-auto">
                                    آپلود عکس
                                </h2>
                            </div>
                            <div class="p-5" id="multiple-file-upload">
                                <div class="preview">
                                    <div class="fallback">
                                        <input wire:model="images" type="file" multiple value="Hi"/>
                                        @error('images')
                                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                                        @enderror
                                        @error('file-upload')
                                        <div style="font-size: 12px" class="mt-3 rounded-md px-5 py-4 mb-2 bg-theme-9 text-white">
                                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                                        @enderror
                                        <div class="text-left">
                                            <button wire:click="upload" type="button" class="button w-24 bg-theme-1 text-white" > آپلود و ذخیره</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Multiple File Upload -->
                    </div>
                    <div class="mt-5 col-span-12 lg:col-span-6"></div>
                    <div class="intro-y grid grid-cols-12 gap-3 col-span-12 lg:col-span-6 mt-5">
                        @if($images)
                            @foreach($images as $image)
                                <div class="intro-y col-span-6 sm:col-span-6 md:col-span-6 xxl:col-span-6">
                                    <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                                        <a href="" class="w-3/5 file__icon file__icon--file mx-auto">
                                            <div class="file__icon__file-name"><img src="{{ $image->temporaryUrl() }}" /></div>
                                        </a>
                                        {{--                                        <a href="" class="block font-medium mt-4 text-center truncate">Routes.php</a>--}}
                                        {{--                                        <div class="text-gray-600 text-xs text-center">1 KB</div>--}}
                                        <div class="absolute top-0 right-0 mr-2 mt-2 dropdown ml-auto">
                                            <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <i data-feather="more-vertical" class="w-5 h-5 text-gray-500"></i> </a>
                                            <div class="dropdown-box mt-5 absolute w-40 top-0 right-0 z-10">
                                                <div class="dropdown-box__content box p-2">
                                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="trash" class="w-4 h-4 mr-2"></i> Delete </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        @if(!empty($this->product->photos))
                            @foreach($this->product->photos as $image)
                                <div class="intro-y col-span-6 sm:col-span-6 md:col-span-6 xxl:col-span-6">
                                    <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                                        <a href="" class="w-3/5 file__icon file__icon--file mx-auto">
                                            <div class="file__icon__file-name"><img src="{{ $image->path }}" /></div>
                                        </a>
                                        {{--                                        <a href="" class="block font-medium mt-4 text-center truncate">Routes.php</a>--}}
                                        {{--                                        <div class="text-gray-600 text-xs text-center">1 KB</div>--}}
                                        <div class="absolute top-0 right-0 mr-2 mt-2 dropdown ml-auto">
                                            <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <i data-feather="more-vertical" class="w-5 h-5 text-gray-500"></i> </a>
                                            <div class="dropdown-box mt-5 absolute w-40 top-0 right-0 z-10">
                                                <div class="dropdown-box__content box p-2">
                                                    <a wire:click="deletePhoto({{$image->id}})" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="trash" class="w-4 h-4 mr-2"></i> Delete </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div wire:loading><p style="color: #444;margin: 15px 0;">در حال ویرایش محصول ...</p></div>

                    <div class="text-right mt-5 col-span-12 lg:col-span-12">
                        <button type="submit" class="button w-24 bg-theme-1 text-white" >ویرایش</button>
                    </div>
                </form>
            </div>
            <!-- END: Form Layout -->
        </div>
    </div>
    <style>
        option{
            border-bottom: 1px solid #ececec;
        }
        select{
            border: 1px solid #ececec;
        }
    </style>
    <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
    @push('scripts')
        <script>

            $('#categorySelect').select2();
            $(document).ready(function () {
                $('#categorySelect').select2();
                $('#categorySelect').on('load change', function (e) {
                    var data = $('#categorySelect').select2("val");
                    @this.set('categories', data);
                });
            });

        const editor = CKEDITOR.replace( 'editor1' , {
            "language" : "fa" ,
            'filebrowserUploadUrl' : '{{ route('editor-upload')}}' ,
            'filebrowserUploadMethod' : 'form' ,
        });

        CKEDITOR.instances.editor.on('change', function() {
            @this.set('product.content', this.getData());
        });

        CKEDITOR.plugins.setLang( 'font', 'fa', {
            fontSize: {
                label: 'اندازه',
                voiceLabel: 'اندازه قلم',
                panelTitle: 'اندازه قلم'
            },
            label: 'قلم',
            panelTitle: 'نام قلم',
            voiceLabel: 'قلم'
        } );


    </script>
    @endpush
</div>
