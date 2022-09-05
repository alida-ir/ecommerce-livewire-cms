<?php

namespace App\Http\Livewire\Dashboard\Category;

use App\Models\Category;
use App\Models\Photo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use AuthorizesRequests , WithFileUploads;
    public Category $category;
    public $photo ;

    protected $rules = [
        'category.title' => 'required|string|min:4',
        'category.label' => 'required|string|min:4',
        'category.status' => 'nullable' ,
        'category.parent_id' => 'nullable' ,
        'photo' => 'nullable' ,
    ];

    public function mount()
    {
        $this->category = Category::findOrFail(request()->id);
        $this->photo = $this->category->photo ;
    }

    public function edit()
    {
        $this->authorize('update' , [Category::class , auth()->user()]);

        $this->validate();
        $this->validate([
            'category.title' => [ Rule::unique('categories' , 'title')->ignore($this->category->id)],
            'category.label' => [ Rule::unique('categories' , 'label')->ignore($this->category->id)],
        ]);
        if ($this->category->parent_id == 'null'){
            $this->category->parent_id = null;
        }
        if ($this->photo instanceof TemporaryUploadedFile){
            $image = $this->photo ;
            $size = $image->getSize();
            $mime = $image->getMimeType();
            $ext = $image->getClientOriginalExtension();
            $oldName = pathinfo($image->getClientOriginalName() , PATHINFO_FILENAME);
            $newName = $oldName . now()->microsecond . "_" . "." .$ext;
            $upload = $image->storeAs("image/category" , $newName , 'public_html');
            Storage::delete('/tmp/'. $image);
            if ($this->category->photo != null){
                Storage::disk('public_html')->delete('/image/category/'. $this->category->photo->name);
            }
            $this->category->photo()->delete();
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
        }
        $this->category->save();
        Session::flash('success' , ['ویرایش با موفقیت انجام شد !']);
        return $this->redirect(route('category.index'));
    }

    public function render()
    {
        $this->authorize('update' , [Category::class , auth()->user()]);
        $categories = Category::all();
        return view('livewire.dashboard.category.edit' , compact('categories'))->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'category.index' , 'title' => 'دسته بندی ها'] ,
                ['name' => 'category.edit' , 'title' => 'ویرایش دسته بندی' , 'params' => $this->category->id] ,
            ]]
        );
    }
}
