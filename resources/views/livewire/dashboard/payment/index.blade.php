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
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            {{--            <a href="{{ route('warehouse.create') }}" class="button text-white bg-theme-1 shadow-md ml-2">اضافه موجودی به انبار</a>--}}
            <a wire:click="orderBy" class="button text-white bg-theme-1 shadow-md ml-2">تغییر ترتیب چینش</a>
            <a wire:click="changePayOk" class="button text-white bg-theme-1 shadow-md ml-2">مشاهده تراکنش های موفق</a>
            <a wire:click="changePayNull" class="button text-white bg-theme-1 shadow-md ml-2">مشاهده تراکنش های ناموفق</a>
            <a wire:click="changeAll" class="button text-white bg-theme-1 shadow-md ml-2">مشاهده همه تراکنش ها</a>

        </div>
    </div>

    @if($trans_actions->total() != 0)

    <div class="grid grid-cols-12 gap-6 mt-5">
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible" style="overflow-x: auto">
                <table class="table table-report -mt-2">
                    <thead>
                    <tr>
                        @if(auth()->user()->role->hasPermissions("show-all-trans-action"))
                            <th class="text-center whitespace-no-wrap">ID</th>
                        @endif
                        <th class="text-center whitespace-no-wrap">نام کاربر</th>
                        <th class="text-center whitespace-no-wrap">قیمت کل</th>
                        <th class="text-center whitespace-no-wrap">وضعیت پرداخت</th>
                        <th class="text-center whitespace-no-wrap">وضعیت ارسال</th>
                        <th class="text-center whitespace-no-wrap">کد پیگیری</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($trans_actions as $action)
                        <tr class="intro-x">
                            @if(auth()->user()->role->hasPermissions("show-all-trans-action"))
                                <td style="border-radius: 0 5px  5px 0;"  class="w-10 text-center ">
                                    <p class="font-medium whitespace-no-wrap">{{ $action->id }}</p>
                                </td>
                            @endif
                            <td class="w-40 text-center ">
                                <p class="font-medium whitespace-no-wrap"><a style="color: #272792" href="{{ route('users.edit' , $action->user->id) }}">{{ $action->user->name }}</a></p>
                            </td>
                            <td class="w-40 text-center ">
                                <p class="font-medium whitespace-no-wrap"><span id="tuman">{{ $action->price }} تومان </span></p>
                            </td>
                            <td class="text-center ">
                                @if($action->status == 0)
                                    <p class="text-theme-6">ناموفق</p>
                                @else
                                    <p class="text-theme-9">موفق</p>
                                @endif
                            </td>
                            <td class="text-center ">
                                <h2 class="font-medium whitespace-no-wrap ">
                                    @if($action->order->transportation_cost_status == 0)
                                        <p class="text-theme-6">بارگیری نشده</p>
                                    @elseif($action->order->transportation_cost_status == 1)
                                        درحال پردازش
                                    @elseif($action->order->transportation_cost_status == 2)
                                        بارگیری شده
                                    @elseif($action->order->transportation_cost_status == 3)
                                        تحویل پست شد
                                    @elseif($action->order->transportation_cost_status == 4)
                                        <p class="text-theme-9">تحویل مشتری شد</p>
                                    @endif
                                </h2>
                            </td>
                            <td class="text-center ">
                                <p class="font-medium whitespace-no-wrap ">{{ $action->tracking_code ? $action->tracking_code : "__" }}</p>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $trans_actions->links() }}
    </div>
    @else
        <div class="intro-y flex items-center mt-8">
            <h1 class="text-lg font-medium ml-auto">
                تراکنشی تا کنون برای شما ثبت نشده است !
            </h1>
        </div>
    @endif

</div>

