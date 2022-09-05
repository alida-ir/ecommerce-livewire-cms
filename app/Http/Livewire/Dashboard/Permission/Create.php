<?php

namespace App\Http\Livewire\Dashboard\Permission;

use App\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;
    public Permission $permission;

    protected $rules = [
        'permission.title' => 'required|string|min:4',
        'permission.label' => 'required|string|min:4' ,
    ];
    public function mount()
    {
        $this->permission = new Permission;
    }
    public function create()
    {
        $this->authorize('create' , [Permission::class , auth()->user()]);
        $this->validate();
        $this->validate([
            "permission.title" => [ Rule::unique('permissions' , 'title')] ,
            "permission.label" => [ Rule::unique('permissions' , 'label')] ,
        ]);
        $this->permission->save();
        Session::flash('success' , ['ایجاد مجوز با موفقیت انجام شد !']);
        return $this->redirect(route('permission.index'));
    }
    public function render()
    {
        $this->authorize('create' , [Permission::class , auth()->user()]);
        return view('livewire.dashboard.permission.create')->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'permission.index' , 'title' => 'همه مجوز ها'] ,
                ['name' => 'permission.create' , 'title' => 'ایجاد مجوز ها'  ] ,

            ]]
        );
    }
}
