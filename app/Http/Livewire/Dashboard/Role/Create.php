<?php

namespace App\Http\Livewire\Dashboard\Role;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;
    public Role $role;
    public $permission=[];

    protected $rules = [
        'role.title' => 'required|string|min:4',
        'role.label' => 'required|string|min:4' ,
        'permission' => 'nullable|array'
    ];

    public function mount()
    {
        $this->role = new Role;
    }

    public function create()
    {
        $this->authorize('create' , [Role::class , auth()->user()]);
        $this->validate();
        $this->validate([
            "role.title" => [ Rule::unique('roles' , 'title')] ,
            "role.label" => [ Rule::unique('roles' , 'label')] ,
        ]);
        $this->role->save();
        $this->role->permissions()->sync($this->permission);
        Session::flash('success' , ['ایجاد کاربر با موفقیت انجام شد !']);
        return $this->redirect(route('role.index'));
    }

    public function render()
    {
        $this->authorize('create' , [Role::class , auth()->user()]);
        $permissions = Permission::all();
        return view('livewire.dashboard.role.create' , compact('permissions'))->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'role.index' , 'title' => 'سطوح دسترسی'] ,
                ['name' => 'role.create' , 'title' => 'ایجاد سطح دسترسی' ] ,
            ]]
        );
    }
}
