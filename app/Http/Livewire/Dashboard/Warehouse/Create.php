<?php

namespace App\Http\Livewire\Dashboard\Warehouse;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;
    public Warehouse $warehouse;

    protected $rules = [
        'warehouse.product_id' => 'required|exists:products,id',
        'warehouse.color' => 'required_without:warehouse.size|string|min:2|max:55',
        'warehouse.hex' => 'required_with:warehouse.color|nullable|string',
        'warehouse.size' => 'required_without:warehouse.color|nullable|string|min:1|max:55',
        'warehouse.quantity' => 'required|string|min:1|max:11',
        'warehouse.price' => 'required|string|min:3|max:16',
        'warehouse.transportation_cost' => 'nullable|string|min:3|max:16',
    ];
    public function mount()
    {
        $this->warehouse = new Warehouse();
    }

    public function create()
    {
        $this->authorize('create' , [$this->warehouse]);
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
        Session::flash('success' , ['موجودی با موفقیت ایجاد شد !']);
        return $this->redirect(route('warehouse.index'));
    }

    public function render()
    {
        $this->authorize('create' , [$this->warehouse]);
        $products  = Product::all();
        return view('livewire.dashboard.warehouse.create' , compact('products'))->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'warehouse.index' , 'title' => 'همه موجودی انبار'] ,
                ['name' => 'warehouse.create' , 'title' => 'ایجاد موجودی ' ] ,
            ]]
        );
    }
}
