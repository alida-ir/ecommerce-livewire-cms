<?php

namespace App\Http\Livewire\Dashboard\Setting;

use App\Models\Category;
use App\Models\Setting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Menu extends Component
{
    use AuthorizesRequests;
    public $itemMenu = [];
    public $categories;
    public $categoryOption = false;
    public $checkbox = false;
    public $inputTitle;
    public $inputLink;
    public $quickAccess;
    public $accessTitles = [];
    public $accessLinks = [];

    public $message = false;

    protected $listeners = ['okSave'];

    public function okSave()
    {
        $this->message = !$this->message;
    }


    public function mount()
    {
        $this->authorize('viewAny' , Setting::class);
        $setting = Setting::class;
        $this->categories = Category::all();
        $this->categoryOption = $setting::where('title' , 'AllCategoryInMenu')->first();
        $this->checkbox = boolval($this->categoryOption->value);
        $this->itemMenu = $setting::where('title' , 'menu')->pluck('value');
        $this->quickAccess = $setting::where('title' , 'like' , "%quickAccess%")->get();
        foreach ($this->quickAccess as $key => $item) {
            if (is_integer($key / 2)){
                $this->accessTitles[] = $item->value;
            }else{
                $this->accessLinks[] = $item->value;
            }
        }
    }

    public function deleteAccess($title , $link)
    {
        $this->authorize('update' , Setting::class);
        $setting = Setting::class;
        $setting::where('value' , $title)->delete();
        $setting::where('value' , $link)->delete();
        return $this->redirect(route('setting.menu'));
    }

    public function updatedCheckbox()
    {
        $this->authorize('update' , Setting::class);
        $this->categoryOption->value = $this->checkbox;
        $this->categoryOption->save();
        $this->message = true;
    }

    public function updatedItemMenu()
    {
        $this->authorize('update' , Setting::class);
        $setting = Setting::class;
        $menu = $setting::where('title' , 'menu')->delete();
        foreach ($this->itemMenu as $itemMenu) {
            $setting::create([
                'title' => 'menu' ,
                'value' => $itemMenu
            ]);
        }
        $this->message = true;
    }

    public function addToQuick()
    {
        $this->authorize('update' , Setting::class);

        $setting = Setting::class;

        $this->validate([
            'inputTitle' => 'required' ,
            'inputLink' => 'required' ,
        ]);

        $setting::create([
            'title' => 'quickAccess' ,
            'value' => $this->inputTitle
        ]);

        $setting::create([
            'title' => 'quickAccess' ,
            'value' => $this->inputLink
        ]);
        return $this->redirect(route('setting.menu'));

    }

    public function render()
    {
        $this->authorize('viewAny' , Setting::class);
        return view('livewire.dashboard.setting.menu')->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'setting.index' , 'title' => 'تنظیمات'] ,
                ['name' => 'setting.menu' , 'title' => 'منو ها'] ,
            ]]
        );
    }
}
