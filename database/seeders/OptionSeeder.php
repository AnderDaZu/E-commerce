<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            [
                'name' => 'Talla',
                'type' => 1,
                'features' => 
                [
                    [
                        'value' => 'xs',
                        'description' => 'extra small',
                    ],
                    [
                        'value' => 's',
                        'description' => 'small',
                    ],
                    [
                        'value' => 'm',
                        'description' => 'medium',
                    ],
                    [
                        'value' => 'l',
                        'description' => 'large',
                    ],
                    [
                        'value' => 'xl',
                        'description' => 'extra large',
                    ],
                    [
                        'value' => 'xxl',
                        'description' => 'extra extra large',
                    ]
                ]
            ],
            [
                'name' => 'Color',
                'type' => 2,
                'features' => 
                [
                    [
                        'value' => '#000',
                        'description' => 'black',
                    ],
                    [
                        'value' => '#fff',
                        'description' => 'white',
                    ],
                    [
                        'value' => '#f00',
                        'description' => 'red',
                    ],
                    [
                        'value' => '#0f0',
                        'description' => 'green',
                    ],
                    [
                        'value' => '#00f',
                        'description' => 'blue',
                    ],
                    [
                        'value' => '#ff0',
                        'description' => 'yellow',
                    ],
                    [
                        'value' => '#0ff',
                        'description' => 'cyan',
                    ],
                    [
                        'value' => '#f0f',
                        'description' => 'magenta',
                    ],
                    [
                        'value' => '#999',
                        'description' => 'gray',
                    ],
                    [
                        'value' => '#333',
                        'description' => 'brown',
                    ],
                    [
                        'value' => '#666',
                        'description' => 'purple',
                    ],
                    [
                        'value' => '#ccc',
                        'description' => 'gold',
                    ],
                    [
                        'value' => '#eee',
                        'description' => 'silver',
                    ],
                ],
            ],
            [
                'name' => 'Sexo',
                'type' => 1,
                'features' =>
                [
                    [
                        'value' => 'm',
                        'description' => 'masculino',
                    ],
                    [
                        'value' => 'f',
                        'description' => 'femenino',
                    ],
                    [
                        'value' => 'u',
                        'description' => 'unisex',
                    ],
                ]
            ],
        ];

        foreach ($options as $option) {
            $optionNew = Option::create([
                'name' => $option['name'],
                'type' => $option['type'],
            ]);

            foreach ($option['features'] as $feature) {
                $optionNew->features()->create([
                    'value' => $feature['value'],
                    'description' => $feature['description'],
                ]);
            }
        }
    }
}
