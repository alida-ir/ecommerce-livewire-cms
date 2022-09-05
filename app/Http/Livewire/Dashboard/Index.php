<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $users = array();
    public $SaleByProduct = array();
    public $payments = array();
    public $countOrder = 0;
    public $countBuy = 0;
    public $countTransOk = 0;
    public $countTransFull = 0;

    public $year;

    public function mount()
    {
        $user = auth()->user();
        $user->load(['transActions' , 'orders']);
        if ($user->role->hasPermissions('show-admin-monitoring')){

            $this->year = now()->year;

            for($i=1;$i<=12;$i++){
                $this->users[$i] = DB::table('users')->whereYear('created_at', $this->year)->whereMonth('created_at',$i)->count();
                $this->users[$i] = empty($this->users[$i]) ? "0" : $this->users[$i];
            }

            for($i=1;$i<=12;$i++){
                $trans = DB::table('trans_actions')
                    ->whereYear('created_at', $this->year)
                    ->whereMonth('created_at',$i)
                    ->where('status' , true)
                    ->pluck('price');
                $pay = 0;
                if (!$trans->isEmpty()){
                    foreach ($trans as $price){
                        $pay += $price;
                    }
                }
                $this->payments[$i] = $pay;
            }

            for($i=1;$i<=12;$i++) {
                $this->SaleByProduct[$i] =   DB::table('order_items')
                    ->join('orders', 'orders.id', '=', 'order_items.order_id')
                    ->where('payment_status' , true)
                    ->whereYear('order_items.created_at' , $this->year)
                    ->whereMonth('order_items.created_at' , $i)->count();
            }

            $this->year = verta(now())->format('Y');
        }

        if ($user->role->hasPermissions('show-user-monitoring')){
            $this->countOrder = $user->orders()->where('payment_status' , true)->count();
            $allCountBuy = $user->transActions()->where('status' , true)->get();
            foreach ($allCountBuy as $item) {
                $this->countBuy += $item->price;
            }
            $this->countTransOk = $user->orders()->where('transportation_cost_status' , 2)->count();
            $this->countTransFull = $user->orders()->where('transportation_cost_status' , 4)->count();
        }

    }

    public function render()
    {
        return view('livewire.dashboard.index')->layout('layouts.dashboard');
    }
}
