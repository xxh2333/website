<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationSeeder extends Seeder
{
    public function run()
    {
        DB::table('applications')->insert([
            [
                'user_id' => 2,
                'department_id' => 1,
                'student_id' => '2025001',
                'resume' => '我想加入开发部',
                'status' => 0,
            ],
            [
                'user_id' => 3,
                'department_id' => 2,
                'student_id' => '2025002',
                'resume' => '我想加入网络部',
                'status' => 1,
            ],
        ]);
    }
}
