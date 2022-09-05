<div>
    <div class="fluid">
        <div class="main__allPosts">
            @foreach($products as $product)
                <div class="main__allPosts--posts">
                    <div class="item">
                        <div class="content">
                            <a href="{{ route('product.item' , $product->slug) }}" class="item">
                                <img src="{{$product->photos[0]->path}}" alt="{{ $product->name }}">
                            </a>
                        </div>
                        <div class="bottom">
                            <h4 class="limit-text_1"><a href="{{ route('product.item' , $product->slug) }}">{{ $product->name }}</a></h4>
                            @if(!$product->activeWarehouses->isEmpty())
                                <p class="text-left price rial @if($discount != null && array_key_exists($product->id , $discount)) discount @endif"><spav class="rial">{{ $product->price }}</spav> <span>تومن</span></p>
                                @if($discount != null &&  array_key_exists($product->id , $discount))
                                    <span class="discount_count">% {{ $discount[$product->id]['quantity'] }}</span>
                                    <p class="text-left price new rial">{{ $product->price - $product->price / 100 * $discount[$product->id]['quantity']  }} <span>تومن</span></p>
                                @endif
                            @else
                                <p>موجود نیست !</p>
                            @endif

                            <div class="add_to_cart">
                                <a href="{{ route('product.item' , $product->slug) }}">جزئیات بیشتر</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $products->links() }}
    </div>
</div>
