<?php

// 定义这个类的命名空间，说明它在 app/Http/Requests 文件夹下
namespace App\Http\Requests;

// 引入 Laravel 表单验证基类
use Illuminate\Foundation\Http\FormRequest;

// NewsListRequest 表单验证类，专门验证新闻列表接口的分页参数
class NewsListRequest extends FormRequest
{
    // 权限判断：所有用户都可以访问新闻列表，所以直接返回 true
    public function authorize()
    {
        return true;
    }

    // 验证规则：定义接口需要校验的参数
    public function rules()
    {
        return [
            // 页码：非必须，数字，最小 1
            'page' => 'nullable|integer|min:1',
            // 每页条数：非必须，数字，最小 1，最大 20
            'limit' => 'nullable|integer|min:1|max:20'
        ];
    }
}
