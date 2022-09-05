<?php

namespace App\Http\Livewire\Dashboard\Order;

use App\Models\Order;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use AuthorizesRequests , WithPagination ;
    public $search;
    protected $queryString = ['search'];
    public $order = 'desc';
    protected $paginationTheme = "dashboard-paginate";
    public $perPagePaginate = 5;
    public $sort = 'all';

    public function orderBy()
    {
        if ($this->order == 'asc'){
            $this->order = 'desc';
        }elseif ($this->order == 'desc'){
            $this->order = 'asc';
        }
    }

    public function changeAll()
    {
        $this->sort = 'all';
    }
    public function changePayOk()
    {
        $this->sort = 'payment_ok';
    }
    public function changeTransStatusOk()
    {
        $this->sort = 'TransStatusOk';
    }
    public function changeTransStatusNot()
    {
        $this->sort = 'TransStatusNot';
    }
    public function changeTransStatusTrue()
    {
        $this->sort = 'TransStatusTrue';
    }

    public function context()
    {
        $this->authorize('viewAny' , Order::class);
        $user = auth()->user();
        if ($user->role->hasPermissions("show-self-order")){
            if ($this->sort == 'payment_ok') {
                return $user->orders()->where('payment_status', '=', true)->with(['user'])
                    ->orderBy('id', $this->order)
                    ->paginate($this->perPagePaginate);
            }
            elseif ($this->sort == 'all') {
                return $user->orders()->with(['user'])
                    ->orderBy('id', $this->order)
                    ->paginate($this->perPagePaginate);
            }
            elseif ($this->sort == 'TransStatusOk') {
                return $user->orders()->where('transportation_cost_status', '=', 4)->with(['user'])
                    ->orderBy('id', $this->order)
                    ->paginate($this->perPagePaginate);
            }
            elseif ($this->sort == 'TransStatusNot') {
                return $user->orders()->where('transportation_cost_status', '=', 0)->with(['user'])
                    ->orderBy('id', $this->order)
                    ->paginate($this->perPagePaginate);
            }
            elseif ($this->sort == 'TransStatusTrue') {
                return $user->orders()->where('transportation_cost_status', '=', 2)->with(['user'])
                    ->orderBy('id', $this->order)
                    ->paginate($this->perPagePaginate);
            }
        }elseif($user->role->hasPermissions("show-all-order")) {
            if ($this->sort == 'payment_ok') {
                return Order::where('payment_status', '=', true)->with(['user'])
                    ->orderBy('id', $this->order)
                    ->paginate($this->perPagePaginate);
            }
            elseif ($this->sort == 'all') {
                return Order::with(['user'])
                    ->orderBy('id', $this->order)
                    ->paginate($this->perPagePaginate);
            }
            elseif ($this->sort == 'TransStatusOk') {
                return Order::where('transportation_cost_status', '=', 4)->with(['user'])
                    ->orderBy('id', $this->order)
                    ->paginate($this->perPagePaginate);
            }
            elseif ($this->sort == 'TransStatusNot') {
                return Order::where('transportation_cost_status', '=', 0)->with(['user'])
                    ->orderBy('id', $this->order)
                    ->paginate($this->perPagePaginate);
            }
            elseif ($this->sort == 'TransStatusTrue') {
                return Order::where('transportation_cost_status', '=', 2)->with(['user'])
                    ->orderBy('id', $this->order)
                    ->paginate($this->perPagePaginate);
            }
        }
    }


    public function render()
    {
         $this->authorize('viewAny' , Order::class);
        return view('livewire.dashboard.order.index', [
            'orders' => $this->context(),
        ])->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'order.index' , 'title' => 'سفارشات'] ,
            ]]
        );
    }
}
