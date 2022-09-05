<div class="fluid">
    @if($show)
        <div class="main__slider">
        <div class="main__slider--div owl-carousel">
            @foreach($sliders as $key => $title)
                <div>
                    <a href="{{ $title->value }}">
                        <img class="main__slider--div__img" src="{{ $title->firstPhotos->path }}" alt="">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @endif
    <div class="main__content">
        <aside>
            <!-- Start Show Post Ticker -->
            <div class="ticker-post text-center">

                <p class="ticker-title">پیشنهاد لحظه ای</p>
                <hr class="article__box--hr">
                <!-- Start Code Ticker -->
                <div id="ticker">
                    <ul>
                        @foreach($tickerProduct as $product)
                            <li>
                                <a href="{{ route('product.item' , $product->slug) }}">
                                    <div class="ticker-org">
                                        <img src="{{ $product->firstPhotos->path }}" alt="">
                                        <div>
                                            <h4 class="limit-text_1">{{ $product->name }}</h4>
                                            <p class="text-left price @if($tickerDiscount != null && array_key_exists($product->id , $tickerDiscount)) discount @endif">
                                                <span class="rial">{{ $product->price }}</span> <span>تومن</span></p>
                                            @if($tickerDiscount != null &&  array_key_exists($product->id , $tickerDiscount))
                                                <span class="discount_count">{{ $tickerDiscount[$product->id]['quantity'] }} %</span>
                                                <p class="text-left price new rial">{{ $product->price - $product->price / 100 * $tickerDiscount[$product->id]['quantity']  }}<span>تومن</span></p>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- End Code Ticker -->

                <!-- End Show Post Ticker -->
            </div>
            <!-- End Show Post Ticker -->

            @if($showOneBanner)
            <div class="main__content--banner__one">
                <a href="{{ $oneBanner->value }}" target="_blank" nofollow>
                    <img src="{{ $oneBanner->firstPhotos->path  }}" alt="">
                </a>
            </div>
            @endif

            @if($showLastProduct)
            <div class="main__content--last__product">
                <h4>آخرین محصولات سایت </h4>
                <hr>
                <div class="main__content--last__product--box">
                    @foreach($lastProduct as $product)
                        <div class="items">
                            <a href="{{ route('product.item' , $product->slug) }}">
                                <img src="{{ $product->firstPhotos->path }}" alt="">
                                <h5 class="limit-text_2">{{ $product->name }}</h5>
                            </a>
                        </div>
                    @endforeach
                </div>

            </div>
        @endif

        @if($showTwoBanner)
                <div class="main__content--banner__one">
                    <a href="{{ $twoBanner->value }}" target="_blank" nofollow>
                        <img src="{{ $twoBanner->firstPhotos->path  }}" alt="">
                    </a>
                </div>
        @endif

        </aside>
        <article>
            <div class="article__box">
                @if($categories)
                    @foreach($categories as $category)
                        <div class="article__box--div">
                            <a href="#">{{ $category->label }}</a>
                            <hr class="article__box--hr">
                            <div class="main--slider owl-carousel owl-theme">
                                @foreach($category->products as $product)
                                    @if(!$product->activeWarehouses->isEmpty())
                                    <a href="{{ route('product.item' , $product->slug) }}" class="item">
                                        <div class="content"><img src="{{ $product->firstPhotos->path }}" alt=""></div>
                                        <div class="bottom">
                                            <h4 class="limit-text_1">{{ $product->name }}</h4>
                                                <p class="text-left price rial
                                                 @if($discount != null &&  array_key_exists($category->id , $discount))
                                                    @if(array_key_exists($product->id , $discount[$category->id]))
                                                    discount
                                                    @endif
                                                 @endif
                                                ">{{ $product->price }} <span>تومن</span></p>
                                                @if($discount != null &&  array_key_exists($category->id , $discount))
                                                    @if(array_key_exists($product->id , $discount[$category->id]))
                                                        <span class="discount_count">% {{ $discount[$category->id][$product->id]['quantity'] }}</span>
                                                        <p class="text-left price new rial">{{ $product->price - $product->price / 100 * $discount[$category->id][$product->id]['quantity']  }}  <span>تومن</span></p>
                                                    @endif
                                                @endif
                                        </div>
                                    </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @else
                    <h3>محصولی برای نمایش موجود نیست !</h3>
                @endif
            </div>
        </article>
    </div>
</div>
