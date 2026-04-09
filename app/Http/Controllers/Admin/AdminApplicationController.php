<?php
//报名列表接口
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminApplicationController extends Controller
{
    //
    public function index(Request $request)
    {
        //接收分页和搜索参数
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 10);
        $keyword = $request->input('keyword','');

        //构建查询：关联部门表，支持搜索
        $query = \App\Models\Application::with('department');

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('student_id', 'like', '%' . $keyword . '%')
                    ->orWhere('department', function($q) use ($keyword) {
                        $q->where('name', 'like', '%' . $keyword . '%');
                    });
            });
        }
        //分页返回
        $list = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'code' => 200,
            'message' => '获取成功',
            'data' => $list
        ]);
    }

    public function update(Request $request, $id)
    {
        // 校验参数
        $request->validate([
            'status' => 'required|in:0,1,2', // 0待审核,1通过,2拒绝
            'review_note' => 'nullable|string'
        ]);

        // 查询报名记录
        $application = \App\Models\Application::find($id);
        if (!$application) {
            return response()->json([
                'code' => 404,
                'message' => '报名记录不存在',
                'data' => null
            ], 404);
        }

        // 更新状态和审核意见
        $application->update([
            'status' => $request->status,
            'review_note' => $request->review_note
        ]);

        return response()->json([
            'code' => 200,
            'message' => '审核成功',
            'data' => $application
        ]);
    }
}
