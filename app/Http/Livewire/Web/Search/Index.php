<?php

namespace App\Http\Livewire\Web\Search;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination ;
    protected $paginationTheme = "home-paginate";
    public $query;
    public $result ;
    public $discount ;
    public $label = [];
    public $Empty = true;


    public function mount()
    {

        $this->query = request()->has('q') ? request()->get('q') : null ;

        if (!empty($this->query)) {
            $this->Empty = false;

            $product = Product::where('name', 'like', "%{$this->query}%")->with(['firstPhotos' , 'activeDiscount', 'activeWarehouses' , 'categories', 'categories.activeDiscount'])->get();



            $brand = Brand::where('label', 'like', "%{$this->query}%")->
                orWhere('title', 'like', "%{$this->query}%")->first();

            $brand = $brand ? $brand->products()->with(['firstPhotos' , 'activeDiscount', 'activeWarehouses' , 'categories', 'categories.activeDiscount'])->get() : null;


            $category = Category::where('label', 'like', "%{$this->query}%")->
                orWhere('title', 'like', "%{$this->query}%")->with('activeDiscount')->first()?? null;

            $category = $category ? $category->products()->with(['firstPhotos' , 'activeDiscount', 'activeWarehouses' , 'categories' , 'categories.activeDiscount'])->get() : null ;


                $merge = $brand ? $product->merge($brand) : $product;
            $this->result = $category ? $merge->merge($category) : $merge;
        }
        if ($this->result) {
            foreach ($this->result as $item) {
//                $item->load();
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
        return view('livewire.web.search.index' , [
            'data' => $this->Empty ? null : $this->result->paginate(8)
        ])->layout('layouts.home' , [
            'style' => 'search.css' ,
            'script' => 'search.js' ,
            'title' => 'بگرد و پیدا کن' ,
        ]);
    }
}
