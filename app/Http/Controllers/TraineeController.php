<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Application;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class TraineeController extends Controller
{
    use ApiResponse;

    // 学员中心：个人信息+报名记录
    public function dashboard(Request $request)
    {
        // 简易版：通过学号获取学员（正式版需替换为登录认证）
        $user = User::where('student_id', $request->student_id)->firstOrFail();
        $applications = Application::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return $this->success([
            'user_info' => $user->only(['id', 'name', 'student_id', 'phone', 'email', 'avatar']),
            'applications' => $applications
        ]);
    }

    // 修改个人资料
    public function updateProfile(Request $request)
    {
        $user = User::where('student_id', $request->student_id)->firstOrFail();
        $user->update($request->only(['name', 'phone', 'email', 'avatar']));
        return $this->success([], '资料修改成功');
    }

    // 查询报名状态
    public function applicationStatus($id)
    {
        $application = Application::findOrFail($id);
        return $this->success([
            'status' => $application->status,
            'status_text' => ['待审核', '通过', '驳回'][$application->status],
            'remark' => $application->remark
        ]);
    }
}
