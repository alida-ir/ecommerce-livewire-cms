<?php

namespace App\Http\Livewire\Dashboard\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use AuthorizesRequests , WithFileUploads;
    public Product $product;
    public $images = [];
    public $images_name = [];
    public $categories;
    public $brand;

    protected $rules = [
        'product.name' => 'required|min:8|string|unique:products,name' ,
        'product.price' => 'required' ,
        'product.content' => 'required' ,
        'product.keywords' => 'required' ,
        'product.description' => 'required' ,
        'categories' => 'required|exists:categories,id' ,
        'brand' => 'required|exists:brands,id' ,
        'images' => 'required'
    ];
    public function mount()
    {
        $this->product = new Product;
    }
    public function create()
    {
        $this->authorize('create' , [Product::class , auth()->user()]);
        $this->validate();
        $this->product->brand_id = $this->brand;
        $this->product->user_id = auth()->id();
        $this->product->save();
        foreach ($this->categories as $category) {
            $this->product->categories()->attach($category);
        }
        $photos = [];
        foreach ($this->images_name as $key => $item) {
            $photos[] = Photo::create([
                "name" => $item['name'] ,
                "title" => $item['name'],
                "description" => null ,
                "category_id" => null ,
                "parent_id" => null ,
                "brand_id" => null ,
                "product_id" => $this->product->id ,
                "path" => $item['path'] ,
                "size" => $item['size'] ,
                "mime" => $item['mime'] ,
                "width" => $item['width'] ,
                "height" => $item['height'] ,
            ]);
        }
        Session::flash('success' , ['محصول با موفقیت ایجاد شد !']);
        return $this->redirect(route('product.index'));
    }
    public function upload()
    {
        $this->authorize('create' , [Product::class , auth()->user()]);

        $this->validate([
            'images' => 'required' ,
            'images.*' => 'image|max:1024'
        ]);
        foreach ($this->images as $key => $image){
            $size = $image->getSize();
            $mime = $image->getMimeType();
            $ext = $image->getClientOriginalExtension();
            $oldName = pathinfo($image->getClientOriginalName() , PATHINFO_FILENAME);
            $newName = $oldName . now()->microsecond . "_" . "." .$ext;
            $upload = $image->storeAs("image/product" , $newName , 'public_html');
            Storage::delete('/tmp/'. $image);
            $upload_url = asset( $upload);
            $getWidthHeight = explode(" " , getimagesize($upload)[3]);
            $height  = trim(explode('=' , $getWidthHeight[1])[1] , '"') ;
            $width = trim(explode("=" , $getWidthHeight[0])[1]  , '"');
            $this->images_name[$key] = [
                "name" => $newName ,
                 "path" => $upload_url ,
                "size" => $size ,
                "mime" => $mime ,
                "width" => $width ,
                "height" => $height ,
            ];
            $this->addError('file-upload' , 'فایل ها بدرستی آپلود شد !');
        }

    }
    public function render()
    {
        $this->authorize('create' , [Product::class , auth()->user()]);
        $categories_item = Category::all();
        $brands = Brand::all();
        return view('livewire.dashboard.product.create' , compact('categories_item' , 'brands'))
            ->layout('layouts.dashboard'
                , ['breads' => [
                    ['name' => 'users.index' , 'title' => 'همه محصولات'] ,
                    ['name' => 'product.create' , 'title' => 'ایجاد محصول' ] ,
                ]]
            );
    }
}
