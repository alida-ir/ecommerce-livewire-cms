<?php

namespace App\Http\Livewire\Dashboard\Permission;

use App\Models\Permission;
use App\Models\Role;
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

    public function deletePermission(Permission $permission)
    {
        $this->authorize('delete' , [Permission::class , auth()->user()]);
        $permission->delete();
    }

    public function render()
    {
        $this->authorize('viewAny' , Permission::class);
        return view('livewire.dashboard.permission.index', [
                'permissions' => Permission::withTrashed()->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('label' , "LIKE" , "%{$this->search}%")
                    ->orWhere('id' , $this->search)->orderBy('id' , $this->order)
                    ->paginate($this->perPagePaginate),
            ])->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'permission.index' , 'title' => 'همه مجوز ها'] ,
                ]]
            );
    }
}
