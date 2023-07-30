<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $customer = Role::create(['name' => 'customer']);

        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'create-room']);
        Permission::create(['name' => 'edit-room']);
        Permission::create(['name' => 'view-room']);
        Permission::create(['name' => 'delete-room']);
        Permission::create(['name' => 'send-email']);

        $admin->givePermissionTo(Permission::all());
        $customer->givePermissionTo('view-room');

        $users = User::all();

        foreach ($users as $user) {
            $user->assignRole('customer');
        }

        $admin1 = User::create([
            'name'      => 'Administrator',
            'email'     => 'admin@email.com',
            'password'  => bcrypt('password')
        ]);

        $customer1 = User::create([
            'name'      => 'Customer',
            'email'     => 'salutanemanuelle@gmail.com',
            'password'  => bcrypt('password')
        ]);

        $admin1->assignRole('admin');
        $customer1->assignRole('customer');
    }
}
