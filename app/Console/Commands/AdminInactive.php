<?php

namespace App\Console\Commands;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\Sendmail;
use App\Models\Wallet;
use App\Helpers\Helper;
use App\Jobs\SendSmsmessage;
use App\Models\Package;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Notifications\Usernotification;

class AdminInactive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'work:adminInactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Admin And his all user deactive command';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users =  User::whereuser_type('Admin')->whereaccount_expire_date(date('Y-m-d'))->wherestatus(1)->get(['id', 'package_id', 'name', 'phone', 'email', 'account_expire_date', 'status']);
        foreach ($users as $user) {
           $package=Package::find($user->package_id);
           $checkBalance=(Helper::getadminBlance($user->id)->where('status',1)->sum('credit'))-Helper::getadminBlance($user->id)->where('status',1)->sum('debit');
            if($checkBalance>$package->price){
            $days=$checkBalance/$package->price;
            $newDate=Carbon::create($user->account_expire_date)->addDays($days)->format("Y-m-d");
            $userInfo=User::find($user->id);
            $userInfo->account_expire_date=$newDate;
            $userInfo->save();

            $cashpayment = new Wallet();
            $cashpayment->admin_id = $userInfo->id;
            $cashpayment->debit = $checkBalance;
            $cashpayment->payment_id =1;
            $cashpayment->type = 'receive';
            $cashpayment->superadmin_id =1;
            $cashpayment->created_user_id =1;
            $cashpayment->updated_user_id = 1;
            $cashpayment->status =  1;
            $cashpayment->note = "auto update payment";
            $cashpayment->save();
            $data = [
                'message' => 'Hi ' . $userInfo->name . ' . Your Account Expire date update to '.$newDate ,

            ];
            $userInfo->notify(new Usernotification($data));
            $smsdata = [
                'message' => 'Your Account Expire date update to '.$newDate. ' Biz Born IT' ,
                'name' => $userInfo->name,
                'phone' => $userInfo->phone,
            ];

            SendSmsmessage::dispatch($smsdata);
            }
            else{

                User::whereIn('admin_id', [$user->id])->wherestatus(1)->update(['status' => 0]);
                $data = array(
                    'subject' => 'Account De active',
                    'name' => $user->name,
                    'email' => $user->email,
                    'message' => 'Your Account was De Active for Inefficient Balance.If You Want Active Contact  Biz Born IT  Support Team',
                );
                User::whereid($user->id)->update(['status' => 0]);
                Mail::to($user->email)->send(new SendMail($data));
            }
   
           
        }
        // Log::info($users);
        $this->info('User De Active Command  Done');
    }
}
