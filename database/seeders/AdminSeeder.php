<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $users =[
        //         'name' => "admin",
        //         'email' => "admin@admin.com",
        //         'password' => Hash::make('admin'),
        //         'created_at' => new DateTime,
        //         'updated_at' => new DateTime,
        //     ];

        $user_role = [
                [
                    'GenEntityID' => 5,
                    'role_id' => 1,
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ],
                [
                    'GenEntityID' => 8,
                    'role_id' => 2,
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ],
                [
                    'GenEntityID' => 9,
                    'role_id' => 2,
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ],               
                [
                    'GenEntityID' => 10,
                    'role_id' => 3,
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ],                
                [
                    'GenEntityID' => 11,
                    'role_id' => 3,
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ],                
                [
                    'GenEntityID' => 12,
                    'role_id' => 3,
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ],
                [
                    'GenEntityID' => 14,
                    'role_id' => 3,
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ],
            ];

            // DB::table('users')->insert($users);

            DB::table('user_roles')->insert($user_role);
    }
}
