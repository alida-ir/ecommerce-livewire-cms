<?php

namespace App\Http\Livewire\Dashboard\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;
    public User $user;
    public $current_password ;
    public $new_password ;
    public $password_confirmation ;

    protected $rules = [
        'user.name' => 'required',
        'user.email' => 'required|email' ,
        'user.number' => 'required|min:11|max:11' ,
        'current_password' => 'nullable',
        'new_password' => 'nullable|min:6',
        'password_confirmation' => 'nullable|min:6' ,
        'user.role_id' => 'nullable|exists:roles,id' ,
        'user.approved' => 'required'
    ];

    public function mount()
    {
        $this->user = User::findOrFail(request()->id);
    }

    public function edit()
    {
        $this->authorize('update' , [$this->user , auth()->user()]);
        $data = $this->validate();

        $this->validate([
            'user.email' => ['required' , Rule::unique('users' , 'email')->ignore($this->user->id)  , 'email'] ,
            'user.number' => ['required' , 'min:11' , 'max:11' , Rule::unique('users' , 'number')->ignore($this->user->id) ] ,
        ]);


        if ($this->user->password == null){
            $this->validate([
                'new_password' => 'nullable|min:8',
                'password_confirmation' => 'required_with:new_password|min:8|nullable' ,
            ]);
        }else{
            $this->validate([
                'new_password' => 'required_with:current_password|nullable|min:8',
                'password_confirmation' => 'required_with:new_password|nullable|min:8' ,
            ]);
        }


        if($this->new_password != $this->password_confirmation){
            $this->addError('new_password' , 'رمز عبور جدید با تاییدیه ان مطابقت ندارد !' );
            return ;
        }

        if ($this->current_password != null){
            if (Hash::check($this->current_password, auth()->user()->password)){
                if ($this->new_password != null) {
                    $this->user->password = Hash::make($this->new_password);
                }
            }else{
                $this->addError('current_password' , 'رمز عبور فعلی اشتباه است دوباره تلاش کنید !' );
                return ;
            }
        }

        if ($this->user->password == null && $this->new_password != null){
            if($this->new_password == $this->password_confirmation){
                $this->user->password = Hash::make($this->new_password);
            }else{
                $this->addError('new_password' , 'رمز عبور جدید با تاییدیه ان مطابقت ندارد !' );
                return ;
            }
        }
        $this->user->save();
        Session::flash('success' , ['ویرایش با موفقیت انجام شد !']);
        $this->redirect(route('dashboard'));
    }

    public function render()
    {
        $this->authorize('update' , [$this->user , auth()->user()]);
        $roles = Role::all();
        return view('livewire.dashboard.user.edit' , compact('roles'))->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'users.index' , 'title' => 'همه کاربران'] ,
                ['name' => 'users.edit' , 'title' => 'ویرایش کاربر' , 'params' => $this->user->id] ,
            ]]
        );
    }
}
