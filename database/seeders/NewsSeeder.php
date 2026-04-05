<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// 严格匹配你的 news 迁移文件字段
class NewsSeeder extends Seeder
{
    public function run()
    {
        DB::table('news')->insert([
            [
                'title' => '2026年技术部年度规划发布',
                'cover' => '/uploads/news/2026_plan.jpg',
                'content' => '<p>近日，公司技术部发布了2026年度发展规划，重点围绕人工智能、低代码平台、性能优化三大方向展开...</p><p>规划中明确了各部门的核心KPI，算法部将重点攻坚大模型落地，前端部将推进组件库标准化...</p>',
                'author' => '技术总监',
                'is_top' => 1,
                'view_count' => 589,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '实验室新设备采购完成并投入使用',
                'cover' => '/uploads/news/lab_new_device.jpg',
                'content' => '<p>经过两个月的采购流程，实验室新增的高性能计算服务器、数据采集设备已完成部署并投入使用，将大幅提升算法训练效率...</p>',
                'author' => '实验室管理员',
                'is_top' => 0,
                'view_count' => 235,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'title' => '新员工入职培训圆满结束',
                'cover' => null, // 匹配 nullable 字段
                'content' => '<p>本次新员工培训覆盖了公司文化、技术栈、安全规范等内容，共计20名新员工通过考核，将分配至各部门参与项目开发...</p>',
                'author' => '人力资源部',
                'is_top' => 0,
                'view_count' => 178,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
        ]);
    }
}
