<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
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
                'nama' => 'Admin',
                'created_at' => now()
            ],
            [
                'nama' => 'Teknisi',
                'created_at' => now()
            ],
            [
                'nama' => 'Client',
                'created_at' => now()
            ]
        ];

        Role::insert($data);
    }
}
