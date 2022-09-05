<?php

namespace App\Http\Livewire\Dashboard\Payment;

use App\Models\Order;
use App\Models\TransAction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use AuthorizesRequests , WithPagination ;
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
        $this->sort = 'PayOk';
    }
    public function changePayNull()
    {
        $this->sort = 'PayNull';
    }

    public function context()
    {
        $this->authorize('viewAny' , TransAction::class);
        $user = auth()->user();
        $user->load('transActions');
        if ($user->role->hasPermissions('show-self-trans-action')) {
            if ($this->sort == 'all') {
                return $user->transActions()->with(['user', 'order'])
                    ->orderBy('id', $this->order)
                    ->paginate($this->perPagePaginate);
            }
            elseif ($this->sort == 'PayOk') {
                return $user->transActions()->where('status', 1)->with(['user', 'order'])
                    ->orderBy('id', $this->order)
                    ->paginate($this->perPagePaginate);
            }
            elseif ($this->sort == 'PayNull') {
                return $user->transActions()->where('status', 0)->with(['user', 'order'])
                    ->orderBy('id', $this->order)
                    ->paginate($this->perPagePaginate);
            }
        }else{
            if ($this->sort == 'all') {
                return TransAction::with(['user', 'order'])
                    ->orderBy('id', $this->order)
                    ->paginate($this->perPagePaginate);
            }
            elseif ($this->sort == 'PayOk') {
                return TransAction::where('status', 1)->with(['user', 'order'])
                    ->orderBy('id', $this->order)
                    ->paginate($this->perPagePaginate);
            }
            elseif ($this->sort == 'PayNull') {
                return TransAction::where('status', 0)->with(['user', 'order'])
                    ->orderBy('id', $this->order)
                    ->paginate($this->perPagePaginate);
            }
        }
    }
    public function render()
    {
        $this->authorize('viewAny' , TransAction::class);
        return view('livewire.dashboard.payment.index' , [
            'trans_actions' => $this->context()
        ])->layout('layouts.dashboard'
            , ['breads' => [
            ['name' => 'payment.index' , 'title' => 'تراکنش ها'] ,
        ]]);
    }
}
