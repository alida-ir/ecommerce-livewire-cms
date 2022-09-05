<?php

namespace App\Http\Livewire\Dashboard\Setting;

use App\Models\Category;
use App\Models\Setting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads , AuthorizesRequests;
    public $shopping_name ;
    public $shopping_title ;
    public $logo ;
    public $favicon ;
    public $faviconUrl ;
    public $shopping_address ;
    public $shopping_email ;
    public $shopping_number ;
    public $shopping_telegram ;
    public $shopping_instagram ;
    public $shopping_twitter ;
    public $logoUrl ;
    public $showLastProduct ;
    public $categories;
    public $itemCategory;
    public $message = false;

    protected $listeners = ['okSave'];

    public function okSave()
    {
        $this->message = !$this->message;
    }

    protected $rules = [
        'shopping_name.value' => 'required' ,
        'shopping_title.value' => 'required' ,
        'logo' => 'nullable' ,
        'favicon' => 'nullable' ,
        'shopping_address.value' => 'required' ,
        'shopping_email.value' => 'required' ,
        'shopping_number.value' => 'required' ,
        'shopping_telegram.value' => 'required' ,
        'shopping_instagram.value' => 'required' ,
        'shopping_twitter.value' => 'required' ,
    ];

    public function updatedLogo()
    {
        $file = $this->logo;
        $setting = new Setting;
        $logo = $setting->where('title' , 'logo')->first();

        $upload = $file->storeAs("image/logo" , 'logo_' . microtime() . "."  . $file->getClientOriginalExtension() , 'public_html');
        $logo->value = asset($upload);
        $logo->save();
    }

    public function updatedFavicon()
    {
        $file = $this->favicon;
        $setting = new Setting;
        $logo = $setting->where('title' , 'favicon')->first();

        $upload = $file->storeAs("image/logo" , 'favicon_' . microtime() . "."  . $file->getClientOriginalExtension() , 'public_html');
        $logo->value = asset($upload);
        $logo->save();
    }

    public function mount()
    {
        $setting = new Setting;
        $this->shopping_name = $setting->where('title' , 'name')->first();
        $this->shopping_title = $setting->where('title' , 'title')->first();
        $this->shopping_address = $setting->where('title' , 'address')->first();
        $this->shopping_number = $setting->where('title' , 'number')->first();
        $this->shopping_email = $setting->where('title' , 'email')->first();
        $this->shopping_telegram = $setting->where('title' , 'telegram')->first();
        $this->shopping_instagram = $setting->where('title' , 'instagram')->first();
        $this->shopping_twitter = $setting->where('title' , 'twitter')->first();
        $logo = $setting->where('title' , 'logo')->first();
        $favicon = $setting->where('title' , 'favicon')->first();

        if ($logo->value){
            $this->logoUrl = $logo->value ;
        }
        if ($favicon->value){
            $this->faviconUrl = $favicon->value ;
        }

        $this->showLastProduct = boolval($setting::where('title' , 'showLastProduct')->first()->value);
        $categoryProduct = Category::with('products')->get();
        foreach ($categoryProduct as $key => $item) {
            if (count($item->products) >= 7 || $key == 0) {
                $this->categories[] = $item;
                $this->itemCategory = $setting::where('title', 'categoryFirstPage')->pluck('value');
            }
        }
    }


    public function updatedItemCategory()
    {
        $this->authorize('update' , Setting::class);
        $setting = Setting::class;
        $menu = $setting::where('title' , 'categoryFirstPage')->delete();
        foreach ($this->itemCategory as $item) {
            $setting::create([
                'title' => 'categoryFirstPage' ,
                'value' => $item
            ]);
        }
        $this->message = true;
        Session::flash('success' , ['تنظیمات با موفقیت ویرایش شد !']);
    }

    public function updatedShowLastProduct()
    {
        $setting = Setting::class;
        $show = $setting::where('title' , 'showLastProduct')->first();
        $show->value = $this->showLastProduct ;
        $show->save();
        $this->message = true;
        Session::flash('success' , ['تنظیمات با موفقیت ویرایش شد !']);
    }

    public function setting()
    {
        $this->authorize('update' , Setting::class);
        $this->validate();
        $this->shopping_name->save();
        $this->shopping_title->save();
        $this->shopping_address->save();
        $this->shopping_number->save();
        $this->shopping_email->save();
        $this->shopping_telegram->save();
        $this->shopping_instagram->save();
        $this->shopping_twitter->save();
        $this->message = true;
        Session::flash('success' , ['تنظیمات با موفقیت ویرایش شد !']);
    }

    public function render()
    {
        $this->authorize('viewAny' , Setting::class);
        return view('livewire.dashboard.setting.index')->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'setting.index' , 'title' => 'تنظیمات'] ,
             ]]
        );
    }
}
