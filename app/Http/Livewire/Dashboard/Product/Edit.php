<?php

namespace App\Http\Livewire\Dashboard\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use AuthorizesRequests , WithFileUploads;
    public Product $product;
    public $images = [];
    public $categories;
    public $brand;

    protected $rules = [
        'product.name' => 'required|min:8|string' ,
        'product.price' => 'required' ,
        'product.content' => 'required' ,
        'product.keywords' => 'required' ,
        'product.description' => 'required' ,
        'categories' => 'nullable|exists:categories,id' ,
        'brand' => 'required|exists:brands,id' ,
        'images' => 'nullable'
    ];

    public function mount()
    {
        $this->product = Product::findOrFail(request()->id)->with(['categories' , 'photos'])->first();
//        $this->product->load(['categories' , 'photos']);
        $this->brand = $this->product->brand_id;
    }

    public function edit()
    {
//        dd($this->product->categories , $this->categories , $this->brand , $this->product->brand_id);
        $this->authorize('update' , [Product::class , auth()->user()]);

        $this->validate();
        $this->validate([
            'product.name' => [ Rule::unique('products' , 'name')->ignore($this->product->id)]
        ]);
//        dd($this->product);
        $this->product->brand_id = $this->brand;
        if ($this->categories != null){
            $this->product->categories()->detach();
            $this->product->categories()->attach($this->categories);
        }
        $this->product->save();
        Session::flash('success' , ['محصول با موفقیت ایجاد شد !']);
        return $this->redirect(route('product.index'));
    }

    public function deletePhoto(Photo $photo)
    {
        $this->authorize('delete' , [$this->product]);
        Storage::disk('public_html')->delete('image/product/' . $photo->name) ;
        $photo->delete();
        $this->redirect(route('product.edit' , $this->product->id));
    }

    public function upload()
    {
        $this->authorize('update' , [$this->product]);
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
            Photo::create([
                "name" => $newName ,
                "title" => $newName,
                "description" => null ,
                "category_id" => null ,
                "parent_id" => null ,
                "brand_id" => null ,
                "product_id" => $this->product->id ,
                "path" => $upload_url ,
                "size" => $size ,
                "mime" => $mime ,
                "width" => $width ,
                "height" => $height ,
            ]);
            $this->addError('file-upload' , 'فایل ها بدرستی آپلود و ذخیره شده شد !');
        }
        $this->redirect(route('product.edit' , $this->product->id));
    }

    public function render()
    {
        $this->authorize('update' , [$this->product]);
        $categories_item = Category::all();
        $brands = Brand::all();
        return view('livewire.dashboard.product.edit' , compact('brands' , 'categories_item'))
            ->layout('layouts.dashboard'
                , ['breads' => [
                    ['name' => 'product.index' , 'title' => 'محصولات'] ,
                    ['name' => 'product.edit' , 'title' => 'ویرایش محصول' , 'params' => $this->product->id] ,
                ]]
            );
    }
}

