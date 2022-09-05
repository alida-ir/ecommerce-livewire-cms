<?php

namespace App\Http\Livewire\Dashboard\Category;

use App\Models\Category;
use App\Models\Permission;
use App\Models\Photo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use AuthorizesRequests , WithFileUploads;
    public Category $category;
    public $photo ;
    protected $rules = [
        'category.title' => 'required|string|min:4',
        'category.label' => 'required|string|min:4',
        'category.status' => 'nullable' ,
        'category.parent_id' => 'nullable|exists:categories,id' ,
        'photo' => 'required' ,
    ];
    public function mount()
    {
        $this->category = new Category();
    }

    public function create()
    {
        $this->authorize('create' , [Category::class , auth()->user()]);
        $this->validate();
        $this->validate([
            "category.name" => [ Rule::unique('categories' , 'name')] ,
            "category.title" => [ Rule::unique('categories' , 'title')] ,
        ]);
        if ($this->category->status == null){
            $this->category->status = false;
        }
        $this->category->save();
        $image = $this->photo ;
        $size = $image->getSize();
        $mime = $image->getMimeType();
        $ext = $image->getClientOriginalExtension();
        $oldName = pathinfo($image->getClientOriginalName() , PATHINFO_FILENAME);
        $newName = $oldName . now()->microsecond . "_" . "." .$ext;
        $upload = $image->storeAs("image/category" , $newName , 'public_html');
        Storage::delete('/tmp/'. $image);
        $upload_url = asset( $upload);
        $getWidthHeight = explode(" " , getimagesize($upload)[3]);
        $height  = trim(explode('=' , $getWidthHeight[1])[1] , '"') ;
        $width = trim(explode("=" , $getWidthHeight[0])[1]  , '"');
        Photo::create([
            "name" => $newName ,
            "title" => $this->category->title,
            "description" => $this->category->title ,
            "category_id" => $this->category->id ,
            "parent_id" => null ,
            "brand_id" => null ,
            "product_id" => null ,
            "path" => $upload_url ,
            "size" => $size ,
            "mime" => $mime ,
            "width" => $width ,
            "height" => $height ,
        ]);
        Session::flash('success' , ['دسته بندی با موفقت ایجاد شد !']);
        return $this->redirect(route('category.index'));
    }

    public function render()
    {
        $this->authorize('create' , [Category::class , auth()->user()]);
        $categories = Category::all();
        return view('livewire.dashboard.category.create' , compact('categories'))->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'category.index' , 'title' => 'دسته بندی ها'] ,
                ['name' => 'category.create' , 'title' => 'ایجاد دسته بندی' ] ,
            ]]
        );
    }
}
