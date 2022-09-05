<?php

namespace App\Http\Livewire\Dashboard\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;
    public User $user;
    public $user_roles;

    protected $rules = [
        'user.name' => 'required' ,
        'user.email' => ['required' ,'email'] ,
        'user.number' => ['required' , 'min:11' , 'max:11' ] ,
        'user_roles' =>['required']
    ];

    public function mount()
    {
        $this->user = new User;
    }

    public function create()
    {
        $this->authorize('create' , [User::class , auth()->user()]);
        $this->validate();
        $this->validate([
           'user.email' =>  Rule::unique('users' , 'email') ,
            'user.number' => Rule::unique('users' , 'number'),
            'user_roles' => Rule::exists('roles' , 'id')
        ]);
        $this->user->role_id = $this->user_roles ;
        $this->user->password = Hash::make($this->user->number) ;
        $this->user->approved = true ;
        $this->user->save();
        Session::flash('success' , ['ایجاد کاربر با موفقیت انجام شد !']);
        return $this->redirect(route('users.index'));
    }

    public function render()
    {
        $this->authorize('create' , [User::class , auth()->user()]);
        $roles = Role::all();
        return view('livewire.dashboard.user.create' , compact('roles'))->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'users.index' , 'title' => 'همه کاربران'] ,
                ['name' => 'users.create' , 'title' => 'ایجاد کاربر'] ,
            ]]
        );
    }
}
