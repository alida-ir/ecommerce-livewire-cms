<?php

namespace App\Http\Livewire\Dashboard\Category;

use App\Models\Category;
use App\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
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

    public function deleteCategory(Category $category)
    {
        $this->authorize('delete' , [Category::class , auth()->user()]);
        if ($category->photo != null){
            Storage::disk('public_html')->delete('/image/category/'. $category->photo->name);
        }
        $category->delete();
    }

    public function render()
    {
        $this->authorize('viewAny' , [Category::class , auth()->user()]);

        return view('livewire.dashboard.category.index', [
            'categories' => Category::withTrashed()->where('title', 'like', '%'.$this->search.'%')
                ->where('label', 'like', '%'.$this->search.'%')
                ->orWhere('parent_id' , "LIKE" , "%{$this->search}%")
                ->orWhere('id' , $this->search)->orderBy('id' , $this->order)
                ->paginate($this->perPagePaginate),
        ])->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'category.index' , 'title' => 'دسته بندی ها'] ,
            ]]
        );
    }
}
