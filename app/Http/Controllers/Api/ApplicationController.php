<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\CheckApplicationStatusRequest;
use App\Models\Application;
use App\Models\Setting;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;
class ApplicationController extends Controller
{
    /**
     * 提交报名
     */
    public function store(StoreApplicationRequest $request)
    {
        // 1. 检查报名是否开放
        $switch = \App\Models\Config::where('key', 'apply_switch')->value('value');
        $start  = \App\Models\Config::where('key', 'apply_start')->value('value');
        $end    = \App\Models\Config::where('key', 'apply_end')->value('value');

        $now = Carbon::now();
        $startTime = $start ? Carbon::parse($start) : Carbon::minValue();
        $endTime   = $end ? Carbon::parse($end) : Carbon::maxValue();

        $isOpen = ($switch == '1') && $now->between($startTime, $endTime);

        if (!$isOpen) {
            return response()->json([
                'code' => 403,
                'message' => '报名已关闭，暂不可提交',
                'data' => null
            ], 403);
        }

        // 2. 处理文件上传
        $resumePath = null;
        if ($request->hasFile('resume')) {
            $file = $request->file('resume');
            // 生成唯一文件名：学号_时间戳.扩展名
            $filename = $request->student_id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $resumePath = $file->storeAs('resumes', $filename, 'public');

            if (!$resumePath) {
                return response()->json([
                    'code' => 500,
                    'message' => '文件上传失败，请重试',
                    'data' => null
                ], 500);
            }
        }

        // 3. 使用事务保存数据
        try {
            DB::beginTransaction();

            $application = Application::create([
                'name' => $request->name,
                'student_id' => $request->student_id,
                'department_id' => $request->department_id,
                'phone' => $request->phone,
                'email' => $request->email,
                'intro' => $request->intro,
                'resume_path' => $resumePath,
                'status' => '0',
                'user_id' => 0,
            ]);

            DB::commit();

            // 获取部门名称
            $department = Department::find($request->department_id);

            return response()->json([
                'code' => 200,
                'message' => '报名成功',
                'data' => [
                    'id' => $application->id,
                    'name' => $application->name,
                    'student_id' => $application->student_id,
                    'department' => $department->name,
                    'status' => $application->status,
                    'created_at' => $application->created_at->toDateTimeString(),
                ]
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();

            // 如果文件已上传但保存失败，删除文件
            if ($resumePath && Storage::disk('public')->exists($resumePath)) {
                Storage::disk('public')->delete($resumePath);
            }

            return response()->json([
                'code' => 500,
                'message' => '报名失败：' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    /**
     * 查询报名状态
     */
    public function status(CheckApplicationStatusRequest $request)
    {
        $studentId = $request->input('student_id');
        $phone = $request->input('phone');

        // 查询报名记录
        $application = Application::with('department')
            ->where('student_id', $studentId)
            ->where('phone', $phone)
            ->first();

        if (!$application) {
            return response()->json([
                'code' => 404,
                'message' => '未找到报名记录，请检查学号和手机号是否正确',
                'data' => null
            ], 404);
        }

        // 状态映射
        $statusMap = [
            '0' => '待审核',
            '1' => '已通过',
            '2' => '已拒绝'
        ];

        return response()->json([
            'code' => 200,
            'message' => '查询成功',
            'data' => [
                'id' => $application->id,
                'name' => $application->name,
                'student_id' => $application->student_id,
                'department' => $application->department->name ?? '未知',
                'phone' => $application->phone,
                'email' => $application->email,
                'status' => $application->status,
                'status_text' => $statusMap[$application->status],
                'review_comment' => $application->review_comment,
                'intro' => $application->intro,
                'has_resume' => !is_null($application->resume_path),
                'created_at' => $application->created_at->toDateTimeString(),
                'reviewed_at' => $application->reviewed_at ? $application->reviewed_at->toDateTimeString() : null,
            ]
        ], 200);
    }

    /**
     * 获取报名开关状态（辅助接口，可选）
     */
    public function registrationStatus()
    {
        $switch = \App\Models\Config::where('key', 'apply_switch')->value('value');
        $start  = \App\Models\Config::where('key', 'apply_start')->value('value');
        $end    = \App\Models\Config::where('key', 'apply_end')->value('value');

        $now = Carbon::now();
        $startTime = $start ? Carbon::parse($start) : Carbon::minValue();
        $endTime   = $end ? Carbon::parse($end) : Carbon::maxValue();

        $isOpen = ($switch == '1') && $now->between($startTime, $endTime);

        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => [
                'is_open' => $isOpen,
                'message' => $isOpen ? '报名已开启' : '报名已关闭'
            ]
        ]);
    }
}
