<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 按「无依赖→有依赖」顺序执行，避免外键报错
        $this->call([
            UserSeeder::class,//用户表
            DepartmentSeeder::class,//部门表
            LabInfoSeeder::class,//实验室表
            ConfigSeeder::class,//系统配置表
            NewsSeeder::class,//新闻表
            ApplicationSeeder::class,//报名表
        ]);
    }
}
