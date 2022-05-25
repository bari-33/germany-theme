<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=Role::create([
            'name'=>'Admin',
                'slug'=>'admin',
                'permissions'=>json_encode([
                    'admin'=> true,
                ])
            ]
        );
        $employee=Role::create(
           [
               'name'=>'Employee',
               'slug'=>'employee',
               'permissions'=>json_encode([
                   'employee'=> true,
               ])
           ]
        );

        $customer=Role::create(
            [
                'name'=>'Customer',
                'slug'=>'customer',
                'permissions'=>json_encode([
                    'customer'=> true,
                ])
            ]
        );

    }
}
