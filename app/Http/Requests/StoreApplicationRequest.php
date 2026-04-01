<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    // 任何人都可以报名
    public function authorize()
    {
        return true;
    }

    // 验证规则
    public function rules()
    {
        return [
            // 姓名必填
            'name' => 'required',

            // 学号必填 + 不能重复（核心：重复报名校验）
            'student_id' => 'required|unique:applications',

            // 手机号必填 + 格式正确
            'phone' => 'required|regex:/^1[3-9]\d{9}$/',

            // 邮箱必填 + 格式正确
            'email' => 'required|email',

            // 自我介绍
            'intro' => 'required',

            // 简历必须上传 + 只能是PDF/Word + 最大2M
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048'
        ];
    }

    // 自定义中文错误提示
    public function messages()
    {
        return [
            'name.required' => '请输入姓名',
            'student_id.required' => '请输入学号',
            'student_id.unique' => '你已经报名过啦，不能重复报名',
            'phone.required' => '请输入手机号',
            'phone.regex' => '手机号格式不正确',
            'email.required' => '请输入邮箱',
            'email.email' => '邮箱格式不正确',
            'intro.required' => '请输入自我介绍',
            'resume.required' => '请上传简历',
            'resume.mimes' => '简历只能是 PDF、Word 格式',
            'resume.max' => '简历不能超过2M'
        ];
    }
}
