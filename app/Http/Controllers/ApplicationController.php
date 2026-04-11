<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
// 引入请求验证
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\CheckApplicationStatusRequest;

// 引入统一响应工具
use App\Http\Traits\ApiResponseTrait;

// 引入模型
use App\Models\Application;
use App\Models\Config;

// 文件上传
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    // 使用统一响应
    use ApiResponseTrait;

    /**
     * 1. 提交报名接口
     */
    public function store(StoreApplicationRequest $request)
    {
        $switch = Config::where('key', 'apply_switch')->value('value');
        $start = Config::where('key', 'apply_start')->value('value');
        $end = Config::where('key', 'apply_end')->value('value');

        // 用 Carbon 统一解析时间，删除冗余的 $now = now()
        $now = Carbon::now();
        $startTime = $start ? Carbon::parse($start) : Carbon::minValue();
        $endTime = $end ? Carbon::parse($end) : Carbon::maxValue();

        // 对比解析后的 Carbon 对象，而非原字符串
        $isOpen = ($switch == '1') && $now->between($startTime, $endTime);

        if (!$isOpen) {
            return $this->error('报名尚未开放！');
        }

        // 1. 获取所有合法数据
        $data = $request->validated();

        // 2. 判断是否上传了简历
        if ($request->hasFile('resume')) {
            // 获取文件
            $file = $request->file('resume');

            // 生成不重复的文件名
            $fileName = time() . '_' . $file->getClientOriginalName();

            // 存储到 public/resumes 目录
            $path = $file->storeAs('resumes', $fileName, 'public');

            // 把文件路径存入数据库
            $data['resume'] = $path;
        }

        // 3. 默认状态：待审核
        $data['status'] = 0;

        // 4. 保存到数据库
        Application::create($data);

        // 5. 返回成功
        return $this->success([], '报名成功');
    }

    /**
     * 2. 查询报名状态接口
     */
    public function status(CheckApplicationStatusRequest $request)
    {
        // 根据学号+手机号查询
        $info = Application::where('student_id', $request->student_id)
            ->where('phone', $request->phone)
            ->first();

        // 如果没查到
        if (!$info) {
            return $this->error('未找到报名信息');
        }

        // 查到了就返回
        return $this->success($info);
    }


    public function registrationStatus()
    {
        // 直接复用 ConfigController 的 applyStatus 方法，保证100%一致
        $configController = new \App\Http\Controllers\ConfigController();
        $response = $configController->applyStatus(request());
        $data = json_decode($response->getContent(), true)['data'];

        return $this->success([
            'is_open' => $data['is_open'],
            'message' => $data['is_open'] ? '报名已开启' : '报名已关闭'
        ]);
    }
}
