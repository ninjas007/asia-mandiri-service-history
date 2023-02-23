<?php

use App\TemplateForm;
use Illuminate\Database\Seeder;

class TemplateFormSeeder extends Seeder
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
                'nama_form' => 'Service AC',
                'value_form' => json_encode([
                    [
                        'name' => 'no',
                        'type' => 'text',
                        'is_parent' => 0
                    ],
                    [
                        'name' => 'merk/type_ac',
                        'type' => 'text',
                        'is_parent' => 0
                    ],
                    [
                        'name' => 'pk',
                        'type' => 'text',
                        'is_parent' => 0
                    ],
                    [
                        'name' => 'freon',
                        'type' => 'text',
                        'is_parent' => 0
                    ],
                    [
                        'name' => 'ampere',
                        'type' => 'text',
                        'is_parent' => 0
                    ],
                    [
                        'name' => 'kompresor',
                        'type' => 'radio',
                        'is_parent' => 1,
                        'childs' => [
                            [
                                'type' => 'radio',
                                'name' => 'baik'
                            ],
                            [
                                'type' => 'radio',
                                'name' => 'kurang'
                            ],
                        ]
                    ],
                    [
                        'name' => 'condensor',
                        'type' => 'radio',
                        'is_parent' => 1,
                        'childs' => [
                            [
                                'type' => 'radio',
                                'name' => 'baik'
                            ],
                            [
                                'type' => 'radio',
                                'name' => 'kurang'
                            ],
                        ]
                    ],
                    [
                        'name' => 'motor_fan',
                        'type' => 'radio',
                        'is_parent' => 1,
                        'childs' => [
                            [
                                'type' => 'radio',
                                'name' => 'baik'
                            ],
                            [
                                'type' => 'radio',
                                'name' => 'kurang'
                            ],
                        ]
                    ],
                    [
                        'name' => 'evoprator',
                        'type' => 'radio',
                        'is_parent' => 1,
                        'childs' => [
                            [
                                'type' => 'radio',
                                'name' => 'baik'
                            ],
                            [
                                'type' => 'radio',
                                'name' => 'kurang'
                            ],
                        ]
                    ],
                    [
                        'name' => 'motor_blower',
                        'type' => 'radio',
                        'is_parent' => 1,
                        'childs' => [
                            [
                                'type' => 'radio',
                                'name' => 'baik'
                            ],
                            [
                                'type' => 'radio',
                                'name' => 'kurang'
                            ],
                        ]
                    ],
                    [
                        'name' => 'capasitor',
                        'type' => 'radio',
                        'is_parent' => 1,
                        'childs' => [
                            [
                                'type' => 'radio',
                                'name' => 'baik'
                            ],
                            [
                                'type' => 'radio',
                                'name' => 'kurang'
                            ],
                        ]
                    ],
                    [
                        'name' => 'pipa_drainase',
                        'type' => 'radio',
                        'is_parent' => 1,
                        'childs' => [
                            [
                                'type' => 'radio',
                                'name' => 'baik'
                            ],
                            [
                                'type' => 'radio',
                                'name' => 'kurang'
                            ],
                        ]
                    ],
                    [
                        'name' => 'kelistrikan',
                        'type' => 'text',
                        'is_parent' => 0
                    ],
                    [
                        'name' => 'keterangan',
                        'type' => 'textarea',
                        'is_parent' => 0
                    ],
                    [
                        'name' => 'action',
                        'type' => 'button',
                        'is_parent' => 0
                    ],
                ])
            ],
        ];

        TemplateForm::insert($data);
    }
}
