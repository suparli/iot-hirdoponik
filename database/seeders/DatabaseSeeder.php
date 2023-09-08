<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Device::create([
            'id' => 1,
            'name' => 'Hidroponik 1',
            'key' => 'asdasdasd',
           
        ]
        );
        \App\Models\Device::create([
            'id' => 2,
            'name' => 'Hidroponik 2',
            'key' => 'asdasdasd2',
        ]
        );

        \App\Models\Kontrol::create([
            'device_id' => 1,
            'interval' => '10',
            'pompa_ph' => true,
            'pompa_ec' => true,
            'ba_ph' => '14.0',
            'bb_ph' => '12.0',
            'ba_ec' => '14.0',
            'bb_ec' => '12.0',
            'device_time' => '2023-09-05 11:43',
        ]);

        \App\Models\Logging::create([
            'device_id' => 1,
            'device_time' => '2023-09-05 11:43',
            'water_level' => '13',
            'pompa_ph' => true,
            'pompa_ec' => true,
            'temperature' => '28.0',
            'humidity' => '100',
            'ph' => '14.0',
            'ec' => '12.0',
            'tds' => '12.0',
            'water_temp' => '29.0',
        ]);

        \App\Models\Kontrol::create([
            'device_id' => 2,
            'interval' => '10',
            'pompa_ph' => true,
            'pompa_ec' => true,
            'ba_ph' => '14.0',
            'bb_ph' => '12.0',
            'ba_ec' => '14.0',
            'bb_ec' => '12.0',
            'device_time' => '2023-09-05 11:43',
        ]);

        \App\Models\Logging::create([
            'device_id' => 2,
            'device_time' => '2023-09-05 11:43',
            'water_level' => '102',
            'pompa_ph' => true,
            'pompa_ec' => true,
            'temperature' => '29.0',
            'humidity' => '100',
            'ph' => '14.0',
            'ec' => '12.0',
            'tds' => '12.0',
            'water_temp' => '29.0',
        ]);
    }
}
