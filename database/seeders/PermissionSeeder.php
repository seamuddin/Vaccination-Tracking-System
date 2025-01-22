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

        // Committee
        $moduleAppCommittee = Module::updateOrCreate(['title' => 'Committee', 'slug'=>Str::slug('committee')]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppCommittee->id,
            'title' => 'Access Committee',
            'slug' => 'app.committee.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppCommittee->id,
            'title' => 'Create Committee',
            'slug' => 'app.committee.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppCommittee->id,
            'title' => 'Edit Committee',
            'slug' => 'app.committee.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppCommittee->id,
            'title' => 'Delete Committee',
            'slug' => 'app.committee.destroy',
        ]);

         // Event
         $moduleAppEvent = Module::updateOrCreate(['title' => 'Event', 'slug'=>Str::slug('event')]);
         Permission::updateOrCreate([
             'module_id' => $moduleAppEvent->id,
             'title' => 'Access Event',
             'slug' => 'app.event.index',
         ]);
         Permission::updateOrCreate([
             'module_id' => $moduleAppEvent->id,
             'title' => 'Create Event',
             'slug' => 'app.event.create',
         ]);
         Permission::updateOrCreate([
             'module_id' => $moduleAppEvent->id,
             'title' => 'Edit Event',
             'slug' => 'app.event.edit',
         ]);
         Permission::updateOrCreate([
             'module_id' => $moduleAppEvent->id,
             'title' => 'Delete Event',
             'slug' => 'app.event.destroy',
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
