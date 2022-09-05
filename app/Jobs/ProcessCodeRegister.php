<?php

namespace App\Jobs;

use Ghasedak\Laravel\GhasedakFacade;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessCodeRegister implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            GhasedakFacade::SendSimple($this->data['number'], 'کد احراز هویت شما :' . $this->data['code'], env('GHASEDAKAPI_NUMBER'));

        }
        catch(\Ghasedak\Exceptions\ApiException $e){
            Log::channel('stack')->error($e->errorMessage());
        }
    }
}
