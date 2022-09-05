<?php

namespace App\Http\Livewire\Dashboard\Brand;

use App\Models\Brand;
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

    public function deleteBrand(Brand $brand)
    {
        $this->authorize('delete' , [Brand::class , auth()->user()]);
        $brand->products()->delete();
        $brand->delete();
    }

    public function render()
    {
        $this->authorize('viewAny' , [Brand::class , auth()->user()]);
        return view('livewire.dashboard.brand.index', [
            'brands' => Brand::withTrashed()->where('title', 'like', '%'.$this->search.'%')
                ->where('label', 'like', '%'.$this->search.'%')
                ->orWhere('id' , $this->search)->orderBy('id' , $this->order)
                ->paginate($this->perPagePaginate),
        ])->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'brand.index' , 'title' => 'برند ها'] ,
            ]]
        );
    }
}
