<?php

namespace App\Jobs;

use App\Mail\SendVerificationCodeMail;
use Ghasedak\Laravel\GhasedakFacade;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Mailer\Exception\TransportException;

class SendVerificationCodeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $data ;
    public function __construct($data)
    {
        $this->data = $data ;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (env("AUTHENTICATION_METHOD") === "sms") {
            $message = 'کد احراز هویت شما :' . $this->data['code'];
            try
            {
                GhasedakFacade::SendSimple($this->data['number'], $message, env('GHASEDAKAPI_NUMBER'));
            }catch(\Ghasedak\Exceptions\ApiException $e){
                Log::channel('stack')->error($e->errorMessage());
            }
        }

        elseif (env("AUTHENTICATION_METHOD") == "email") {
            try {
                Mail::send(new SendVerificationCodeMail($this->data));
            }catch (\Exception $e){
                Log::channel('stack')->error($e->getMessage());
                if ($e instanceof  TransportException){
                    Session::flash('error' , "ارسال ایمیل احراز هویت با مشکل رو به رو است بار دیگر تلاش کنید !");
                }
            }
        }
    }
}
