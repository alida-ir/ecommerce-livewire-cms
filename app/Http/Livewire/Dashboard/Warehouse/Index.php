<?php

namespace App\Http\Livewire\Dashboard\Warehouse;

use App\Models\Warehouse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use AuthorizesRequests , WithPagination ;
    public $search;
    protected $queryString = ['search'];
    public $order = 'asc';
    protected $paginationTheme = "dashboard-paginate";
    public $perPagePaginate = 5;

    public function orderBy()
    {
        if ($this->order == 'asc'){
            $this->order = 'desc';
        }elseif ($this->order == 'desc'){
            $this->order = 'asc';
        }
    }
    public function deleteWarehouse(Warehouse $warehouse)
    {
        $this->authorize('delete' , [$warehouse]);
        $warehouse->delete();
    }

    public function render()
    {
        $this->authorize('viewAny' , [Warehouse::class , auth()->user()]);

        return view('livewire.dashboard.warehouse.index', [
            'warehouses' => Warehouse::withTrashed()->with(['product'])
                ->where('product_id', 'like', '%'.$this->search.'%')
                ->orWhere('color' , "LIKE" , "%{$this->search}%")
                ->orWhere('available' , "LIKE" , "%{$this->search}%")
                ->orWhere('quantity' , "LIKE" , "%{$this->search}%")
                ->orWhere('price' , "LIKE" , "%{$this->search}%")
                ->orWhere('transportation_cost' , "LIKE" , "%{$this->search}%")
                ->orWhere('id' , $this->search)->orderBy('id' , $this->order)
                ->paginate($this->perPagePaginate),
        ])->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'warehouse.index' , 'title' => 'همه موجودی انبار'] ,
             ]]
        );
    }
}
