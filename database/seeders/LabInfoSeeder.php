<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabInfoSeeder extends Seeder
{
    public function run()
    {
        DB::table('lab_info')->insert([
            [
                'name' => '人工智能算法实验室',
                'desc' => '聚焦计算机视觉、自然语言处理、推荐系统等方向的算法研究与落地，配备高性能GPU服务器集群，支撑公司核心算法研发',
                'address' => '研发中心A栋5层501-508室',
                'contact' => '李工 13800138000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '软件工程实验室',
                'desc' => '专注于软件架构设计、性能优化、自动化测试等方向，负责公司核心业务系统的技术攻坚与架构升级',
                'address' => '研发中心B栋3层305-310室',
                'contact' => '王工 13900139000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
