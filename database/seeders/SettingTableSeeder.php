<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = Setting::latest()->first();
        if (is_null($setting)) {
            $setting = new Setting();
            $setting->superadmin_id = '1';
            $setting->company_name = 'SohiBD Soft LTD';
            $setting->project_name = 'Shop Management';
            $setting->website_name = 'Shop Sohibd';
            $setting->website_title = 'Shop Sohibd software';
            $setting->phone = '(281) 809-0090';
            $setting->email = 'info@sohibd.com';
            $setting->address = '30 Commercial Road Mirpur, Dhaka';
            $setting->favicon = 'uploads/setting/default.png';
            $setting->logo = 'uploads/setting/default.png';
            $setting->currency_name = 'BDT';
            $setting->currency_symbole = '৳';
            $setting->refer_amount =500;
            $setting->bin_number = '125487456545552';
            $setting->vat_number = '12548';
            $setting->print_headline = 'Shop POS  Software';
            $setting->printing_logo = 'printlogo.jpg';
            $setting->print_message = 'Thanks to use Shop Management software';
            $setting->facebook = '#';
            $setting->youtube = '#';
            $setting->twitter = '#';
            $setting->instagram = '#';
           $setting->save();
        }
    }
}
