<div>
    @if(! $data->isEmpty())
        <div class="main__item">
            <div class="main__item--result">
                @foreach($data as $post)
                    <div class="main__item--resul__post">
                        <div class="item">
                            <div class="content">
                                <a href="{{ route('product.item' , $post->slug) }}" class="item">
                                    <img src="{{$post->photos[0]->path}}" alt="{{ $post->name }}">
                                </a>
                            </div>
                            <div class="bottom">
                                <h4 class="limit-text_1"><a href="{{ route('product.item' , $post->slug) }}">{{ $post->name }}</a></h4>
                                @if(!$post->activeWarehouses->isEmpty())
                                <p class="text-left price @if($discount != null && array_key_exists($post->id , $discount)) discount @endif">{{ $post->price }} <span>تومن</span></p>
                                    @if($discount != null &&  array_key_exists($post->id , $discount))
                                        <span class="discount_count">% {{ $discount[$post->id]['quantity'] }}</span>
                                        <p class="text-left price new">{{ $post->price - $post->price / 100 * $discount[$post->id]['quantity']  }} <span>تومن</span></p>
                                    @endif
                                @else
                                    <p>موجود نیست !</p>
                                @endif
                                <div class="add_to_cart">
                                    <a href="{{ route('product.item' , $post->slug) }}">جزئیات بیشتر</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $data->links() }}
        </div>
    @else
        <div class="fluid">
            <h1>محصولی موجود نیست !</h1>
        </div>
    @endif
</div>
