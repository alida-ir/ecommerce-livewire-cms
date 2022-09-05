<?php

namespace App\Http\Livewire\Web\Product;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Show extends Component
{
    public Product $product;
    public $discount = null;
    public $color = null ;
    public $colorSelect = null ;
    public $sizeSelect= null ;
    public $size = null ;
    public $ColorSize = null ;
    public $price;
    public $SimilarProduct = [] ;
    public $SimilarProductDiscount = [] ;
    public $notAvailable = true;

    public $label;

    public function mount()
    {
        $this->product = Product::where('slug' , request()->slug)->with(['photos' , 'brand' , 'categories'  , 'categories.activeDiscount' , 'activeDiscount' , 'activeWarehouses'])->first();
        $this->price = $this->product->price ;

        foreach ($this->product->categories as $category) {
            if (!$category->activeDiscount->isEmpty()){
                $this->discount = $category->activeDiscount->last();
            }
            if (!$this->product->activeDiscount->isEmpty()){
                $this->discount = $this->product->activeDiscount->last();
            }
        }

        $user = Auth::user();
        if ($user) {
            $cart = Cart::where('product_id' , $this->product->id)->where('user_id' , $user->id)->first();
            if (!empty($cart)) {
                $this->label = 'حذف از سبد خرید';
            } else {
                $this->label = 'افزودن به سبد خرید';
            }
        }else{
            $this->label = 'افزودن به سبد خرید';
        }

        foreach ($this->product->activeWarehouses as $key => $Warehouse) {
            if ($Warehouse->color != null && !array_key_exists('color' , $this->color ?? [])){
                $this->notAvailable = false;
                $this->color[$Warehouse->color] = [
                    'id' => $key + 1 ,
                    'color' => $Warehouse->color ,
                    'hex' => $Warehouse->hex ,
                    'quantity' => $Warehouse->quantity ,
                    'price' => $Warehouse->price ,
                    'transportation_cost' => $Warehouse->transportation_cost ,
                ];
            }

            if ($Warehouse->size != null){
                $this->notAvailable = false;
                $this->size[] = [
                    'color' => $Warehouse->color ,
                    'color_id' => $key + 1 ,
                    'size' => $Warehouse->size ,
                    'quantity' => $Warehouse->quantity ,
                    'price' => $Warehouse->price ,
                    'transportation_cost' => $Warehouse->transportation_cost ,
                ];
            }

            if ($Warehouse->size == null && $Warehouse->color == null || $Warehouse->available == false){
                $this->notAvailable = true;
            }

        }
        if ($this->colorSelect == null){
            if ($this->color) {
                $key = array_key_first($this->color);
                if ($key) {
                    $this->colorSelect = $this->color[$key];
                    if ($this->size) {
                        foreach ($this->size as $arg => $item) {
                            if ($item['color'] == $key) {
                                $this->ColorSize[] = $item;
                                if ($arg == 0) {
                                    $this->sizeSelect = $item['size'];
                                }
                            }
                        }
                    }
                } else {
                    $this->colorSelect = null;
                    $this->ColorSize = null;

                }
            }
        }

        $this->SimilarProduct();
    }

    public function addToCart()
    {
        $user = auth()->user();
        $id = $this->product->id ;
        if ($user) {
            $cart = Cart::where(['product_id' => $this->product->id ], ['user_id' => $user->id])->first();
            if (empty($cart)) {
                Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $this->product->id,
                    'color' => $this->colorSelect['color'],
                    'size' => $this->sizeSelect,
                ]);
                 $this->label = 'حذف از سبد خرید';
            } else {
                $this->label = 'افزودن به سبد خرید';
                $cart->delete();
            }
        }else{
            return $this->redirect(route('login'));
        }
        $this->dispatchBrowserEvent('contentChanged');

    }

    public function updatedSizeSelect()
    {
        $this->dispatchBrowserEvent('contentChanged');
    }

    public function changeColor($color)
    {
        $this->ColorSize = null ;
         foreach ($this->color as $item) {
            if ($item['color'] == $color){
                $this->colorSelect = $item ;
                $this->price = $item['price'] ;
                if ($this->size != null) {
                    foreach ($this->size as $arg => $value) {
                        if ($value['color'] == $color) {
                            $this->ColorSize[] = $value;
                            $this->sizeSelect = $value['size'];
                            $this->price = $value['price'] ;
                        }
                    }
                }
            }
        }
        $this->dispatchBrowserEvent('contentChanged');
    }

    public function SimilarProduct()
    {
        $categories = $this->product->categories->pluck('id')->toArray();

        $similar = Product::whereHas('categories', function ($query) use ($categories) {
            return $query->whereIn('category_id', $categories);
        })->whereNot('id', $this->product->id)->with(['photos' , 'activeDiscount', 'activeWarehouses' , 'categories' , 'categories.activeDiscount'])->limit(12)->get();


        if (empty($similar[0])){
            $similar = $this->product->brand()->with('products')->first()->products()->with(['photos' , 'activeDiscount', 'activeWarehouses' , 'categories' , 'categories.activeDiscount'])->whereNot('id', $this->product->id)->limit(12)->get() ;
        }

        if ($similar) {
            foreach ($similar as $item) {
                foreach ($item->categories as $category) {
                    if (!$item->activeDiscount->isEmpty()){
                        $this->SimilarProductDiscount[$item->id] = $item->activeDiscount->first();
                    }
                    if (!$category->activeDiscount->isEmpty()){
                        $this->SimilarProductDiscount[$item->id] = $category->activeDiscount->first();
                    }
                }
            }
        }


        $this->SimilarProduct = $similar ;

    }

    public function render()
    {
        return view('livewire.web.product.show')->layout('layouts.home' ,[
            'style' => 'pro.css' ,
            'script' => 'pro.js' ,
            'title' => $this->product->name ,
            'meta' => [
                      'keywords' => $this->product->keywords ,
                      'description' => $this->product->description ,
                     ]
        ]);
    }
}
