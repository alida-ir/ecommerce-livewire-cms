<div class="fluid">

    @if(!$this->product->categories->isEmpty())
        <div class="main__breadcrumbs">
            @foreach($this->product->categories as $key => $category)
                <a href="{{ route('search' , [ 'q' => $category->label]) }}" class="main__breadcrumbs--item">{{ $category->label }}</a>
                @if(($key + 1) != count($this->product->categories))
                    <img src="{{ asset('assets/web/image/slash.svg') }}" alt="">
                @endif
            @endforeach
        </div>
    @endif

    <div class="main__BuyGallery">
        <div class="main__gallery">
            @foreach($product->photos as $key =>$photo)
                <div class="main__gallery--image @if($key == 0) active @endif">
                    <img src="{{ $photo->path }}" alt="{{ $product->name }}">
                </div>
            @endforeach
        </div>
        <div class="main__buy">
            <div class="main__buy--breadcrumbs">
                <a href="{{ route('search' , ['q' => $product->brand->label]) }}"> {{$product->brand->label}} </a>
                <img src="{{ asset('assets/web/image/slash.svg') }}" alt="">
                <a href="{{ route('search' , ['q' => $product->name]) }}">{{ $product->name }}</a>
            </div>

            <div class="main__buy--title">
                <h1>{{ $product->name }}</h1>
            </div>

            @if($color)
                <div class="main__buy--color">
                    <p>رنگ : {{ $colorSelect['color'] }}</p>
                    <div class="main__buy--color__child">
                        @foreach($color as $key => $item)
                            <div class="main__buy--color__select @if($colorSelect['id'] == $item['id']) active @endif" wire:click="changeColor('{{ $item['color'] }}')" style="background: {{ $item['hex'] }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($size != null)
            <div class="main__buy--size">
                <p>سایز : {{ $sizeSelect }}</p>
                <div class="main__buy--size__child" wire:init>
                    <select wire:model="sizeSelect">
                        @if($ColorSize != null)
                        @foreach($ColorSize as $item)
                            <option value="{{ $item['size'] }}">{{ $item['size'] }}</option>
                        @endforeach
                        @endif
                    </select>

                </div>
            </div>
            @endif

            @if($notAvailable)
                <p>موجود نیست !</p>
            @else
            <div class="main__buy--price">
                <h2 class="@if($discount != null) discount @endif rial">{{ $price }}</h2>
                @if($discount != null)
                    <h3 class="new_price rial">{{ $price - $price / 100 * $discount->quantity }} تومان</h3>
                    <div class="discount_count">{{ $discount->quantity }} %</div>
                @endif
                <button wire:click="addToCart" type="submit">{{ $label }}</button>
            </div>
            @endif

        </div>
    </div>

    <div class="main__caption">
        <h3>توضیحات</h3>
        <div>
            {!! $product->content !!}
        </div>
    </div>

    @if(count($SimilarProduct) >= 7)
        <div class="main__SimilarProduct">
        <h3>محصولات مشابه</h3>
        <div class="main--slider owl-carousel owl-theme">
            @foreach($SimilarProduct as $product)
                @if(!$product->activeWarehouses->isEmpty())
                    <a href="{{ route('product.item' , $product['slug']) }}" class="item">
                        <div class="content"><img src="{{ $product['photos'][0]['path'] }}" alt=""></div>
                        <div class="bottom">
                            <h4 class="limit-text_1">{{ $product['name'] }}</h4>
                            <p class="text-left price rial
                            @if($SimilarProductDiscount != null &&  array_key_exists($product['id'] , $SimilarProductDiscount))discount @endif">{{ $product['price'] }} <span>تومن</span></p>
                            @if($SimilarProductDiscount != null &&  array_key_exists($product['id'] , $SimilarProductDiscount))
                                <span class="discount_count">% {{ $SimilarProductDiscount[$product['id']]['quantity'] }}</span>
                                <p class="text-left price new">{{ $product['price'] - $product['price'] / 100 * $SimilarProductDiscount[$product['id']]['quantity']  }} <span>تومن</span></p>
                            @endif
                        </div>
                    </a>
                @endif
            @endforeach
        </div>

        </div>
    @endif
</div>
