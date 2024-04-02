<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Departments;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'short_name'         => 'CITE',
                'description'        => 'College of Information Technology Eduction',
                'program_head'       => '',
            ],
            [
                'short_name'         => 'CTE',
                'description'        => 'College of Teacher Education',
                'program_head'       => '',
            ],
            [
                'short_name'         => 'CBM',
                'description'        => 'College of Business Management',
                'program_head'       => '',
            ],
        ];

        foreach ($departments as $key => $value) {
            $departments = Department::firstOrCreate([
                'short_name'         => $value['short_name'],
                'description'        => $value['description'],
                'program_head'       => $value['program_head'],
            ]);
        }
    }
}
