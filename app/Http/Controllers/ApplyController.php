<?php
namespace App\Http\Controllers;
use App\Models\Config;
use App\Models\Application;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\User;

class ApplyController extends Controller
{
    use ApiResponse;

    // 上传简历
    public function uploadResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120' // 5M以内
        ]);
        $upload = $this->uploadFile($request->file('resume'), 'resumes/');
        return $this->success(['resume_url' => $upload['url']], '简历上传成功');
    }

    // 提交报名
    public function submit(Request $request)
    {
        // 校验报名开关
        $switch = Config::where('key', 'apply_switch')->value('value');
        if ($switch != '1') {
            return $this->error('当前未开放报名', 403);
        }

        // 校验参数
        $request->validate([
            'student_id' => 'required|string|exists:users,student_id',
            'resume_url' => 'required|url'
        ]);

        // 创建报名记录
        $user = User::where('student_id', $request->student_id)->first();
        Application::create([
            'user_id' => $user->id,
            'resume_url' => $request->resume_url,
            'status' => 0 // 待审核
        ]);

        return $this->success([], '报名提交成功，等待审核');
    }
}
