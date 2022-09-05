<?php

namespace App\Http\Livewire\Home\Password;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;

class ResetPassword extends Component
{
    public $token;
    public $email;
    public $password;
    public $password_confirmation;
    protected $queryString = ['token' , 'email'];

    protected $rules = [
        'token' => 'required|string' ,
        'email' => 'required|email|exists:users,email' ,
        'password' => 'required|confirmed|min:8' ,
        'password_confirmation' => 'required|min:8' ,
    ];
    public function mount()
    {
        if ($this->token ==null){
            $this->token = request('token');
        }
    }

    public function submit()
    {
        $this->validate();
        $db = DB::table('password_resets')->where('email' , $this->email)->first() ;
        if ($db === null){
            Session::flash('error' , ['زمان استفاده از این لینک برای بازنشانی رمز عبور به پایان رسیده است ! لطفا بار دیگر درخواست دهید !']);
            return redirect()->route('password.request')->with('email' , $this->email);
        }
        if (Hash::check($this->token , $db->token)){
            if ($db->created_at <= Carbon::now()){
                $user = User::where('email' , $this->email)->first();
                $user->update([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ]);
                DB::delete('DELETE FROM `password_resets` WHERE `email`=? AND `token`=? ' , [$this->email , $db->token]);
                return redirect()->intended(RouteServiceProvider::HOME);
            }else{
                Session::flash('error' ,[ 'زمان استفاده از این لینک برای بازنشانی رمز عبور به پایان رسیده است ! لطفا بار دیگر درخواست دهید !']);
                return $this->redirect(route('password.request')->with('email' , $this->email));
            }
        }else{
            Session::flash('error' ,[ 'عملیات بازنشانی رمز عبور تایید نشد ! لطفا باردیگر درخواست بازنشانی بدهید !']);
            return $this->redirect(route('password.request')->with('email' , $this->email));
        }

    }
    public function render()
    {
        return view('livewire.home.password.reset-password')->layout('layouts.login');
    }
}
