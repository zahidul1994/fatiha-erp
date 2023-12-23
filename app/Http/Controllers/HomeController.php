<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\ProspectiveCustomer;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Session;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        SEOMeta::setRobots('index, follow');
        OpenGraph::addProperty('type', 'website');
        JsonLd::setType('website');
        SEOTools::setTitle('Shop Management Software');
        SEOTools::setDescription('Best Shop Pos Software In Bangladesh. Try For Free');
        SEOMeta::addKeyword('shop');
        OpenGraph::addImage(url(Helper::setting()->logo), ['height' => 315, 'width' => 600]);
        SEOTools::opengraph()->setUrl(url('/'));
        $companies = User::with('setup')->join('profiles', 'profiles.user_id', '=', 'users.id')->select('users.*', 'profiles.rating', 'profiles.comment', 'profiles.country')->whereuser_type('admin')->wherestatus(1)->get();
        $shops = Shop::wherestatus(1)->get(['id']);

        return view("frontend.welcome", compact('companies', 'shops'));
    }

    public function register()
    {
        SEOMeta::setRobots('index, follow');
        OpenGraph::addProperty('type', 'website');
        JsonLd::setType('website');
        SEOTools::setTitle('Register');
        SEOTools::setDescription('Best Shop Pos Software In Bangladesh.Register Now');
        SEOMeta::addKeyword('shop');
        OpenGraph::addImage(url(Helper::setting()->logo), ['height' => 315, 'width' => 600]);
        SEOTools::opengraph()->setUrl(url('/'));


        return view("auth.register");
    }


    public function aboutUs()
    {
        return view("frontend.pages.about_us");
    }
    public function contactStore(Request $request)
    {


        $this->validate($request, [
            'name' => 'required|min:1|max:198',
            'email' => 'required|email|min:5|max:288',
            'message' => 'required|min:3|max:1000',

        ]);
        $userinfo = Contact::whereipaddress($request->ip())->wherestatus(0)->first();
        if (!isset($userinfo)) {
            $list = new Contact();
            $list->name = $request->name;
            $list->email = $request->email;
            $list->subject = $request->subject;
            $list->message = $request->message;
            $list->ipaddress = $request->ip();
            $list->save();
            Session::flash('message', 'Message Sent Successfully!');
            return Redirect::to('/');
        } else {
            Session::flash('message', 'Something went wrong! Please try again !');
            return back();
        }
    }

    public function registerStore(Request $request)
    {


        $this->validate($request, [
            'name' => 'required|min:1|max:198',
            'email' => 'required|email|min:5|max:288|unique:prospective_customers',
            'phone' => 'required|max:60|unique:prospective_customers',

        ]);
        $customer = new ProspectiveCustomer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->refer_code = $request->refer_code;
        $customer->save();
        if ($customer) {
           $info= Http::get("https://api.whatsapp.com/send/?phone=8801912748597text='$request->name'type='$request->phone'&app_absent=0"); 
           Session::flash('message', 'Message Sent Successfully!');
            return Redirect::to('/');
        } else {
            Session::flash('message', 'Something went wrong! Please try again !');
            return back();
        }
    }
}
