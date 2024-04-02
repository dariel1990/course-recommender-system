<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'Keyname'   => 'SCHOOL_NAME',
                'Keyvalue'  => 'North Eastern Mindanao State University',
            ],
            [
                'Keyname'   => 'CAMPUS_NAME',
                'Keyvalue'  => 'CANTILAN CAMPUS',
            ],
            [
                'Keyname'   => 'CAMPUS_ADDRESS',
                'Keyvalue'  => 'Pag-antayan, Cantilan, Surigao del Sur',
            ],
            [
                'Keyname'   => 'CAMPUS_DIRECTOR',
                'Keyvalue'  => 'JUANCHO A. INTANO, PH. D.',
            ],
            [
                'Keyname'   => 'CAMPUS_DIRECTOR_POSITION',
                'Keyvalue'  => 'Campus Director',
            ],
            [
                'Keyname'   => 'ASSISTANT_CAMPUS_DIRECTOR',
                'Keyvalue'  => 'ROZETTE E. MERCADO, Ph.D.',
            ],
            [
                'Keyname'   => 'ASSISTANT_CAMPUS_DIRECTOR_POSITION',
                'Keyvalue'  => 'Assistant Campus Director',
            ],
            [
                'Keyname'   => 'EXAM_DURATION',
                'Keyvalue'  => '01:00',
            ],
            [
                'Keyname'   => 'GC',
                'Keyvalue'  => 'MARY GRACE S. CADENAS, RGC',
            ],
            [
                'Keyname'   => 'GC_POSITION',
                'Keyvalue'  => 'Guidance Counselor III',
            ],

        ];

        foreach ($data as $key => $value) {
            Settings::firstOrCreate([
                'Keyname' => $value['Keyname'],
                'Keyvalue' => $value['Keyvalue'],
            ]);
        }
    }
}
