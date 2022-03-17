<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DateTime;
use Illuminate\Support\Facades\DB;

class AbsenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $absences = [
            [
                'name' => "Annual Leave",
                'description' => "Annual Leave",
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => "Compassionate Leave",
                'description' => "Compassionate Leave",
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => "Disciplinary Absence",
                'description' => "Disciplinary Absence",
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => "Maternity/Paternity Leave",
                'description' => "Maternity/Paternity Leave",
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => "Sick Leave",
                'description' => "Sick Leave",
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => "Statutory Leave (Holidays)",
                'description' => "Statutory Leave (Holidays)",
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ];

            DB::table('absences')->insert($absences);
    }
}
