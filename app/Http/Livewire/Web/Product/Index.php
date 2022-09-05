<?php

namespace App\Http\Livewire\Web\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination ;
    protected $paginationTheme = "home-paginate";
    public $discount ;

    public function mount()
    {
        $post = Product::with(['photos' , 'activeDiscount' , 'activeWarehouses' , 'categories' , 'categories.activeDiscount'])->get();
        if ($post) {
            foreach ($post as $item) {
                foreach ($item->categories as $category) {
                    if (!$item->activeDiscount->isEmpty()){
                        $this->discount[$item->id] = $item->activeDiscount->first();
                    }
                    if (!$category->activeDiscount->isEmpty()){
                        $this->discount[$item->id] = $category->activeDiscount->first();
                    }
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.web.product.index' , [
            'products' => Product::with(['photos' , 'activeWarehouses'])->orderBy('id' , 'desc')->paginate(12)
        ])->layout('layouts.home' ,
             ['style' => 'products.css' ,
                 'script' => 'products.js'
                 ],
        );
    }
}
