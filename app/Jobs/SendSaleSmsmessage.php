<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendSaleSmsmessage implements ShouldQueue
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

        $smsSetting=$this->data['smsText'];
         $number=$this->data['phone'];
         $apiKey=$this->data['apiKey'];
         $apiSecret=$this->data['apiSecret'];
         $sender=$this->data['sender'];
         $url = "http://188.138.41.146:7788/sendtext";
         $text = str_replace(['#CUSTOMER#', '#AMOUNT#', '#COMPANYNAME#'], [$this->data['name'],  $this->data['amount'],  $this->data['company']], $smsSetting);
        $data= array(
        'apikey'=>"$apiKey",
        'secretkey'=>"$apiSecret",
        'callerID'=>" $sender",
        'toUser'=>"$number",
        'messageContent'=>"$text"
        );

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        $p = explode("|",$smsresult);
        $sendstatus = $p[0];
        Log::info($sendstatus);



    }
}
