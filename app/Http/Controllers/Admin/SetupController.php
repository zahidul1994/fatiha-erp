<?php

namespace App\Http\Controllers\Admin;
use App\Models\Setup;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;

class SetupController extends Controller
{
    private $User;
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->User = Auth::user();
            if ($this->User->status == 0) {
                $request->session()->flush();
                return redirect('login');
            }
            return $next($request);
        });


    }


    public function businessSetup()
    {
        try {
            $User = $this->User;
            if ($User->user_type == 'Admin') {
               $setup = Setup::whereadmin_id(Auth::id())->firstOrFail();
            }else{
                Toastr::success('sorry you can not view', 'Success');
                return back();
            }
            return view('backend.admin.setting.setup',compact('setup'));
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    public function businessSetupUpdate(Request $request)
    {
        $this->validate(
            $request,
            [
                'company_name' => 'required|min:1|max:290',
                'sms_status' => 'required|min:1|max:290',
                'sms_text' => 'required|min:1|max:300',
                'currency_name' => 'required|min:1|max:300',
                'currency_icon' => 'required|min:1|max:300',
                'print_first_note' => 'required|min:1|max:300',

            ]
        );

        if ($request->hasFile('printing_logo')) {
            $this->validate($request, [
                'printing_logo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:500',

            ]);

        }
         try {
             DB::beginTransaction();
             $setting = Setup::whereadmin_id(Auth::id())->firstOrFail();
             if ($request->hasFile('printing_logo')) {
             if (!is_dir(storage_path() . "/app/public/files/shares/uploads/" .  Auth::id() . "/thumbs/")) {
                mkdir(storage_path() .  "/app/public/files/shares/uploads/" .  Auth::id() . "/thumbs/", 0777, true);
            }

            $ex = $request->printing_logo->extension();
            $rand = uniqid();
            $name = $rand . "." . $ex;
            $request->printing_logo->move(storage_path('/app/public/files/shares/uploads/' .  Auth::id()), $name, 60);

            $resizedImage_thumbs = Image::make(storage_path() . '/app/public/files/shares/uploads/' .  Auth::id() . '/' . $name)->resize(35, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $resizedImage_thumbs->save(storage_path() . '/app/public/files/shares/uploads/' .  Auth::id() . '/thumbs/' . $name, 60);
            $setting->printing_logo = 'storage/files/shares/uploads/' .  Auth::id().'/'. $name;
        }
             if ($request->hasFile('company_logo')) {
             if (!is_dir(storage_path() . "/app/public/files/shares/uploads/" .  Auth::id() . "/thumbs/")) {
                mkdir(storage_path() .  "/app/public/files/shares/uploads/" .  Auth::id() . "/thumbs/", 0777, true);
            }

            $ex = $request->company_logo->extension();
            $rand = uniqid();
            $name = $rand . "." . $ex;
            $request->company_logo->move(storage_path('/app/public/files/shares/uploads/' .  Auth::id()), $name, 60);

            $resizedImage_thumbs = Image::make(storage_path() . '/app/public/files/shares/uploads/' .  Auth::id() . '/' . $name)->resize(35, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $resizedImage_thumbs->save(storage_path() . '/app/public/files/shares/uploads/' .  Auth::id() . '/thumbs/' . $name, 60);
            $setting->company_logo = 'storage/files/shares/uploads/' .  Auth::id().'/'. $name;
        }
            $setting->company_name = $request->company_name;
            $setting->owner_name = $request->owner_name;
            $setting->web_address = $request->web_address;
            $setting->default_shop_id = $request->default_shop_id;
            $setting->default_customer_id = $request->default_customer_id;
            $setting->default_brand_id = $request->default_brand_id;
            $setting->default_unit = $request->default_unit;
            $setting->default_vat = $request->default_vat;
            $setting->default_discount = $request->default_discount;
            $setting->default_supplier_id = $request->default_supplier_id;
            $setting->default_converted_rate = $request->default_converted_rate;
            $setting->sms_status = $request->sms_status;
            $setting->sms_text = $request->sms_text;
            $setting->bin_number = $request->bin_number;
            $setting->vat_number = $request->vat_number;
            $setting->currency_name = $request->currency_name;
            $setting->currency_icon = $request->currency_icon;
            $setting->print_first_note = $request->print_first_note;
            $setting->print_second_note = $request->print_second_note;
            $setting->office_phone = $request->office_phone;
            $setting->office_email = $request->office_email;
            $setting->company_address = $request->company_address;
            $setting->facebook = $request->facebook;
            $setting->twitter = $request->twitter;
            $setting->youtube = $request->youtube;
            $setting->instagram = $request->instagram;
            $setting->description = $request->description;
            $setting->save();
             DB::commit();
            Toastr::success('Setup Update Successfully', 'Success');
            return redirect()->route(request()->segment(1) . '.businessSetup');
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false,500,'Internal Server Error.',null);
            Toastr::error($response['message'], 'Error');
            return back();
        }
    }

}
