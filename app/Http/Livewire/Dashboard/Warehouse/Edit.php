<?php

namespace App\Http\Livewire\Dashboard\Warehouse;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;
    public Warehouse $warehouse;
    protected $rules = [
        'warehouse.product_id' => 'required|exists:products,id',
        'warehouse.color' => 'nullable|min:2|max:55',
        'warehouse.size' => 'nullable|string|min:2|max:55',
        'warehouse.hex' => 'nullable|string|min:2|max:55',
        'warehouse.quantity' => 'required|min:1|max:11',
        'warehouse.price' => 'required|string|min:3|max:16',
        'warehouse.transportation_cost' => 'nullable|string|min:3|max:16',
    ];
    public function mount()
    {
        $this->warehouse = Warehouse::findOrFail(request()->id);
    }

    public function edit()
    {
        $this->authorize('update' , [$this->warehouse]);
        $this->validate();
        if ($this->warehouse->quantity >= 1){
            $this->warehouse->available = true;
        }else{
            $this->warehouse->available = false;
        }
        if ($this->warehouse->transportation_cost == null){
            $this->warehouse->transportation_cost = env('TRANSPORTATION_CONST' , 7500);
        }
        $this->warehouse->save();
        Session::flash('success' , ['موجودی با موفقیت ویرایش شد !']);
        return $this->redirect(route('warehouse.index'));
    }

    public function render()
    {
        $this->authorize('update' , [$this->warehouse]);
        $products  = Product::all();
        return view('livewire.dashboard.warehouse.edit' , compact('products'))->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'warehouse.index' , 'title' => 'همه موجودی انبار'] ,
                ['name' => 'warehouse.edit' , 'title' => 'ویرایش موجودی ' , 'params' => $this->warehouse->id] ,
            ]]
        );
    }
}
