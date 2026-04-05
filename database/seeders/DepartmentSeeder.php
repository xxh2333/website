<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// 类名和文件名严格一致：DepartmentSeeder.php → DepartmentSeeder
class DepartmentSeeder extends Seeder
{
    public function run()
    {
        DB::table('departments')->insert([
            [
                'name' => '算法部',
                'desc' => '负责人工智能算法研发、数据分析与模型训练',
                'tech_stack' => json_encode(['Python', 'TensorFlow', 'PyTorch']),
                'sort' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '前端部',
                'desc' => '负责Web前端、移动端H5、小程序等界面开发',
                'tech_stack' => json_encode(['Vue', 'React', 'TypeScript', 'Vite']),
                'sort' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '后端部',
                'desc' => '负责服务端接口开发、数据库设计、业务逻辑实现',
                'tech_stack' => json_encode(['PHP', 'Laravel', 'MySQL', 'Redis']),
                'sort' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '测试部',
                'desc' => '负责软件功能测试S、性能测试、自动化测试',
                'tech_stack' => json_encode(['Jmeter', 'Selenium', 'Postman']),
                'sort' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
