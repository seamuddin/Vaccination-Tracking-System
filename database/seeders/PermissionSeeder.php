<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         // User management
         $moduleAppUser = Module::updateOrCreate(['title' => 'User', 'slug'=>Str::slug('user')]);
         Permission::updateOrCreate([
             'module_id' => $moduleAppUser->id,
             'title' => 'Access User',
             'slug' => 'app.users.index',
         ]);
         Permission::updateOrCreate([
             'module_id' => $moduleAppUser->id,
             'title' => 'Create User',
             'slug' => 'app.users.create',
         ]);
         Permission::updateOrCreate([
             'module_id' => $moduleAppUser->id,
             'title' => 'Edit User',
             'slug' => 'app.users.edit',
         ]);
         Permission::updateOrCreate([
             'module_id' => $moduleAppUser->id,
             'title' => 'Delete User',
             'slug' => 'app.users.destroy',
         ]);


         $moduleAppChild = Module::updateOrCreate(['title' => 'Child', 'slug'=>Str::slug('child')]);
         Permission::updateOrCreate([
             'module_id' => $moduleAppChild->id,
             'title' => 'Access Child',
             'slug' => 'app.child.index',
         ]);
         Permission::updateOrCreate([
             'module_id' => $moduleAppChild->id,
             'title' => 'Create Child',
             'slug' => 'app.child.create',
         ]);
         Permission::updateOrCreate([
             'module_id' => $moduleAppChild->id,
             'title' => 'Edit Child',
             'slug' => 'app.child.edit',
         ]);
         Permission::updateOrCreate([
             'module_id' => $moduleAppChild->id,
             'title' => 'Delete Child',
             'slug' => 'app.child.destroy',
         ]);


         $moduleAppVaccine = Module::updateOrCreate(['title' => 'Vaccine', 'slug'=>Str::slug('vaccine')]);
         Permission::updateOrCreate([
             'module_id' => $moduleAppVaccine->id,
             'title' => 'Access Vaccine',
             'slug' => 'app.vaccine.index',
         ]);
         Permission::updateOrCreate([
             'module_id' => $moduleAppVaccine->id,
             'title' => 'Create Vaccine',
             'slug' => 'app.vaccine.create',
         ]);
         Permission::updateOrCreate([
             'module_id' => $moduleAppVaccine->id,
             'title' => 'Edit Vaccine',
             'slug' => 'app.vaccine.edit',
         ]);
         Permission::updateOrCreate([
             'module_id' => $moduleAppVaccine->id,
             'title' => 'Delete Vaccine',
             'slug' => 'app.vaccine.destroy',
         ]);

        

        // User Permission
        $moduleAppUserPermission = Module::updateOrCreate(['title' => 'User Permission', 'slug'=>Str::slug('user_permission')]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUserPermission->id,
            'title' => 'View User Permissions',
            'slug' => 'app.user_permission.index',
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppUserPermission->id,
            'title' => 'Update User Permissions',
            'slug' => 'app.user_permission.update',
        ]);

    }
}
