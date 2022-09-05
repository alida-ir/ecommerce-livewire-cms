<div>
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium ml-auto">
            ویرایش سطح دسترسی
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5 mx-auto">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
{{--            <link rel="stylesheet" href="{{ asset('assets/dashboard/css/virtual-select.min.css') }}" />--}}
{{--            <script src="{{ asset('assets/dashboard/js/virtual-select.min.js') }}"></script>--}}
{{--            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--            <script src="dist/virtual-select.min.js"></script>--}}
            <div class="intro-y box p-5">
                <form method="post" wire:submit.prevent="update">
                    @method('PUT')
                    @csrf
                    <div>
                        <label>نام دسترسی</label>
                        <input type="text" wire:model.defer="role.title" class="input w-full border mt-2">
                        @error('title')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>برچسب</label>
                        <input type="text" wire:model.defer="role.label" class="input w-full border mt-2">
                        @error('label')
                        <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                            <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>مجوز ها</label>
                        <div class="mt-2">
                            <select id="select2-dropdown" data-placeholder="گزینه مد نظر را انتخاب کنید" class="w-full" multiple>
                                @foreach($permissions as $key => $permission )
                                    <option value="{{ $permission->id }} "
                                            @if($selectPermission != null)
                                                @foreach($selectPermission as $value)
                                                    @if($value == $permission->id)
                                                        selected
                                                      @endif
                                               @endforeach
                                            @endif
                                    >{{ $permission->label }}</option>
                                @endforeach
                            </select>
                            @error('permission')
                            <div style="font-size: 12px" class="mt-3 rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                                <i data-feather="alert-octagon" class="w-6 h-6 ml-2"></i> {{ $message }} </div>
                            @enderror
                        </div>
{{--                    </div>--}}
                    <div class="text-right mt-5">
                        <button type="submit" class="button w-24 bg-theme-1 text-white" >ذخیره</button>
                    </div>
                </form>
            </div>
            <!-- END: Form Layout -->
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#select2-dropdown').on('change', function (e) {
                    var data = $('#select2-dropdown').select2("val");
                    @this.set('selectPermission', data);
                });
            });
            window.addEventListener('LoadSelect', event => {
                $('#select2-dropdown').select2();
            });
            $('#select2-dropdown').select2();
        </script>
    @endpush
</div>
