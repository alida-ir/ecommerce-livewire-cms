<?php

namespace App\Http\Livewire\Dashboard\Role;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;
    public Role $role;
    public $permissions;
    public $selectPermission;


    protected $rules = [
        'role.title' => 'required',
        'role.label' => 'required',
    ];

    public function mount()
    {
        $this->role = Role::findOrFail(\request()->id);
        $this->role->load(['permissions']);
        $this->permissions = Permission::all();
        $this->selectPermission = $this->role->permissions()->pluck('permission_id')->toArray();
    }

    public function updatedSelectPermission()
    {
        $this->dispatchBrowserEvent('LoadSelect');
    }

     public function update()
    {
        $this->authorize('update' , [Role::class , auth()->user()]);
        $this->validate([
            "role.title" => [ Rule::unique('roles' , 'title')->ignore($this->role->id)] ,
            "role.label" => [ 'required' ,'string' , 'min:4'  , Rule::unique('roles' , 'label')->ignore($this->role->id)] ,
        ]);

         $this->role->save();

         $this->role->permissions()->sync($this->selectPermission);

        Session::flash('success' , ['ویرایش با موفقیت انجام شد']);
        return redirect()->route('role.index');

    }

    public function render()
    {
        $this->authorize('update' , [Role::class , auth()->user()]);
        return view('livewire.dashboard.role.edit')
            ->layout('layouts.dashboard'
                , ['breads' => [
                    ['name' => 'role.index' , 'title' => 'سطوح دسترسی'] ,
                    ['name' => 'role.edit' , 'title' => 'ویرایش سطح دسترسی' , 'params' => $this->role->id] ,
                ]]
            );
    }
}
