<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DateTime;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => "admin",
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => "supervisor",
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => "employee",
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ];

            DB::table('roles')->insert($roles);
    }
}