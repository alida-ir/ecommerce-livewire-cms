<?php

namespace App\Http\Livewire\Dashboard\Product;

use App\Models\Permission;
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
    public function deleteProduct(Product $product)
    {
        $this->authorize('delete' , [$product]);
        $product->delete();
    }

    public function render()
    {
        $this->authorize('viewAny' , Product::class);
        return view('livewire.dashboard.product.index' , [
            'products' => Product::withTrashed()->where('name', 'like', '%'.$this->search.'%')
                ->orWhere('slug' , "LIKE" , "%{$this->search}%")
                ->orWhere('price' , "LIKE" , "%{$this->search}%")
                ->orWhere('id' , $this->search)->orWhere('brand_id' , $this->search)->orderBy('id' , $this->order)
                ->paginate($this->perPagePaginate),
        ])->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'product.index' , 'title' => 'محصولات'] ,
            ]]
        );
    }
}
