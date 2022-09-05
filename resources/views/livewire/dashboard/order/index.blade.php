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
            <a wire:click="orderBy" class="button text-white bg-theme-1 shadow-md ml-2">تغییر ترتیب چینش</a>
            <a wire:click="changeAll" class="button text-white bg-theme-1 shadow-md ml-2">مشاهده همه سفارشات</a>
            <a wire:click="changePayOk" class="button text-white bg-theme-1 shadow-md ml-2">مشاهده سفارشات تسویه شده</a>
            <a wire:click="changeTransStatusOk" class="button text-white bg-theme-1 shadow-md ml-2">مشاهده سفارشات تحویل داده شده</a>
            <a wire:click="changeTransStatusNot" class="button text-white bg-theme-1 shadow-md ml-2">مشاهده سفارشات بارگیری نشده</a>
            <a wire:click="changeTransStatusTrue" class="button text-white bg-theme-1 shadow-md ml-2">مشاهده سفارشات بارگیری شده</a>
        </div>
    </div>
    @if($orders->total() != 0)

    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible" style="overflow-x: auto">
            <table class="table table-report -mt-2">
                <thead>
                <tr>
                    @if(auth()->user()->role->hasPermissions("show-all-order"))
                        <th class="text-center whitespace-no-wrap">ID</th>
                    @endif
                    <th class="text-center whitespace-no-wrap">نام کاربر</th>
                    <th class="text-center whitespace-no-wrap">شماره کاربر</th>
                    <th class="text-center whitespace-no-wrap">هزینه ارسال</th>
                    <th class="text-center whitespace-no-wrap">وضعیت ارسال</th>
                    <th class="text-center whitespace-no-wrap">قیمت کل</th>
                    <th class="text-center whitespace-no-wrap">قیمت قابل پرداخت</th>
                    <th class="text-center whitespace-no-wrap">وضعیت پرداخت</th>
                    <th class="text-center whitespace-no-wrap">عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class="intro-x">
                        @if(auth()->user()->role->hasPermissions("show-all-order"))
                            <td style="border-radius: 0 5px  5px 0;"  class="w-10 text-center ">
                                <p class="font-medium whitespace-no-wrap">{{ $order->id }}</p>
                            </td>
                        @endif
                        <td class="w-40 text-center ">
                            <p class="font-medium whitespace-no-wrap"><a style="color: #272792" href="{{ route('users.edit' , $order->user->id) }}">{{ $order->user->name }}</a></p>
                        </td>
                        <td class="w-40 text-center ">
                            <p class="font-medium whitespace-no-wrap">{{ $order->user->number }}</p>
                        </td>
                        <td class="text-center ">
                            <p class="font-medium whitespace-no-wrap "><span id="tuman">{{ $order->transportation_cost }}</span> تومان</p>
                        </td>
                        <td class="text-center ">
                            <h2 class="font-medium whitespace-no-wrap ">
                                @if($order->transportation_cost_status == 0)
                                      <p class="text-theme-6">بارگیری نشده</p>
                                 @elseif($order->transportation_cost_status == 1)
                                    درحال پردازش
                                @elseif($order->transportation_cost_status == 2)
                                    بارگیری شده
                                @elseif($order->transportation_cost_status == 3)
                                    تحویل پست شد
                                @elseif($order->transportation_cost_status == 4)
                                    <p class="text-theme-9">تحویل مشتری شد</p>
                                @endif
                            </h2>
                        </td>
                        <td class="text-center ">
                            <p class="font-medium whitespace-no-wrap "><span id="tuman">{{ $order->total_price }}</span> تومان</p>
                        </td>
                        <td class="text-center ">
                            <p class="font-medium whitespace-no-wrap "><span id="tuman">{{ $order->payment_price }}</span> تومان </p>
                        </td>
                        <td class="text-center ">
                            <h2 class="font-medium whitespace-no-wrap ">
                                @if($order->payment_status == 0)
                                   <p class="text-theme-6">پرداخت نشده</p>
                                @else
                                   <p class="text-theme-9">پرداخت شده</p>
                                @endif
                            </h2>
                        </td>

                        <td style="border-radius: 5px 0 0 5px;" class="table-report__action w-56 text-center ">
                            <div class="flex justify-center items-center">
                                <a class="flex  items-center mr-3" style="width: 120px;" href="{{ route('order.detail' , $order->id)}}"> <i data-feather="check-square" class="w-4 h-4 ml-1"></i> جزییات سفارش </a>
{{--                                <a class="flex items-center mr-3" href="{{ route('order.edit' , $order->id)}}"> <i data-feather="check-square" class="w-4 h-4 ml-1"></i> ویرایش </a>--}}
                                {{--                                <form id="delete-{{$product->id}}" action="{{ route('product.destroy' , $product->id) }}" method="post">@csrf @method('DELETE')</form>--}}
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $orders->links() }}
    </div>
    @else
        <div class="intro-y flex items-center mt-8">
            <h1 class="text-lg font-medium ml-auto">
                سفارشی تا کنون برای شما ثبت نشده است !
            </h1>
        </div>
    @endif
</div>

