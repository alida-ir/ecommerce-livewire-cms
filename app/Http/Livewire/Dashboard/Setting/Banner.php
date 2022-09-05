<?php

namespace App\Http\Livewire\Dashboard\Setting;

use App\Models\Photo;
use App\Models\Setting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Banner extends Component
{
    use WithFileUploads , AuthorizesRequests;
    public $checkbox;
    public $checkbox2;
    public $oneBanner ;
    public $twoBanner ;
    public $oneBannerPhoto ;
    public $oneBannerNewPhoto ;
    public $oneBannerNewLink ;
    public $twoBannerPhoto ;
    public $twoBannerNewPhoto ;
    public $twoBannerNewLink ;

    public $message = false;

    protected $listeners = ['okSave'];

    public function okSave()
    {
        $this->message = !$this->message;
    }

    public function mount()
    {
        $setting = Setting::class;
        $this->checkbox = boolval($setting::where('title' , 'showOneBanner')->first()->value);
        $this->checkbox2 = boolval($setting::where('title' , 'showTwoBanner')->first()->value);
        $this->oneBanner = $setting::where('title' , 'oneBanner')->with('photos')->first();
        $this->twoBanner = $setting::where('title' , 'twoBanner')->with('photos')->get()->last();
        $this->oneBannerNewLink = $this->oneBanner->value;
        $this->twoBannerNewLink = $this->twoBanner->value;
        $this->oneBannerPhoto = $this->oneBanner->photos[0];
        $this->twoBannerPhoto = $this->twoBanner->photos[0];
    }


    public function updatedCheckbox()
    {
        $setting = Setting::class;
        $show = $setting::where('title' , 'showOneBanner')->first();
        $show->value = $this->checkbox;
        $show->save();
        $this->message = true;
    }
    public function updatedCheckbox2()
    {
        $setting = Setting::class;
        $show = $setting::where('title' , 'showTwoBanner')->first();
        $show->value = $this->checkbox2;
        $show->save();
        $this->message = true;
    }

    public function updatedOneBannerNewPhoto()
    {

        $this->authorize('update' , Setting::class);
        Storage::disk('public_html')->delete('image/banner/' . $this->oneBanner->photos[0]->name);
        $this->oneBanner->photos()->delete();


        $ext = $this->oneBannerNewPhoto->getClientOriginalExtension();
        $oldName = pathinfo($this->oneBannerNewPhoto->getClientOriginalName() , PATHINFO_FILENAME);
        $newName = $oldName . now()->microsecond . "." .$ext;
        $upload = $this->oneBannerNewPhoto->storeAs("image/banner" , $newName , 'public_html');
        $getWidthHeight = explode(" " , getimagesize($upload)[3]);
        $height  = trim(explode('=' , $getWidthHeight[1])[1] , '"') ;
        $width = trim(explode("=" , $getWidthHeight[0])[1]  , '"');
        $size = $this->oneBannerNewPhoto->getSize();
        $mime = $this->oneBannerNewPhoto->getMimeType();
        Photo::create([
            "name" => $newName ,
            "title" => 'slider',
            "description" => 'slider' ,
            "setting_id" => $this->oneBanner->id ,
            "path" => asset($upload) ,
            "size" => $size ,
            "mime" => $mime ,
            "width" => $width ,
            "height" => $height ,
        ]);
        $this->message = true;
        return $this->redirect(route('setting.banner'));
    }
    public function updatedOneBannerNewLink()
    {

        $this->authorize('update' , Setting::class);
        $this->oneBanner->value = $this->oneBannerNewLink;
        $this->oneBanner->save();
        $this->message = true;
    }

    public function updatedTwoBannerNewPhoto()
    {

        $this->authorize('update' , Setting::class);
        Storage::disk('public_html')->delete('image/banner/' . $this->twoBanner->photos[0]->name);
        $this->twoBanner->photos()->delete();


        $ext = $this->twoBannerNewPhoto->getClientOriginalExtension();
        $oldName = pathinfo($this->twoBannerNewPhoto->getClientOriginalName() , PATHINFO_FILENAME);
        $newName = $oldName . now()->microsecond . "." .$ext;
        $upload = $this->twoBannerNewPhoto->storeAs("image/banner" , $newName , 'public_html');
        $getWidthHeight = explode(" " , getimagesize($upload)[3]);
        $height  = trim(explode('=' , $getWidthHeight[1])[1] , '"') ;
        $width = trim(explode("=" , $getWidthHeight[0])[1]  , '"');
        $size = $this->twoBannerNewPhoto->getSize();
        $mime = $this->twoBannerNewPhoto->getMimeType();
        Photo::create([
            "name" => $newName ,
            "title" => 'slider',
            "description" => 'slider' ,
            "setting_id" => $this->twoBanner->id ,
            "path" => asset($upload) ,
            "size" => $size ,
            "mime" => $mime ,
            "width" => $width ,
            "height" => $height ,
        ]);
        $this->message = true;
        return $this->redirect(route('setting.banner'));
    }
    public function updatedTwoBannerNewLink()
    {

        $this->authorize('update' , Setting::class);
        $this->twoBanner->value = $this->twoBannerNewLink;
        $this->twoBanner->save();
        $this->message = true;
    }

    public function render()
    {
        return view('livewire.dashboard.setting.banner')->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'setting.index' , 'title' => 'تنظیمات'] ,
                ['name' => 'setting.banner' , 'title' => 'تبلیغات'] ,
            ]]
        );
    }
}
