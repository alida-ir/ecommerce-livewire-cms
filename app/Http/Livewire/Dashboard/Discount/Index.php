<?php

namespace App\Http\Livewire\Dashboard\Discount;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
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
    public function deleteDiscount(Discount $discount)
    {
        $this->authorize('delete' , [$discount]);
        $discount->delete();
    }

    public function render()
    {
        $this->authorize('viewAny' , Discount::class);
        return view('livewire.dashboard.discount.index', [
            'discounts' => Discount::withTrashed()->with(['product' , 'category'])
                ->where('name', 'like', '%'.$this->search.'%')
                ->orWhere('quantity' , "LIKE" , "%{$this->search}%")
                ->orWhere('message' , "LIKE" , "%{$this->search}%")
                ->orWhere('status' , "LIKE" , "%{$this->search}%")
                ->orWhere('expired' , "LIKE" , "%{$this->search}%")
                ->orWhere('id' , $this->search)->orderBy('id' , $this->order)
                ->paginate($this->perPagePaginate),
        ])->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'discount.index' , 'title' => 'همه تخفیف ها'] ,
             ]]
        );
    }
}
