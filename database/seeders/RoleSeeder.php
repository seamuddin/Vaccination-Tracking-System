<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Modules\UserPermission\Models\Module;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch all permissions and modules
        $admin_permissions = Permission::all();
        $admin_modules = Module::all();

        // Update or create the Admin role
        $admin_role = Role::updateOrCreate(
            ['slug' => 'admin'],
            ['title' => 'Admin', 'deletable' => false]
        );

        // Sync permissions
        $admin_role->permissions()->sync($admin_permissions->pluck('id'));

        // Sync modules
        $admin_role->modules()->sync($admin_modules->pluck('id'));

        Role::updateOrCreate(['title' => 'Admin', 'slug' => 'admin', 'deletable' => false]);
        Role::updateOrCreate(['title' => 'Health Worker', 'slug' => 'health-worker', 'deletable' => false]);
        Role::updateOrCreate(['title' => 'Parent/Guardian', 'slug' => 'parent', 'deletable' => false]);
    }
}
