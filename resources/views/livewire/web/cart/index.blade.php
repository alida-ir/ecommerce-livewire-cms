<div class="fluid">
    <div wire:loading id="wireLoading">
        <div class="col-span-6 mt-4 mr-2 mb-5 sm:col-span-3 xl:col-span-2 flex items-center">
            <div class="text-center text-md ml-5">در حال پردازش اطلاعات ...</div>
            <i data-loading-icon="bars" class="w-8 h-8"></i>
        </div>

        <script>
            Swal.fire({
                icon: 'error',
                text: "وارد کردن کد پستی اجباری میباشد !",
            })
        </script>
    </div>
    <article>
        @if($Load)
            @if($cartEmpty != true)

                <h1>سبد خرید <span>{{ count($products ?? []) }}</span></h1>
                <div class="main__cart">

                <div class="main__cart__details">
                <div class="DeleteAll">
                    <div class="delete--all__btn" id="DeleteBtn">
                        <!--                                <img id="DeleteBtn"  src="image/16170282501586786423.svg" alt="">-->
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <div wire:click="deleteAllCart" class="delete--all__box">
                        <span>خالی کردن سبد خرید</span>
                    </div>
                </div>
                <h2>جزئیات سبد خرید شما</h2>
                <span>{{ count($products ?? []) }} کالا</span>

                @if($products)
                @foreach($products as $product)
                    @if($buyProduct[$product['id']]['can'] == true)
                        <div class="main__cart__details--product">
                            <div class="main__cart__details--product__right">
                                <a href="{{ route('product.item' , $product['slug']) }}">
                                    <img src="{{$product['photos'][0]['path']}}" alt="">
                                </a>
                                <div class="main__cart__details--product__right--counter">
                                    <div wire:click="ChangeCount({{$this->buyProduct[$product['id']]['count'] + 1}} , {{$product['id']}})" class="main__cart__details--product__right--btn">+</div>
                                    <div class="main__cart__details--product__right--count">{{ $this->buyProduct[$product['id']]['count'] }}</div>
                                    <div wire:click="ChangeCount({{$this->buyProduct[$product['id']]['count'] - 1}} , {{$product['id']}})" class="main__cart__details--product__right--btn">-</div>
                                </div>
                            </div>
                            <div class="main__cart__details--product__left">
                                <div wire:click="deleteCart({{$product['id']}})" class="DeleteProduct">
                                    <img src="{{ asset('assets/web/image') }}/close.svg" alt="">
                                </div>
                                <span>{{ $product['name'] }}</span>
                                @if(array_key_exists('color' , $buyProduct[$product['id']]))
                                <div class="color">
                                    <span style="background: {{ $buyProduct[$product['id']]['hex'] }}"></span>
                                    <span>{{ $buyProduct[$product['id']]['color'] }}</span>
                                </div>
                                @endif
                                @if(array_key_exists('size'  ,$buyProduct[$product['id']]))
                                <p class="size">سایز : {{ $buyProduct[$product['id']]['size'] }}</p>
                                @endif
                                <p class="trans rial">هزینه ارسال : {{ $this->buyProduct[$product['id']]['transportation'] }} تومان</p>
                                @if(array_key_exists('discount' ,$buyProduct[$product['id']]))
                                <p class="discount rial">{{ $buyProduct[$product['id']]['OldCount'] - $buyProduct[$product['id']]['New'] }} تومان تخفیف</p>
                                @endif
                                <span class="price rial">{{ $this->buyProduct[$product['id']]['New'] }} تومان</span>
                                <p class="quantity"> تنها {{ $buyProduct[$product['id']]['warehouses'] }} عدد در انبار باقی مانده</p>
                            </div>
                        </div>
                    @else
                        <div class="main__cart__details--product">
                            <div class="main__cart__details--product__right">
                                <a href="{{ route('product.item' , $product['slug']) }}">
                                    <img src="{{$product['photos'][0]['path']}}" alt="">
                                </a>
                            </div>
                            <div class="main__cart__details--product__left">
                                <span>{{ $product['name'] }}</span>
                                <p>{{ $buyProduct[$product->id]['canMessage'] }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
                @endif
            </div>

                <div class="main__cart__checkout">
                     <div class="main__cart__checkout--box">

                    <div class="main__cart__checkout--box__subTotal">
                        <span>قیمت کالاها ({{ count($products ?? []) }})</span>
                        <span class="rial">{{ $TotalPrice }} تومان</span>
                    </div>
                    <div class="main__cart__checkout--box__subTrans">
                        <span>هزینه ارسال</span>
                        <span class="rial">{{ $TransportationCost }} تومان</span>
                    </div>
                    <div class="main__cart__checkout--box__PayTotal">
                        <span>جمع سبد خرید</span>
                        <span class="rial">{{ $PayPrice }} تومان</span>
                    </div>
                    <div class="main__cart__checkout--box__Discount">
                        <span>سود شما از خرید</span>
                        <div>
                            <span>{{ intval($AllDiscount / $TotalPrice * 100) }} %</span>
                            <span class="rial">{{ $AllDiscount }} تومان</span>
                        </div>
                    </div>

                    <a wire:click="goBuy" class="main__cart__checkout--box_btn">ادامه</a>
                </div>
                 </div>
        @else
            <div class="Content">
                <h1 class="w-300">سبد خرید شما خالی میباشد !</h1>
                <a href="{{ route('products') }}">فروشگاه</a>
            </div>
        @endif

        </div>
        @endif
        @if($Buy)
            <h1>سبد خرید <span>{{ count($products ?? []) }}</span></h1>
            <div class="main__cart">

                <div class="main__cart__details">
                        <div class="top">
                            <div>
                                <p>استان</p>
                                <input wire:model.defer="state" type="text" autofocus>
                                @error('state')
                                    <span class="box_danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <p>کد پستی</p>
                                <input wire:model.defer="zipCode" type="text">
                                @error('zipCode')
                                <span class="box_danger left">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <p>آدرس</p>
                        <textarea wire:model.defer="address" cols="30" rows="10"></textarea>
                        @error('address')
                             <span class="box_danger bottom">{{ $message }}</span>
                        @enderror
                </div>

                <div class="main__cart__checkout">
                    <div class="main__cart__checkout--box">

                        <div class="main__cart__checkout--box__subTotal">
                            <span>قیمت کالاها ({{ count($products ?? []) }})</span>
                            <span>{{ $TotalPrice }} تومان</span>
                        </div>
                        <div class="main__cart__checkout--box__subTrans">
                            <span>هزینه ارسال</span>
                            <span>{{ $TransportationCost }} تومان</span>
                        </div>
                        <div class="main__cart__checkout--box__PayTotal">
                            <span>جمع سبد خرید</span>
                            <span>{{ $PayPrice }} تومان</span>
                        </div>
                        <div class="main__cart__checkout--box__Discount">
                            <span>سود شما از خرید</span>
                            <div>
                                <span>{{ intval($AllDiscount / $TotalPrice * 100) }} %</span>
                                <span>{{ $AllDiscount }} تومان</span>
                            </div>
                        </div>

                        <a wire:click="getBuy" class="main__cart__checkout--box_btn">پرداخت</a>
                    </div>
                </div>
            </div>
        @endif
    </article>
    @error('count')
    <script>
        Swal.fire({
            icon: 'error',
            text: "حداکثر تعداد قابل سفارش میباشد",
        })
    </script>
    @enderror

    @error('emptyInputState')
    <script>
        Swal.fire({
            icon: 'error',
            text: "وارد کردن استان اجباری میباشد !",
        })
    </script>
    @enderror

    @error('emptyInputZipCode')
    <script>
        Swal.fire({
            icon: 'error',
            text: "وارد کردن کد پستی اجباری میباشد !",
        })
    </script>
    @enderror

    @error('emptyInputAddress')
    <script>
        Swal.fire({
            icon: 'error',
            text: "وارد کردن آدرس اجباری میباشد !",
        })
    </script>
    @enderror

    @error('notCan')
    <script>
        Swal.fire({
            icon: 'error',
            text: {{ $message }},
        })
    </script>
    @enderror

</div>
