<div>
    <div wire:loading>
        <div class="col-span-6 mt-4 mr-2 mb-5 sm:col-span-3 xl:col-span-2 flex items-center">
            <div class="text-center text-md ml-5">در حال پردازش اطلاعات ...</div>
            <i data-loading-icon="bars" class="w-8 h-8"></i>
        </div>
    </div>

    <div class="intro-x relative mr-3 sm:mr-6 mt-5">
        <div class="search hidden sm:block">
            <input wire:model.debalance.1000ms="search" class="search__input input placeholder-theme-13" type="search" placeholder="Search posts by title...">
            <i data-feather="search" class="search__icon"></i>
        </div>
        <a class="notification sm:hidden" href=""> <i data-feather="search" class="notification__icon"></i> </a>
    </div>
    @if($roles->total() != 0)

    <div class="grid grid-cols-12 gap-6 mt-2">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
                    <a href="{{ route('role.create') }}" class="button text-white bg-theme-1 shadow-md ml-2">ایجاد دسترسی</a>
                    <a wire:click="orderBy" class="button text-white bg-theme-1 shadow-md ml-2">تغییر ترتیب چینش</a>
        </div>

        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                <tr>
                    <th class="text-center whitespace-no-wrap">ID</th>
                    <th class="text-center whitespace-no-wrap">نام</th>
                    <th class="text-center whitespace-no-wrap">برچسب</th>
                    <th class="text-center whitespace-no-wrap">وضعیت</th>
                    <th class="text-center whitespace-no-wrap">مجوز ها</th>
                    <th class="text-center whitespace-no-wrap">عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr class="intro-x">
                        <td style="border-radius: 0 5px  5px 0;"  class="w-10 text-center ">
                            <p class="font-medium whitespace-no-wrap">{{ $role->id }}</p>
                        </td>
                        <td class="w-40 text-center ">
                            <p class="font-medium whitespace-no-wrap">{{ $role->title }}</p>
                        </td>
                        <td class="text-center ">
                            <p class="font-medium whitespace-no-wrap ">{{ $role->label }}</p>
                        </td>
                        <td class="w-40">
                            <div class="flex items-center justify-center {{ $role->deleted_at ? "text-theme-6" : "text-theme-9" }}"> <i data-feather="check-square" class="w-4 h-4 ml-2"></i> @if($role->deleted_at) حذف شده@else فعال@endif </div>
                        </td>
                        <td class="width-100">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <select class="input w-full border flex-1">
                                    <option selected>مشاهده مجوز ها</option>
                                    @if($role->permissions != null)
                                    @foreach($role->permissions as $permission)
                                        <option>{{ $permission->label }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </td>
                        <td style="border-radius: 5px 0 0 5px;" class="table-report__action w-56 text-center ">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="{{ route('role.edit' , $role->id)}}"> <i data-feather="check-square" class="w-4 h-4 ml-1"></i> ویرایش </a>
                                <a class="flex items-center text-theme-6 mr-5" wire:click="deleteRole({{ $role->id }})"> <i data-feather="trash-2" class="w-4 h-4 ml-1"></i> حذف </a>
{{----}}
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $roles->links() }}
    </div>
    @else
        <div class="intro-y flex items-center mt-8">
            <h1 class="text-lg font-medium ml-auto">
                سطح دسترسی تا کنون ثبت نشده است !
            </h1>
        </div>
    @endif
</div>
