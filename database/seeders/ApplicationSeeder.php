<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationSeeder extends Seeder
{
    public function run()
    {
        DB::table('applications')->truncate();

        // 直接用固定ID，不再查询部门，避免找不到
        DB::table('applications')->insert([
            [
                'user_id' => 2,
                'department_id' => 1, // 固定1
                'name' => '张三',
                'student_id' => '2025001',
                'phone' => '13800138000',
                'email' => 'zhangsan@test.com',
                'intro' => '自我介绍',
                'resume_path' => '/uploads/resumes/2025001.pdf',
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'department_id' => 2, // 固定2
                'name' => '李四',
                'student_id' => '2025002',
                'phone' => '13900139000',
                'email' => 'lisi@test.com',
                'intro' => '自我介绍',
                'resume_path' => '/uploads/resumes/2025002.pdf',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
