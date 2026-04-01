<?php

// 定义这个类的命名空间，说明它在 app/Http/Requests 文件夹下
namespace App\Http\Requests;

// 引入 Laravel 表单验证基类
use Illuminate\Foundation\Http\FormRequest;

// NewsDetailRequest 表单验证类，专门验证新闻详情接口的 ID 参数
class NewsDetailRequest extends FormRequest
{
    // 权限判断：所有用户都可以查看新闻详情，所以直接返回 true
    public function authorize()
    {
        return true;
    }

    // 验证规则：新闻 ID 必须传递、必须是数字
    public function rules()
    {
        return [
            'id' => 'required|integer'
        ];
    }
}
