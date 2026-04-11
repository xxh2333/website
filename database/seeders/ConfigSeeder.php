<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    public function run()
    {
        DB::table('configs')->truncate();
        DB::table('configs')->insert([
            [
                'key' => 'apply_switch',
                'value' => '1',
                'desc' => '实验室报名开关：1=开启报名，0=关闭报名',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 👇 新增：报名开始时间
            [
                'key' => 'apply_start',
                'value' => '2026-04-01 00:00:00',
                'desc' => '报名开始时间',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 👇 新增：报名结束时间
            [
                'key' => 'apply_end',
                'value' => '2026-04-30 23:59:59',
                'desc' => '报名结束时间',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'lab_audit_days',
                'value' => '3',
                'desc' => '实验室申请审核时效（天）：默认3天内完成审核',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'news_top_limit',
                'value' => '5',
                'desc' => '新闻置顶数量上限：最多同时置顶5条新闻',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'upload_max_size',
                'value' => '10',
                'desc' => '文件上传最大限制（MB）：默认10MB',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
