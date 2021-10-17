<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $adminRole = Role::create([
            'name' => 'admin',
            'display_name' => 'Administration',
            'description' => 'Administrator',
            'allowed_route' => 'admin',
        ]);

        $supervisorRole = Role::create([
            'name' => 'supervisor',
            'display_name' => 'Supervisor',
            'description' => 'Supervisor',
            'allowed_route' => 'admin',
        ]);

        $customerRole = Role::create([
            'name' => 'customer',
            'display_name' => 'Customer',
            'description' => 'Customer',
            'allowed_route' => null,
        ]);

        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'System',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'mobile' => '00112233445',
            'password' => bcrypt('123456'),
            'user_image' => 'avatar.svg',
            'status' => 1,
            'remember_token' => \Str::random(10),
        ]);

        $admin->attachRole($adminRole);

        $supervisor = User::create([
            'first_name' => 'Supervisor',
            'last_name' => 'System',
            'username' => 'supervisor',
            'email' => 'supervisor@supervisor.com',
            'email_verified_at' => now(),
            'mobile' => '00112233446',
            'password' => bcrypt('123456'),
            'user_image' => 'avatar.svg',
            'status' => 1,
            'remember_token' => \Str::random(10),
        ]);

        $supervisor->attachRole($supervisorRole);


        for ($i = 1; $i <= 20; $i++) {
            $randomCustomer = User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'username' => $faker->userName,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'mobile' => '0102' . $faker->numberBetween(1000000 , 9999999),
                'password' => bcrypt('123456'),
                'user_image' => 'avatar.svg',
                'status' => 1,
                'remember_token' => \Str::random(10),
            ]);

            $randomCustomer->attachRole($customerRole);
        }


    }
}
