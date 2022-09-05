<?php

namespace App\Http\Livewire\Dashboard\Order;

use App\Models\Order;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Detail extends Component
{
    use AuthorizesRequests;
    public Order $order;
    protected $rules = ['order.transportation_cost_status' => 'required'];
    public $can_update = false;
    public $Discounts = [];


    public function saveStatus()
    {
        $this->authorize('update' , $this->order);
        $this->order->save();
    }

    public function mount()
    {
        $this->order = Order::findOrFail(request()->id);
        $this->order->load(['user' , 'orderItems' , 'transActions' , 'discounts' ]);
        $this->authorize('view' , $this->order);
        if (auth()->user()->role->hasPermissions('update-order')){
            $this->can_update = true;
        }

        if (auth()->user()->role->hasPermissions('show-discount')){
            if ($this->order->discounts != null){
                $this->order->discounts->load(['product' , 'category']);
                foreach ($this->order->discounts as $key => $discount){
                    $this->Discounts[$key] = $discount;
                }
            }
        }

    }

    public function render()
    {
        $this->authorize('view' , $this->order);
        return view('livewire.dashboard.order.detail')->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'order.index' , 'title' => 'سفارشات'] ,
                ['name' => 'order.detail' , 'title' => 'مشاهده سفارش' , 'params' => $this->order->id] ,
            ]]
        );
    }
}
