<?php

namespace Database\Seeders;
use App\Models\Package;
use Sohibd\Laravelslug\Generate;
use Illuminate\Database\Seeder;


class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = Package::latest()->first();
        if (is_null($info)) {
            $packagesmall = new Package();
            $packagesmall->package_name = 'Small';
            $packagesmall->superadmin_id = 1;
            $packagesmall->slug = Generate::slug('Small');
            $packagesmall->shop = 1;
            $packagesmall->price = 2;
            $packagesmall->duration = 30;
            $packagesmall->employee_manage = 1;
            $packagesmall->features = json_encode(["Unlimited Product Upload"]);
            $packagesmall->description = "Unlimited Product Upload";
            $packagesmall->save();
        }
    }
}
