<?php

namespace App\Http\Livewire\Dashboard\Discount;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;
    public Discount $discount;

    protected $rules = [
        'discount.name' => 'required|string' ,
        'discount.quantity' => 'required|min:1|max:99|string' ,
        'discount.product_id' => 'required_without:discount.category_id' ,
        'discount.category_id' => 'required_without:discount.product_id' ,
        'discount.message' => 'required|min:8|string' ,
        'discount.status' => 'nullable' ,
        'discount.expired' => 'required|string' ,
    ];

    public function edit()
    {
        $this->authorize('update' , Discount::class);

        $this->validate();
        $this->validate([
            'discount.name' => [ Rule::unique('discounts' , 'name')->ignore($this->discount->id)]
        ]);
        $this->discount->save();
        Session::flash('success' , ['ویرایش با موفقیت انجام شد !']);
        return $this->redirect(route('discount.index'));
    }

    public function mount()
    {
        $this->discount = Discount::findOrFail(request()->id);
    }

    public function render()
    {
        $this->authorize('update' , Discount::class);
        $categories = Category::all();
        $products = Product::all();
        return view('livewire.dashboard.discount.edit' , compact('categories' , 'products'))
            ->layout('layouts.dashboard'
                , ['breads' => [
                    ['name' => 'discount.index' , 'title' => 'همه تخفیف ها'] ,
                    ['name' => 'discount.edit' , 'title' => 'ویرایش تخفیف ' , 'params' => $this->discount->id] ,
                ]]
            );
    }
}
