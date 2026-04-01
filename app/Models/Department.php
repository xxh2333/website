<?php

// 定义这个类的命名空间，说明它在 app/Models 文件夹下
namespace App\Models;

// 引入 Laravel 的模型基类，所有模型都要继承它才能使用ORM数据库操作方法
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Department 类继承 Model，封装部门表的数据库操作，对应departments表
class Department extends Model
{
    // HasFactory 是 Laravel 提供的工厂方法特征，方便后续生成测试/模拟数据
    use HasFactory;

    // 👇 这里是关键！定义允许批量赋值的字段
    // 当你用 Department::create() 插入数据时，只有写在这里的字段才能被写入数据库
    protected $fillable = [
        'name',       // 部门名称，比如“软件开发部”“人工智能部”
        'desc',       // 部门描述，比如“负责实验室官网开发和后端API维护”
        'tech_stack', // 部门技术栈，如 ["PHP", "Laravel", "MySQL", "Python"]
        'status'      // 状态字段，1=启用（显示在官网），0=禁用（隐藏）
    ];

    // 👇 统一写一次类型转换，把所有需要处理的字段都放进来
    protected $casts = [
        'tech_stack' => 'array', // 把数据库里的JSON字符串自动转成PHP数组
        'status' => 'integer'    // 状态字段强制转成整数，避免类型错误
    ];
}
