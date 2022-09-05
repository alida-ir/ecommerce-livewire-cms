<?php

namespace App\Http\Livewire\Home\Login;

use App\Jobs\ProcessCodeRegister;
use App\Jobs\SendResetPasswordMailJob;
use App\Models\Setting;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Ghasedak\Laravel\GhasedakFacade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Index extends Component
{
    public $username;
    public $password;
    public $Code;

    public $LoginUser = true;
    public $UsePassword = false;

    public $user;
    public $InputType;

    public $emailGuest = false;
    public $dontUsePassword = false;
    public $ForgetPassword = false;

    public $numberVerification = false;
    public $UseCodeByLogin;
    public $EmailForgetPassword;


    public function Login()
    {
        $this->validate([
            'username' => 'required|min:6'
        ]);
        $this->emailGuest = false;
        $this->InputType = filter_var( $this->username , FILTER_VALIDATE_EMAIL) ? 'email' : 'number';
        $user = User::where($this->InputType , $this->username)->first();
        if ($user){
            $this->user = $user;
            if ($user->approved){
                if ($user->password){
                    $this->LoginUser = false;
                    $this->UsePassword = true;
                }else{
                    $this->dontUsePassword = true ;
                    $this->LoginUser = false;
                    $message = 'برای ورود به حساب کاربری در ' . env('APP_NAME') . 'کد یکبار مصرف زیر را وارد کنید : ';
                    $this->Send($message);
                }
            }else{
                $this->Send();
                $this->numberVerification = true;
                $this->LoginUser = false;
            }

        }else{
            if ($this->InputType == 'number'){
                $this->Send();
                $this->numberVerification = true;
                $this->LoginUser = false;
            }else{
                $this->emailGuest = true;
            }
        }
        $this->dispatchBrowserEvent('backOk');
    }

    public function Back()
    {
        if ($this->UsePassword){
            $this->UsePassword = false ;
            $this->LoginUser = true;
            $this->username = "";
            $this->user = null;
        }elseif ($this->dontUsePassword){
            $this->username = "";
            $this->user = null;
            $this->dontUsePassword = false;
            $this->LoginUser = true;
        }elseif ($this->numberVerification){
            $this->numberVerification = false;
            $this->LoginUser = true;
            $this->username = "";
            $this->user = null;
        }elseif ($this->numberVerification){
            $this->numberVerification = false;
            $this->LoginUser = true;
            $this->username = "";
            $this->user = null;
        }
    }

    public function submitUseCodeByLogin()
    {
        $this->validate([
            'UseCodeByLogin' => 'required|min:5|max:6'
        ]);
        if ($this->UseCodeByLogin == $this->user->approved_code){
            if ($this->user->approved_expired >= Carbon::now()){
                Auth::login($this->user);
                return redirect()->intended(RouteServiceProvider::HOME);
            }else{
                $this->addError('Code' , 'متاسفانه زمان ممکن برای وارد کردن کد به پایان رسیده است دوباره تلاش کنید !');
            }
        }else{
            $this->addError('Code' , 'کد وارد شده اشتباه میباشد !');
        }
    }

    public function UsePassword()
    {
        $this->validate([
            'password' => 'required|min:6'
        ]);
        if (Auth::attempt([$this->InputType => $this->username, 'password' => $this->password])){
            return redirect()->intended(RouteServiceProvider::HOME);
        }else{
            $this->addError('password' , 'رمز عبور اشتباه میباشد ! مجددا تلاش کنید');
        }
    }

    public function submitCode()
    {
        if ($this->Code == $this->user->approved_code){
            if ($this->user->approved_expired >= Carbon::now()){
                $this->user->newApproverUpdate();
                Auth::login($this->user);
                return redirect()->intended(RouteServiceProvider::HOME);
            }else{
                $this->addError('Code' , 'متاسفانه زمان ممکن برای وارد کردن کد به پایان رسیده است دوباره تلاش کنید !');
            }
        }else{
            $this->addError('Code' , 'کد وارد شده اشتباه میباشد !');
        }
    }

    public function submitUseCode()
    {
        $this->dontUsePassword = true ;
        $this->LoginUser = false;
        $this->UsePassword = false;
        $message = 'برای ورود به حساب کاربری در ' . env('APP_NAME') . 'کد یکبار مصرف زیر را وارد کنید : ';
        $this->Send($message);
    }

    public function submitEmailForgetPassword()
    {
        $this->validate([
            'EmailForgetPassword' => 'required|exists:users,email'
        ]);
        try {
            if (env("USING_AUTHENTICATE_JOB")) {
                SendResetPasswordMailJob::dispatch(['email' => $this->EmailForgetPassword]);
            }else{
                try {
                    Password::sendResetLink(['email' => $this->EmailForgetPassword]);
                }catch (\Exception $exception){
                    Log::channel('stack')->error($exception->getMessage() . $exception->getTraceAsString());
                }
            }
        }catch (\Exception $exception){
            Log::channel('stack')->error($exception->getMessage() . $exception);
        }

        Session::flash('success' ,[ 'لطفا برای بازیابی رمز عبور روی لینک ارسال شده در ایمیل کلیک کنید !']);
        return $this->redirect(route('login'));
    }

    public function submitForgetPassword(){
        $this->ForgetPassword = true ;
        $this->LoginUser = false;
        $this->UsePassword = false;
        $this->dontUsePassword = false ;
    }

    public function Send($message = 'کد احراز هویت شما : ')
    {
        if (!$this->user){
            $this->user = new User([
                'role_id' => 1,
            ]);
            $this->user->number = $this->username;
        }
        $this->user->approved_code = rand(12345 , 99999);
        $this->user->approved_expired = Carbon::now()->addMinutes(2);
        $this->user->save();
        $data = array(
            'number' => $this->username ,
            'code' => $this->user->approved_code ,
        );
        if (env('USING_AUTHENTICATE_JOB')){
            ProcessCodeRegister::dispatch($data);
        }else{
            try {
                GhasedakFacade::SendSimple($this->username, $message . $this->temporaryUser->approved_code, env('GHASEDAKAPI_NUMBER'));

            }catch(\Ghasedak\Exceptions\ApiException $e){
                Log::channel('stack')->error($e->errorMessage());
            }
        }
    }

    public function render()
    {
        $logo = Setting::where('title' , 'logo')->pluck('value')->first();
        $favicon = Setting::where('title' , 'favicon')->pluck('value')->first();
        return view('livewire.home.login.index' , compact('logo'))->layout('layouts.login' , ['favicon' => $favicon]);
    }
}
