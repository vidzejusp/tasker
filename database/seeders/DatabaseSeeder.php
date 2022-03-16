<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Relation;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Company::create([
           'name' => 'UAB "BT Logistics"',
           'prefix' => 'btlog',
           'owner' => 1,
        ]);
        Company::create([
           'name' => 'UAB "Bonsa"',
           'prefix' => 'bonsa',
           'owner' => 1,
        ]);
        Company::create([
           'name' => 'UAB "Storas katinas"',
           'prefix' => 'storas',
           'owner' => 1,
        ]);

        Relation::create([
            'user_id' => 1,
            'company_id' => 1001,
            'role' => 'admin'
        ]);
        Relation::create([
            'user_id' => 1,
            'company_id' => 1002,
            'role' => 'admin'
        ]);
        Relation::create([
            'user_id' => 1,
            'company_id' => 1003,
            'role' => 'admin'
        ]);

        User::create([
            'username' => 'vidzejus',
            'name' => 'Vidžėjus Petrošius',
            'current_company' => 1001,
            'current_employee' => 0,
            'password' => Hash::make('slaptazod123'),
        ]);

        $roles = ['admin', 'manager', 'employee', 'global_admin'];
        foreach($roles as $data)
        {
            Role::create([
                'name' => $data,
            ]);
        }

        $permissions = [
            'task view', 'task update', 'task edit', 'task delete',
            'users view', 'users edit', 'users delete',
            'logs view', 'company edit',
            'permissions view', 'permissions create', 'permissions edit', 'permissions delete',
            'companies view', 'companies create', 'companies edit', 'companies delete',
            'notes view', 'notes create', 'notes edit', 'notes delete',
        ];
        foreach($permissions as $data) {
            $permission = Permission::create([
                'name' => $data
            ]);

            switch($data)
            {
                case 'task view':case 'task update':case 'notes view':
                    $permission->assignRole('admin');
                    $permission->assignRole('manager');
                    $permission->assignRole('employee');
                    break;
                case 'task edit':case 'task delete':case 'notes create':case 'notes edit':case 'notes delete':
                    $permission->assignRole('admin');
                    $permission->assignRole('manager');
                    break;
                case 'users view':case 'users edit':case 'users delete':case 'logs view':case 'company edit':
                    $permission->assignRole('admin');
                    break;
                case 'permissions view':case 'permissions create':case 'permissions edit':case 'permissions delete':
                case 'companies view':case 'companies create':case 'companies edit':case 'companies delete':
                    $permission->assignRole('global_admin');
                    break;

            }
        }
//        for($j = 1001; $j < 1004; $j++)
//        {
//            for($i = 1; $i <= 10; $i++)
//            {
//                Task::create([
//                    'name' => 'Bandymas'.$i,
//                    'user_id' => 1,
//                    'company_id' => $j,
//                    'details' => 'Bandymas',
//                    'date_start' => '2021-11-15 16:00',
//                    'date_finish' => '2021-11-18 16:00',
//                    'location' => 'Taurage',
//                    'created_by' => 1,
//                ]);
//            }
//        }

        $user = User::find(1);
        $user->assignRole('global_admin');
    }
}
