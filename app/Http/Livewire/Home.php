<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Home extends Component
{
    public $show;
    public $sliders;
    public $showOneBanner;
    public $showTwoBanner;
    public $oneBanner;
    public $twoBanner;
    public $showLastProduct;
    public $lastProduct;
    public $tickerProduct;
    public $tickerDiscount;
    public $categories;
    public $discount;
    public $setting;

    public function mount()
    {
        $setting = Setting::all();
        $this->setting = $setting;
        $setting->load(['firstPhotos']);
        $this->show = boolval($setting->where('title' , 'showSlider')->pluck('value')[0]);
        $this->showOneBanner = boolval($setting->where('title' , 'showOneBanner')->first()->value);
        $this->showTwoBanner = boolval($setting->where('title' , 'showTwoBanner')->first()->value);
        if ($this->showOneBanner){
            $this->oneBanner = $setting->where('title' , 'oneBanner')->first();
        }
        if ($this->showTwoBanner){
            $this->twoBanner = $setting->where('title' , 'twoBanner')->first();
        }
        $this->sliders = $setting->where('title' , 'slider')->all();
        $this->showLastProduct = boolval($setting->where('title' , 'showLastProduct')->first()->value);
        if ($this->showLastProduct){
            $this->lastProduct = Product::with('firstPhotos')->limit(7)->get();
        }
        $this->tickerProduct = Product::with(['firstPhotos' , 'activeWarehouses' , 'activeDiscount' , 'categories' , 'categories.activeDiscount'])
                                        ->whereRelation('activeWarehouses' , function (Builder $query) {})
                                        ->get()->random(3);
        if ($this->tickerProduct){
            foreach ($this->tickerProduct as $item) {
                foreach ($item->categories as $category) {
                    if (!$item->activeDiscount->isEmpty()){
                        $this->tickerDiscount[$item->id] = $item->activeDiscount->first();
                    }
                    if (!$category->activeDiscount->isEmpty()){
                        $this->tickerDiscount[$item->id] = $category->activeDiscount->first();
                    }
                }
            }
        }
        $categoryFirstPage = $setting->where('title' , 'categoryFirstPage')->pluck('value')->toArray();
        $caterories = Category::findMany($categoryFirstPage)->load(['products' ,'products.firstPhotos' ,'products.activeWarehouses' ,'products.activeDiscount' , 'activeDiscount'])->all();

        foreach ($caterories as $key => $item) {
            if ($key != 0){
                if (count($item->products) >= 7){
                    $this->categories[] = $item;
                    if ($item->products){
                        foreach ($item->products as $value) {
                            if (!$item->activeDiscount->isEmpty()){
                                $this->discount[$item->id][$value->id] = $item->activeDiscount->first();
                            }
                            elseif (!$value->activeDiscount->isEmpty()){
                                $this->discount[$item->id][$value->id] = $value->activeDiscount->first();
                            }
                        }
                    }
                }
            }else{
                $this->categories[] = $item;
                if ($item->products){
                    foreach ($item->products as $value) {
                        if (!$item->activeDiscount->isEmpty()){
                            $this->discount[$item->id][$value->id] = $item->activeDiscount->first();
                        }
                        elseif (!$value->activeDiscount->isEmpty()){
                            $this->discount[$item->id][$value->id] = $value->activeDiscount->first();
                        }
                    }
                }
            }
        }
    }

    public function render()
    {

        return view('livewire.home')->layout('layouts.home' ,
        [
            'script' => 'index.js' ,
            'title' => 'صفحه اصلی' ,
            'setting' => $this->setting ,
        ]);
    }
}
