<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Modules\User\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admin office user
        $user = User::where('email', 'admin@gmail.com')->first();

        if ($user) {
            // Delete the existing admin user
            $user->delete();
        }

        // Create admin user
        User::updateOrCreate([
            'user_type' => 'A-1001',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'), // You can change this to a more secure password
            'role_id' => Role::where('slug', 'admin')->first()->id,
            'status' => true
        ]);

        // Create manager user
        // $manager = User::where('email', 'manager@gmail.com')->first();

        // if ($manager) {
        //     // Delete the existing manager user
        //     $manager->delete();
        // }

        // // Create manager user
        // User::updateOrCreate([
        //     'user_type' => 'M-1001',
        //     'name' => 'Manager',
        //     'email' => 'manager@gmail.com',
        //     'password' => Hash::make('manager123'), // Again, consider using a more secure password
        //     'role_id' => Role::where('slug', 'manager')->first()->id,
        //     'status' => true
        // ]);
    }
}
