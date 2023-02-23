<?php

use App\TransactionStatus;
use Illuminate\Database\Seeder;

class TransactionStatusSeeder extends Seeder
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
                'nama' => 'PENGERJAAN',
                'created_at' => now(),
            ],
            [
                'nama' => 'SELESAI',
                'created_at' => now(),
            ]
        ];

        TransactionStatus::insert($data);
    }
}
