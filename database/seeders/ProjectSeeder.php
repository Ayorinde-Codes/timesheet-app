<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DateTime;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [
            [
                'name' => "CDC/PEPFAR/GH1753",
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => "PHIS3",
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => "APIN LIAISON",
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => "NEST",
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ];

            DB::table('projects')->insert($projects);
    }
}
