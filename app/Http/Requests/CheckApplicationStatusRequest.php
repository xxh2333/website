<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckApplicationStatusRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    // 查询只需要 学号 + 手机号
    public function rules()
    {
        return [
            'student_id' => 'required',
            'phone' => 'required|regex:/^1[3-9]\d{9}$/'
        ];
    }

    public function messages()
    {
        return [
            'student_id.required' => '请输入学号',
            'phone.required' => '请输入手机号',
            'phone.regex' => '手机号格式错误'
        ];
    }
}
