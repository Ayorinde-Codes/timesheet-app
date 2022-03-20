<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DateTime;
use Illuminate\Support\Facades\DB;

class UserSupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersupervisor = [
            [
                'primary_supervisor' => 8,
                'GenEntityID' => 10,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'primary_supervisor' => 9,
                'GenEntityID' => 11,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'primary_supervisor' => 9,
                'GenEntityID' => 12,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],        
            [
            'primary_supervisor' => 8,
            'GenEntityID' => 14,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
            ],

        ];

        // DB::table('users')->insert($users); 10 11 12 14

        DB::table('user_supervisors')->insert($usersupervisor);
    }
}
