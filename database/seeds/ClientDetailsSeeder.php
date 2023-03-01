<?php

use App\ClientDetail;
use Illuminate\Database\Seeder;

class ClientDetailsSeeder extends Seeder
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
                'nama' => 'Indomaret',
                'alamat' => 'Jln. Panjang Menuju Langit Biru',
                'no_hp' => '082334343434',
                'user_id' => 3, // user id
                'created_at' => now()
            ],
            [
                'nama' => 'Indomaret 2',
                'alamat' => 'Jln. Panjang Menuju Langit Biru 2',
                'no_hp' => '082334343434',
                'user_id' => 3, // user id
                'created_at' => now()
            ],
            [
                'nama' => 'Indomaret 3',
                'alamat' => 'Jln. Panjang Menuju Langit Biru 3',
                'no_hp' => '082334343434',
                'user_id' => 3, // user dengan id ini punya 3 outlet
                'created_at' => now()
            ],
            [
                'nama' => 'Bank BRI',
                'alamat' => 'Jln. Menuju Kebenaran',
                'no_hp' => '111111111111',
                'user_id' => 4, // client id
                'created_at' => now()
            ],
        ];

        ClientDetail::insert($data);
    }
}
