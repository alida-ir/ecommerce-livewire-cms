<div>
    <div class="fluid">
        <div class="main__search">
            @if($Empty)
                <div class="main__search--type mb-2">
                    <h1>عبارتی برای جستجو وارد نشده است !</h1>
                    <span><a href="{{ route('products') }}">فروشگاه</a></span>
                </div>
            @else

            <div class="main__search--type">
                <h1>عبارت جستجو شده : </h1>
                <span>{{ $query }}</span>
            </div>

            <div class="main__search--result">
                    @if(! $data->isEmpty())

                        <div class="main__search--result__child">
                            @foreach($data as $post)
                                <div class="main__search--resul__post">
                                    <div class="item">
                                        <div class="content">
                                            <a href="{{ route('product.item' , $post['slug']) }}" class="item">
                                                <img src="{{$post['firstPhotos']['path']}}" alt="{{ $post['name'] }}">
                                            </a>
                                        </div>
                                        <div class="bottom">
                                            <h4 class="limit-text_1"><a href="{{ route('product.item' , $post['slug']) }}">{{ $post['name'] }}</a></h4>
                                            @if(!$post->activeWarehouses->isEmpty())
                                                <p class="text-left price rial @if($discount != null && array_key_exists($post['id'] , $discount)) discount @endif">{{ $post['price'] }} <span>تومن</span></p>
                                                 @if($discount != null &&  array_key_exists($post['id'] , $discount))
                                                    <span class="discount_count">% {{ $discount[$post['id']]['quantity'] }}</span>
                                                    <p class="text-left price new rial">{{ $post['price'] - $post['price'] / 100 * $discount[$post['id']]['quantity']  }} <span>تومن</span></p>
                                                @endif
                                            @else
                                                <p>موجود نیست !</p>
                                            @endif
                                            <div class="add_to_cart">
                                                <a href="{{ route('product.item' , $post['slug']) }}">جزئیات بیشتر</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $data->links() }}
                    @else
                        <h2>محصولی موجود نیست !</h2>
                    @endif
            </div>

            @endif
        </div>
    </div>
</div>
