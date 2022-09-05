<?php

namespace App\Http\Livewire\Dashboard\User;

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

    public function deleteUser(User $user)
    {
        $this->authorize('delete' , [User::class , auth()->user()]);
        $user->delete();
    }

    public function render()
    {
        $this->authorize('viewAny' , [User::class]);
        return view('livewire.dashboard.user.index' , [
            'users' => User::withTrashed()->where('name', 'like', '%'.$this->search.'%')
                             ->orWhere('email' , "LIKE" , "%{$this->search}%")
                             ->orWhere('number' , "LIKE" , "%{$this->search}%")
                             ->orWhere('id' , $this->search)->orderBy('created_at' , $this->order)
                             ->paginate($this->perPagePaginate),
        ])->layout('layouts.dashboard' , ['breads' => [
            ['name' => 'users.index' , 'title' => 'همه کاربران']
        ]]);
    }
}
