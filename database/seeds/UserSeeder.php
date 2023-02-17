<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'role_id' => 0,
                'is_active' => 1,
                'created_at' => now()
            ],
            [
                'name' => 'Teknisi',
                'email' => 'teknisi@gmail.com',
                'password' => Hash::make('teknisi'),
                'role_id' => 1,
                'is_active' => 1,
                'created_at' => now()
            ],
            [
                'name' => 'Client 1',
                'email' => 'client1@gmail.com',
                'password' => Hash::make('client1'),
                'role_id' => 2,
                'is_active' => 1,
                'created_at' => now()
            ],
            [
                'name' => 'Client 2',
                'email' => 'client2@gmail.com',
                'password' => Hash::make('client2'),
                'role_id' => 2,
                'is_active' => 1,
                'created_at' => now()
            ],
        ];

        User::insert($data);
    }
}
