<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->truncate();//清空表
        DB::table('users')->insert([
            [
                // Laravel 默认字段
                'name' => '管理员',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
                // 新增业务字段（管理员无学号/手机号，设为null）
                'student_id' => null,
                'phone' => null,
                'avatar' => null,
            ],
            [
                // Laravel 默认字段
                'name' => '测试用户',
                'email' => 'test@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
                // 新增业务字段（测试学员的学号/手机号）
                'student_id' => '2023001',
                'phone' => '13800138000',
                'avatar' => asset('images/avatar/default.jpg'), // 替换为实际路径
            ],
        ]);
    }
}
