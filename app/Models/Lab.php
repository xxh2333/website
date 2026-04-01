<?php

// 定义类的命名空间，对应文件物理路径 app/Models
namespace App\Models;

// 引入Laravel模型基类，所有自定义模型必须继承该类才能使用ORM功能
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 实验室模型，对应数据库中的labs表，封装实验室信息的数据库操作
class Lab extends Model
{
    // 引入工厂方法特征，方便快速生成测试/假数据，适配Laravel的工厂模式
    use HasFactory;

    // 👇 定义允许批量赋值的字段
    // 使用Lab::create($data)时，仅该数组内的字段能被批量写入数据库，防止字段注入
    protected $fillable = [
        'name',         // 实验室名称，如“人工智能实验室”
        'intro',        // 实验室简介，用于官网首页展示的核心介绍
        'address',      // 实验室物理地址，如“XX教学楼302室”
        'contact',      // 实验室联系方式，如电话/邮箱，供访客咨询
        'logo',         // 实验室logo图片存储路径，关联文件系统的图片地址
        'status'        // 状态字段，1=启用（展示在官网），0=禁用（后台隐藏）
    ];

    // 👇 字段类型自动转换，数据库存原始值，代码中自动转对应类型
    protected $casts = [
        'status' => 'integer' // 确保status字段始终以整数类型返回，避免布尔/字符串混用
    ];
}
