<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendSmsmessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $message="Hi ". $this->data['name'].', '. $this->data['message'];
        //  $number=$this->data['phone'];
        // $api ="http://188.138.41.146:7788/sendtext/sendtext?apikey=ddaa07dd33b2607f&secretkey=579ac4e6&callerID=bizbornit&toUser=$number&messageContent=".urlencode($message);
        // $ch = curl_init($api);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //  curl_exec($ch);
        //  curl_close($ch);


    }
}
