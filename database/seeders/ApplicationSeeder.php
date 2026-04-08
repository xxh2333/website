<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationSeeder extends Seeder
{
    public function run()
    {
        // 清空applications表，避免重复数据
        DB::table('applications')->truncate();

        // 动态获取部门ID（避免固定ID导致外键报错）
        $algorithmDeptId = DB::table('departments')->where('name', '算法部')->value('id');
        $frontendDeptId = DB::table('departments')->where('name', '前端部')->value('id');

        // 仅保留迁移表中存在的字段：user_id/department_id/student_id/resume/status + 时间字段
        DB::table('applications')->insert([
            [
                'user_id' => 2, // 测试用户ID
                'department_id' => $algorithmDeptId,
                'student_id' => '2025001',
                'resume' => '/uploads/resumes/2025001.pdf',
                'status' => 0, // 0=待审核
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'department_id' => $frontendDeptId,
                'student_id' => '2025002',
                'resume' => '/uploads/resumes/2025002.pdf',
                'status' => 1, // 1=审核通过
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
