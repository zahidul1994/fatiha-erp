<?php

namespace App\Observers;
use App\Models\Sale;
use App\Helpers\Helper;
use App\Jobs\SendSaleSmsmessage;


class SaleObserver
{
    public function created(Sale $sale)
    {
      $setup=Helper::companySetup();
      if($setup->sms_status==1){
        $data=[
            'smsText'=>$setup->sms_text,
            'apiKey'=>$setup->api_key,
            'apiSecret'=>$setup->api_secret,
            'sender'=>$setup->sender_id,
           'name'=>$sale->customer->customer_name,
           'phone'=>$sale->customer->customer_phone,
           'amount'=>$sale->grand_total,
           'company'=>$setup->company_name
        ];
        SendSaleSmsmessage::dispatch($data);
    }

    }
   

}
