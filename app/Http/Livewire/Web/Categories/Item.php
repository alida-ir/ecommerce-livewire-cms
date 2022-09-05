<?php

namespace App\Http\Livewire\Web\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Item extends Component
{
    use WithPagination;
    protected $paginationTheme = "home-paginate";

    public $slug ;
    public  $products ;
    public $category ;
    public  $discount;

    public function mount()
    {
        $this->category = Category::where('slug' , request()->slug)->with(['products' , 'products.photos'  , 'products.activeDiscount'  , 'products.activeWarehouses'  , 'products.categories' , 'products.categories.activeDiscount' ])->first() ;
        $this->slug = request()->slug;
        if ($this->category->products) {
            foreach ($this->category->products as $item) {
//                $item->load(['photos' , 'activeDiscount'  , 'activeWarehouses', 'categories']);
                foreach ($item->categories as $category) {
//                    $category->load(['activeDiscount']);
                    if (!$item->activeDiscount->isEmpty()){
                        $this->discount[$item['id']] = $item->activeDiscount->first();
                    }
                    if (!$category->activeDiscount->isEmpty()){
                        $this->discount[$item['id']] = $category->activeDiscount->first();
                    }
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.web.categories.item' , [
            'data' => Category::where('slug' , $this->slug)->first()->products()->with(['photos' , 'activeDiscount', 'activeWarehouses'])->paginate(8)
        ])->layout('layouts.home' , [
            'title' => 'دسته بندی ها' ,
            'script' => 'category.js' ,
            'style' => 'category.css' ,
        ]);
    }
}
