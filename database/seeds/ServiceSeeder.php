<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
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
                'nama_layanan' => 'Servis AC',
                'slug' => 'service-ac',
                'template_form_id' => 1
            ],
            [
                'nama_layanan' => 'Servis Komputer',
                'slug' => 'service-komputer',
                'template_form_id' => 2
            ]
        ];

        Service::insert($data);
    }
}
