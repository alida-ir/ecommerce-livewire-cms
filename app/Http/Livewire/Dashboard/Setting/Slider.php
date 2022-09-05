<?php

namespace App\Http\Livewire\Dashboard\Setting;

use App\Models\Photo;
use App\Models\Setting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Slider extends Component
{
    use AuthorizesRequests , WithFileUploads;

    public $checkbox;
    public $photo;
    public $Link;
    public $sliders;

    public $message = false;

    protected $listeners = ['okSave'];

    public function okSave()
    {
        $this->message = !$this->message;
    }

    public function mount()
    {
        $setting = Setting::class;
        $this->checkbox = boolval($setting::where('title' , 'showSlider')->first()->value);

        $this->sliders = $setting::where('title' , 'slider')->with('photos')->get();

    }

    public function addToSlider()
    {
        $this->authorize('update' , Setting::class);

        $setting = Setting::class;

        $this->validate([
            'photo' => 'required' ,
            'Link' => 'required' ,
        ]);

        $ext = $this->photo->getClientOriginalExtension();
        $oldName = pathinfo($this->photo->getClientOriginalName() , PATHINFO_FILENAME);
        $newName = $oldName . now()->microsecond . "." .$ext;
        $upload = $this->photo->storeAs("image/slider" , $newName , 'public_html');

        $slider = $setting::create([
            'title' => 'slider' ,
            'value' => $this->Link
        ]);


        $getWidthHeight = explode(" " , getimagesize($upload)[3]);
        $height  = trim(explode('=' , $getWidthHeight[1])[1] , '"') ;
        $width = trim(explode("=" , $getWidthHeight[0])[1]  , '"');
        $size = $this->photo->getSize();
        $mime = $this->photo->getMimeType();
        Photo::create([
            "name" => $newName ,
            "title" => 'slider',
            "description" => 'slider' ,
            "setting_id" => $slider['id'] ,
            "path" => asset($upload) ,
            "size" => $size ,
            "mime" => $mime ,
            "width" => $width ,
            "height" => $height ,
        ]);
        $this->message = true;
        return $this->redirect(route('setting.slider'));

    }

    public function deleteSlider($link)
    {
        $this->authorize('update' , Setting::class);
        $setting = Setting::class;
        $slider = $setting::where('value' , $link)->first();
        Storage::disk('public_html')->delete('image/slider/' . $slider->photos[0]->name);
        $slider->photos()->delete();
        $slider->delete();
        $this->message = true;
        return $this->redirect(route('setting.slider'));
    }


    public function updatedCheckbox()
    {
        $setting = Setting::class;
        $show = $setting::where('title' , 'showSlider')->first();
        $show->value = $this->checkbox;
        $show->save();
        $this->message = true;
    }

    public function render()
    {
        $this->authorize('viewAny' , Setting::class);
        return view('livewire.dashboard.setting.slider')->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'setting.index' , 'title' => 'تنظیمات'] ,
                ['name' => 'setting.banner' , 'title' => 'بنر ها'] ,
            ]]
        );
    }
}
