<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('members')->insert([
            [
                'document_number' => '0000000',
                'first_name' => 'Admin',
                'last_name' => 'User',
                'career' => 'Admin',
                'phone_number' => '00000000',
                'birth_date' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('users')->insert([
            [
                'username' => 'ADMIN',
                'password' => bcrypt('password'),
                'member_id' => 1,
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
