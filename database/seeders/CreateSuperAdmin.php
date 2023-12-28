<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Setup;
use App\Helpers\Helper;
use App\Models\Profile;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateSuperAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = User::latest()->first();
        if (is_null($info)) {
            $referId = IdGenerator::generate(['table' => 'users', 'field' => 'refer_id', 'length' => 8, 'prefix' => 'Sup', 'reset_on_prefix_change' => true]);
            $superAdmin = new User();
            $superAdmin->name = 'Superadmin';
            $superAdmin->invoice_slug = 'SUP';
            $superAdmin->user_type = 'Superadmin';
            $superAdmin->refer_id = $referId;
            $superAdmin->package_id = '1';
            $superAdmin->phone = '01739898764';
            $superAdmin->email = 'superadmin@gmail.com';
            $superAdmin->password = Hash::make('superadmin1234');
            $superAdmin->created_user_id = '1';
            $superAdmin->updated_user_id = '1';
            $superAdmin->status = '1';
            if ($superAdmin->save()) {
                $profile = new Profile();
                $profile->user_id = 1;
                $profile->gender = 'Male';
                $profile->refer_code = 'shop2023';
                $profile->save();
                $role = Role::create([
                    'name' => 'Superadmin1', 'admin_id' => 1
                ]);
                $superAdmin->assignRole('Superadmin1');
                $permission = Permission::pluck('name');
                $role = Role::wherename('Superadmin1')->first();
                $role->syncPermissions($permission);
            }

            $admin = new User();
            $admin->name = 'Admin';
            $admin->user_type = 'Admin';
            $admin->phone = '01739898766';
            $admin->invoice_slug = 'fat';
            $admin->package_id = 1;
            $admin->email = 'admin@gmail.com';
            $admin->password = Hash::make('admin1234');
            $admin->created_user_id = '1';
            $admin->updated_user_id = '1';
            $admin->status = '1';
            $admin->save();

            $profile = new Profile();
            $profile->user_id = $admin->id;
            $profile->gender = 'Male';
            $profile->save();
            $setup=new Setup();
            $setup->admin_id=$admin->id;
            $setup->company_name = 'Admin';
            $setup->printing_logo='not-found.jpg';
            $setup->company_logo = 'not-found.jpg';
            $setup->web_address = 'sohibd.com';
            $setup->office_phone='01912748597';
            $setup->office_email='admin@gmail.com';
            $setup->company_address='Dhaka';
            $setup->description = 'Ki dor';
            $setup->save();
            $admin->assignRole('Superadmin1');
            $permission = Permission::pluck('name');
            $role = Role::wherename('Superadmin1')->first();
            $role->syncPermissions($permission);
        } else {
            $superAdmin = User::first();
            $superAdmin->assignRole('Superadmin1');
            $permission = Permission::pluck('name');
            $role = Role::wherename('Superadmin1')->first();
            $role->syncPermissions($permission);
        }
    }
}
