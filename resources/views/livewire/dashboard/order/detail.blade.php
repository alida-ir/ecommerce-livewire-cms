<div>
    <div wire:loading>
        <div class="col-span-6 mt-4 mr-2 mb-5 sm:col-span-3 xl:col-span-2 flex items-center">
            <div class="text-center text-md ml-5">در حال پردازش اطلاعات ...</div>
            <i data-loading-icon="bars" class="w-8 h-8"></i>
        </div>
    </div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium ml-auto">
            جزییات سفارش
        </h2>
    </div>
    <div class="overflow-x-auto mt-5">
        <table class="table">
            <thead>
            <tr>
                <th class="border border-b-2 whitespace-no-wrap text-right">ID</th>
                <th class="border border-b-2 whitespace-no-wrap text-right">نام محصول</th>
                <th class="border border-b-2 whitespace-no-wrap text-right">قیمت اصلی</th>
                <th class="border border-b-2 whitespace-no-wrap text-right">قیمت خریداری شده</th>
                <th class="border border-b-2 whitespace-no-wrap text-right">تعداد سفارش محصول</th>
                <th class="border border-b-2 whitespace-no-wrap text-right">قیمت کل</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->orderItems as $item)
                <tr>
                    <td class="border text-right">{{ $item->id }}</td>
                    <td class="border text-right">{{ $item->product->name }}</td>
                    <td class="border text-right"><span id="tuman">{{ $item->product->price }} </span> تومان </td>
                    <td class="border text-right"><span id="tuman">{{ $item->price / $item->quantity }}</span> تومان </td>
                    <td class="border text-right">{{ $item->quantity }} عدد </td>
                    <td class="border text-right"><span id="tuman">{{ $item->price }} </span> تومان </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="intro-y flex items-center mt-8" style="flex-direction: column;">
        <h2 class="text-lg font-medium ml-auto">
            مشخصات کاربر
        </h2>
    </div>
    <div class="overflow-x-auto mt-5">
        <table class="table">
            <thead>
            <tr>
                <th class="border border-b-2 whitespace-no-wrap text-right">ID</th>
                <th class="border border-b-2 whitespace-no-wrap text-right">نام کاربر</th>
                <th class="border border-b-2 whitespace-no-wrap text-right">ایمیل کاربر</th>
                <th class="border border-b-2 whitespace-no-wrap text-right">شماره کاربر</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border text-right">{{ $order->user->id }}</td>
                    <td class="border text-right">{{ $order->user->name }}</td>
                    <td class="border text-right">{{ $order->user->email }}</td>
                    <td class="border text-right">{{ $order->user->number }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="intro-y flex items-center mt-8" style="flex-direction: column;">
        <h2 class="text-lg font-medium ml-auto">
            مشخصات ارسال
        </h2>
    </div>
    <div class="overflow-x-auto mt-5">
        <table class="table">
            <thead>
            <tr>
                <th class="border w-24 border-b-2 whitespace-no-wrap text-right">هزینه ارسال</th>
                <th class="border w-40 border-b-2 whitespace-no-wrap text-right">وضعیت ارسال</th>
                <th class="border w-32 border-b-2 whitespace-no-wrap text-right">کد پستی</th>
                <th class="border w-32 border-b-2 whitespace-no-wrap text-right">استان</th>
                <th class="border border-b-2 whitespace-no-wrap text-right">آدرس</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border text-right"><span id="tuman">{{ $order->transportation_cost }}</span> تومان </td>
                    <td class="border text-right" style="padding: 10px">
                        @if($order->transportation_cost_status == 0)
                            <p class="text-theme-6" style="float: right">بارگیری نشده</p>
                        @elseif($order->transportation_cost_status == 1)
                            <p class="text-theme-4" style="float: right">درحال پردازش</p>
                        @elseif($order->transportation_cost_status == 2)
                            <p class="text-theme-4" style="float: right">بارگیری شده</p>
                        @elseif($order->transportation_cost_status == 3)
                            <p class="text-theme-4" style="float: right">تحویل پست شد</p>
                        @elseif($order->transportation_cost_status == 4)
                            <p class="text-theme-9" style="float: right">تحویل مشتری شد</p>
                        @endif
                        @if($can_update)
                            <div class="text-center" style="float: left">
                                <a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview" class="button inline-block bg-theme-1 text-white">
                                    {{--                                <i data-feather="check-square" class="w-4 h-4"></i>--}}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                    </svg>
                                </a>
                            </div>
                            <div class="modal" id="header-footer-modal-preview">
                                <div class="modal__content">
                                    <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                                        <div class="col-span-12 sm:col-span-6">
                                            <label>وضعیت ارسال</label>
                                            <select wire:model="order.transportation_cost_status" class="input w-full border mt-2 flex-1">
                                                <option value="0">بارگیری نشده</option>
                                                <option value="1">درحال پردازش</option>
                                                <option value="2">بارگیری شده</option>
                                                <option value="3">تحویل پست شد</option>
                                                <option value="4">تحویل مشتری شد</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="px-5 py-3 text-right border-t border-gray-200">
                                        <button type="button" class="button w-20 border text-gray-700 ml-1" data-dismiss="modal">لغو</button>
                                        <button type="button" wire:click="saveStatus" data-dismiss="modal" class="button w-20 bg-theme-1 text-white">ذخیره</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
                    <td class="border text-right">{{ $order->zip_code }}</td>
                    <td class="border text-right">{{ $order->state }}</td>
                    <td class="border text-right">{{ $order->address }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium ml-auto">
            مشخصات کل سفارش
        </h2>
    </div>
    <div class="overflow-x-auto mt-5">
        <table class="table mt-2">
            <thead>
            <tr>
                <th class="border border-b-2 whitespace-no-wrap text-right">قیمت کل</th>
                <th class="border border-b-2 whitespace-no-wrap text-right">قیمت پرداخت شده</th>
                <th class="border border-b-2 whitespace-no-wrap text-right">وضعیت پرداخت</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="border text-right"><span id="tuman">{{ $order->total_price + $order->transportation_cost }} تومان </span></td>
                <td class="border text-right"><span id="tuman">{{ $order->payment_price }} تومان </span></td>
                <td class="border text-right">
                    @if($order->payment_status == 0)
                        <p class="text-theme-6">پرداخت نشده</p>
                    @elseif($order->payment_status == 1)
                        <p class="text-theme-9">تسویه شده است</p>
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    @if(!empty($Discounts))
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium ml-auto">
                تخفیف استفاده شده
            </h2>
        </div>
        <div class="overflow-x-auto mt-5">
            <table class="table mt-2">
                <thead>
                <tr>
                    <th class="border border-b-2 whitespace-no-wrap text-right">نام تخفیف</th>
                    <th class="border border-b-2 whitespace-no-wrap text-right">درصد تخفیف</th>
                    <th class="border border-b-2 whitespace-no-wrap text-right">محصول</th>
                    <th class="border border-b-2 whitespace-no-wrap text-right">دسته بندی</th>
                    <th class="border border-b-2 whitespace-no-wrap text-right">تاریخ انقضا</th>
                </tr>
                </thead>
                <tbody>
                @foreach($Discounts as $discount)
                 <tr>
                    <td class="border text-right">{{ $discount['name'] }}</td>
                    <td class="border text-right">{{ $discount['quantity'] }} %</td>
                    <td class="border text-right">{{ $discount['product']['name'] ?? "__" }}</td>
                    <td class="border text-right">{{ $discount['category']['label'] ?? "__" }}</td>
                    <td class="border text-right">{{ verta($discount['expired'])->format('H:i:s  Y/m/d') }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium ml-auto">
            صورت حساب ها
        </h2>
    </div>
    @if(empty($this->order->transActions))

        <h2 class="text-lg font-medium ml-auto text-theme-6">
            تسویه حساب نشده است
        </h2>
    @else
        <div class="overflow-x-auto mt-5">
            <table class="table mt-2">
                <thead>
                <tr>
                    <th class="border border-b-2 whitespace-no-wrap text-right">قیمت کل</th>
                    <th class="border border-b-2 whitespace-no-wrap text-right">کد پیگیری</th>
                    <th class="border border-b-2 whitespace-no-wrap text-right">وضعیت پرداخت</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($order->transActions as $action)
                        <tr>
                            <td class="border text-right"><span id="tuman">{{ $action->price }}</span> تومان </td>
                            <td class="border text-right">{{ $action->tracking_code }}</td>
                            <td class="border text-right">
                                @if($action->status == 0)
                                    <h2 class="text-lg font-medium ml-auto text-theme-6">
                                        تسویه حساب نشده است
                                    </h2>
                                @elseif($action->status == 1)
                                    <h2 class="text-lg font-medium ml-auto text-theme-9">
                                        تسویه حساب شده است
                                    </h2>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <button onclick="window.print()" class="button text-white bg-theme-1 shadow-md ml-2 mt-5 pt-3">Print</button>

</div>

