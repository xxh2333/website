<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 按「无依赖→有依赖」顺序执行，避免外键报错
        $this->call([
            UserSeeder::class,        // 用户表（无依赖）
            DepartmentSeeder::class,  // 部门表（无依赖）
            LabInfoSeeder::class,     // 实验室表（无依赖）
            ConfigSeeder::class,      // 系统配置表（无依赖）
            NewsSeeder::class,        // 新闻表（无依赖）
            ApplicationSeeder::class, // 报名表（依赖用户/部门表，最后执行）
        ]);
    }
}
