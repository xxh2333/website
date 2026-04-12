<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    public function run()
    {
        DB::table('news')->truncate();

        DB::table('news')->insert([
            [
                'title' => '2026年技术部年度规划发布',
                'cover' => '/uploads/news/2026_plan.jpg',
                'content' => '<p>近日，公司技术部发布了2026年度发展规划...</p>',
                'author' => '技术总监',
                'is_top' => 1,
                'view_count' => 589,
                'status' => 1, // ✅ 必须加！控制器在查这个！
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '实验室新设备采购完成并投入使用',
                'cover' => '/uploads/news/lab_new_device.jpg',
                'content' => '<p>经过两个月的采购流程...</p>',
                'author' => '实验室管理员',
                'is_top' => 0,
                'view_count' => 235,
                'status' => 1, // ✅ 必须加！
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'title' => '新员工入职培训圆满结束',
                'cover' => null,
                'content' => '<p>本次新员工培训覆盖了公司文化...</p>',
                'author' => '人力资源部',
                'is_top' => 0,
                'view_count' => 178,
                'status' => 1, // ✅ 必须加！
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
        ]);
    }
}
