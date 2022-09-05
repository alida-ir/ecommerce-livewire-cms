<?php

namespace App\Http\Livewire\Dashboard\Role;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use AuthorizesRequests , WithPagination;
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

    public function deleteRole(Role $role)
    {
        $this->authorize('delete' , [Role::class , auth()->user()]);
        $role->delete();
    }

    public function render()
    {
        $this->authorize('viewAny' , [Role::class , auth()->user()]);
        return view('livewire.dashboard.role.index' ,[
            'roles' => Role::withTrashed()->where('title', 'like', '%'.$this->search.'%')
            ->orWhere('label' , "LIKE" , "%{$this->search}%")
            ->orWhere('id' , $this->search)->orderBy('created_at' , $this->order)
            ->paginate($this->perPagePaginate),
        ])->layout('layouts.dashboard' , [
            'breads' => [
                            ['name' => 'role.index' , 'title' => ' سطوح دسترسی'] ,
                         ]
        ]);
    }
}
