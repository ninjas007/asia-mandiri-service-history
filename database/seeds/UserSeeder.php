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
                'created_at' => now(),
                'nama_user' => null,
                'alamat_user' => null,
                'nohp_user' => null,
            ],
            [
                'name' => 'Teknisi',
                'email' => 'teknisi@gmail.com',
                'password' => Hash::make('teknisi'),
                'role_id' => 1,
                'is_active' => 1,
                'created_at' => now(),
                'nama_user' => null,
                'alamat_user' => null,
                'nohp_user' => null,
            ],
            [
                'name' => 'Client 1',
                'email' => 'client1@gmail.com',
                'password' => Hash::make('client1'),
                'role_id' => 2,
                'is_active' => 1,
                'created_at' => now(),
                'nama_user' => 'Indomaret 3',
                'alamat_user' => 'Jln. Menuju Langit Biru 2',
                'nohp_user' => '222222222',
            ],
            [
                'name' => 'Client 2',
                'email' => 'client2@gmail.com',
                'password' => Hash::make('client2'),
                'role_id' => 2,
                'is_active' => 1,
                'created_at' => now(),
                'nama_user' => 'Bank BRI',
                'alamat_user' => 'Jln. bank bri',
                'nohp_user' => '3434311111',
            ],
            [
                'name' => 'Client 3',
                'email' => 'client3@gmail.com',
                'password' => Hash::make('client3'),
                'role_id' => 2,
                'is_active' => 1,
                'created_at' => now(),
                'nama_user' => 'Indo Maret',
                'alamat_user' => 'Jln. indomaret',
                'nohp_user' => '3434311111232',
            ],
        ];

        User::insert($data);
    }
}
