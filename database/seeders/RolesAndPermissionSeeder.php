<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perms = [
            'read-users',
            'update-users',
            'create-users',
            'delete-users',

            'read-courses',
            'update-courses',
            'create-courses',
            'delete-courses',

            'read-licenses',
            'update-licenses',
            'create-licenses',
            'delete-licenses',

            'read-trainees',
            'update-trainees',
            'create-trainees',
            'delete-trainees',

            'read-clients',
            'update-clients',
            'create-clients',
            'delete-clients',

            'read-reports',
            'update-reports',
            'create-reports',
            'delete-reports',

            'read-license-subscription',
            'update-license-subscription',
            'create-license-subscription',
            'delete-license-subscription',

            'read-courses-subscription',
            'update-courses-subscription',
            'create-courses-subscription',
            'delete-courses-subscription',

            'read-invoices',
            'update-invoices',
            'create-invoices',
            'delete-invoices',
            'email-invoices',
            'download-invoices',
            'print-invoices',

            'read-quotations',
            'update-quotations',
            'create-quotations',
            'delete-quotations',
            'email-quotations',
            'download-quotations',
            'print-quotations',

        ];
        foreach($perms as $perm){
            Permission::create(['name' => $perm]);
        }


        Role::create(['name' => 'Super admin']);
        $user = User::where('role','super_admin')->first();
        $user->syncRoles('Super admin');
    }
}
