<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabInfoSeeder extends Seeder
{
    public function run()
    {
        // 清空labs表（迁移已将lab_info重命名为labs，字段同步为desc）
        DB::table('labs')->truncate();

        // 关键修正：将intro改为迁移表中的desc字段，匹配表结构
        DB::table('labs')->insert([
            [
                'name' => '人工智能实验室',
                'desc' => '专注于机器学习、计算机视觉等方向的研究', // 替换intro为desc
                'address' => '科研楼A座501',
                'contact' => '张老师 13800138000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '软件开发实验室',
                'desc' => '专注于Web开发、移动端开发等工程化实践', // 替换intro为desc
                'address' => '科研楼B座302',
                'contact' => '李老师 13900139000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
