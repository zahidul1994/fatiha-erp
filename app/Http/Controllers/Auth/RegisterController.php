<?php

namespace App\Http\Controllers\Auth;
use App\Models\ProspectiveCustomer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
   
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:prospective_customers'],
            'phone' => ['required', 'min:8','max:68', 'unique:prospective_customers'],

        ]);
    }


    protected function create(array $data)
    {

       $customer=new ProspectiveCustomer();
       $customer->name=$data['name'];
       $customer->phone=$data['phone'];
       $customer->email=$data['email'];
       $customer->address=$data['address'];
       $customer->refer_code=$data['refer_code'];
       $customer->save();
        Toastr::success("Customer Register  Successfully", "Success");
        return redirect()->to('register');
    }


}
