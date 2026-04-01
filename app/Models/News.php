<?php

// 定义类的命名空间，对应文件物理路径 app/Models
namespace App\Models;

// 引入Laravel模型基类，基础ORM操作的核心依赖
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 新闻模型，对应数据库中的news表，封装新闻公告的数据库操作，适配列表/详情接口
class News extends Model
{
    // 引入工厂方法特征，支持快速生成新闻测试数据，方便接口调试
    use HasFactory;

    // 👇 定义允许批量赋值的字段
    // 使用News::create($data)批量插入时，仅该数组内字段可写入，杜绝非法字段注入
    protected $fillable = [
        'title',        // 新闻标题，如“实验室2026年招新启动”
        'content',      // 新闻内容，支持富文本/html，对应官网新闻详情页
        'cover',        // 新闻封面图存储路径，列表页展示的缩略图地址
        'department_id',// 所属部门ID，关联departments表的主键，用于区分新闻发布部门
        'is_top',       // 是否置顶，1=置顶（列表页优先展示），0=不置顶
        'views',        // 新闻浏览量，统计用户访问详情页的次数
        'status'        // 状态字段，1=发布（官网展示），0=草稿/下架（后台隐藏）
    ];

    // 👇 字段类型自动转换，数据库原始值自动转为业务所需类型，无需手动处理
    protected $casts = [
        'is_top' => 'integer',    // 置顶标识强制转整数，避免布尔值混用
        'views' => 'integer',     // 浏览量强制转整数，保证计数准确性
        'status' => 'integer',    // 状态字段强制转整数，统一1/0标识
        'department_id' => 'integer' // 部门ID强制转整数，关联查询时避免类型错误
    ];

    // 👇 定义与部门模型的关联关系（一对多：一条新闻属于一个部门）
    // 调用$news->department可直接获取该新闻所属的部门完整信息，无需手动联表查询
    public function department()
    {
        // belongsTo：表示当前模型属于另一个模型，参数为关联模型、外键、关联模型主键
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
