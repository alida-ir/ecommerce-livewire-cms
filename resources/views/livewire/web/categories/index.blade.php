<div class="fluid">
    <div class="box_category">
        @if($data)
            <div class="box_children">
                @foreach($data as $category)
                    <div class="item_category">
                        <a href="{{ route('categories.item' , $category->slug) }}">
                            <img src="{{ $category->photo->path }}" alt="{{ $category->photo->title }}">
                        </a>
                    </div>
                @endforeach
            </div>
            {{ $data->links() }}
        @else
            <h1>دسته بندی وجود ندارد !</h1>
        @endif
    </div>
</div>
