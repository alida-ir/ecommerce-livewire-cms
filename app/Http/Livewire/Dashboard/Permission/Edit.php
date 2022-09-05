<?php

namespace App\Http\Livewire\Dashboard\Permission;

use App\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;
    public Permission $permission;

    protected $rules = [
        'permission.title' => 'required|string|min:4',
        'permission.label' => 'required|string|min:4' ,
    ];

    public function mount()
    {
        $this->permission = Permission::findOrFail(request()->id);
    }
    public function edit()
    {
        $this->authorize('update' , [Permission::class , auth()->user()]);
        $this->validate();
        $this->validate([
            "permission.title" => [ Rule::unique('permissions' , 'title')->ignore($this->permission->id)] ,
            "permission.label" => [ Rule::unique('permissions' , 'label')->ignore($this->permission->id)] ,
        ]);
        $this->permission->save();
        Session::flash('success' , ['ویرایش به درستی انجام شد !']);
        return $this->redirect(route('permission.index'));
    }
    public function render()
    {
        $this->authorize('update' , [Permission::class , auth()->user()]);
        return view('livewire.dashboard.permission.edit')->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'permission.index' , 'title' => 'همه مجوز ها'] ,
                ['name' => 'permission.edit' , 'title' => 'ویرایش مجوز ها' , 'params' => $this->permission->id] ,

            ]]
        );
    }
}
