<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;
use App\Models\Department;

class ApplicationsTableSeeder extends Seeder
{
    public function run()
    {
        // 获取部门ID
        $softwareDept = Department::where('name', 'like', '%软件开发%')->first();
        $aiDept = Department::where('name', 'like', '%人工智能%')->first();

        $applications = [
            [
                'name' => '张三',
                'student_id' => '2025001001',
                'department_id' => $softwareDept->id ?? 1,
                'phone' => '13800138001',
                'email' => 'zhangsan@example.com',
                'intro' => '热爱编程，熟悉 Laravel 和 Vue.js',
                'status' => 'pending',
            ],
            [
                'name' => '李四',
                'student_id' => '2025001002',
                'department_id' => $aiDept->id ?? 2,
                'phone' => '13800138002',
                'email' => 'lisi@example.com',
                'intro' => '对机器学习有浓厚兴趣，参加过数学建模比赛',
                'status' => 'approved',
            ],
            [
                'name' => '王五',
                'student_id' => '2025001003',
                'department_id' => $softwareDept->id ?? 1,
                'phone' => '13800138003',
                'email' => 'wangwu@example.com',
                'intro' => '全栈开发者，有项目经验',
                'status' => 'rejected',
                'review_comment' => '技术基础有待加强',
            ],
        ];

        foreach ($applications as $app) {
            Application::create($app);
        }

        // 生成更多测试数据
        Application::factory()->count(20)->create();
    }
}
