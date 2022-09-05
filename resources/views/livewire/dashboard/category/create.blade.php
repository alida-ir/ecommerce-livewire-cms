<div>
    <div wire:loading>
        <div class="col-span-6 mt-4 mr-2 mb-5 sm:col-span-3 xl:col-span-2 flex items-center">
            <div class="text-center text-md ml-5">در حال پردازش اطلاعات ...</div>
            <i data-loading-icon="bars" class="w-8 h-8"></i>
        </div>
    </div>
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium ml-auto">
            ایجاد دسته بندی
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5 mx-auto">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <form wire:submit.prevent="create">
                    <div>
                        <label>نام دسته بندی</label>
                        <input type="text" wire:model.defer="category.title" class="input w-full border mt-2">
                        @error('category.title')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div>
                        <label>برچسب دسته بندی</label>
                        <input type="text" wire:model.defer="category.label" class="input w-full border mt-2">
                        @error('category.label')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>دسته بندی والد</label>
                        <div class="mt-2">
                            <select wire:model.defer="category.parent_id" data-placeholder="Select your favorite actors" class="w-full">
                                <option value="null" >بدون دسته بندی والد</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" >{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('category.parent_id')
                            {{--                                @dd($errors->messages('user_roles'))--}}
                            <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                                <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-5">
                        <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                            <div class="mr-3">آیا این دسته بندی فعال باشد ؟</div>
                            <input wire:model.defer="category.status" data-target="#basic-tooltip" class="show-code input input--switch border" type="checkbox"
                                   @if($category->status)
                                       checked
                                  @endif
                            >
                        </div>
                        @error('category.status')
                        {{--                                @dd($errors->messages('user_roles'))--}}
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-5">
                        <label>تصویر دسته بندی</label>
                        <div class="mt-2">
                            <input wire:model="photo" type="file">
                        </div>

                        <div class="mt-5">
                            @if($photo)
                                <img src="{{ $photo->temporaryUrl() }}" />
                            @endif
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
