<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'first_name'     => 'Admin',
                'last_name'      => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'phone_number'   => 1234567890,
                'role'           => 'Admin',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s')
            ],
        ];

        User::insert($users);
    }
}