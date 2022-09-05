<?php

namespace App\Http\Livewire\Dashboard\Discount;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;
    public Discount $discount;

    protected $rules = [
        'discount.name' => 'required|string|unique:discounts,name' ,
        'discount.quantity' => 'required|min:1|max:99|string' ,
        'discount.product_id' => 'required_without:discount.category_id' ,
        'discount.category_id' => 'required_without:discount.product_id' ,
        'discount.message' => 'required|min:8|string' ,
        'discount.status' => 'nullable' ,
        'discount.expired' => 'required|string' ,
    ];

    public function mount()
    {
        $this->discount = new Discount;
    }

    public function create()
    {
        $this->authorize('create' , Discount::class);

        $this->validate();

        if ($this->discount->category_id){
            $this->validate([
                'discount.category_id' => 'exists:categories,id' ,
            ]);
        }
        if ($this->discount->product_id){
            $this->validate([
                'discount.product_id' => 'exists:products,id' ,
            ]);
        }

        $this->discount->save();
        Session::flash('success' , ['ایجاد تخفیف با موفقیت انجام شد !']);
        return $this->redirect(route('discount.index'));
    }


    public function render()
    {
        $this->authorize('create' , Discount::class);

        $categories = Category::all();
        $products = Product::all();
        return view('livewire.dashboard.discount.create', compact('categories' , 'products'))
            ->layout('layouts.dashboard'
                , ['breads' => [
                    ['name' => 'discount.index' , 'title' => 'همه تخفیف ها'] ,
                    ['name' => 'discount.create' , 'title' => 'ایجاد تخفیف' ] ,
                ]]
            );
    }
}
