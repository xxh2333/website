<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminStatisticsController extends Controller
{
    public function index()
    {
        // 总报名数
        $total = \App\Models\Application::count();

        // 各部门报名数（修复空指针问题）
        $departmentStats = \App\Models\Application::with('department')
            ->selectRaw('department_id, count(*) as num')
            ->groupBy('department_id')
            ->get()
            ->map(function ($item) {
                return [
                    'department_id' => $item->department_id,
                    // 关键修复：department 为 null 时，返回「未知部门」，避免报错
                    'department_name' => $item->department ? $item->department->name : '未知部门',
                    'num' => $item->num
                ];
            });

        // 各状态报名数
        $statusStats = \App\Models\Application::selectRaw('status, count(*) as num')
            ->groupBy('status')
            ->get()
            ->map(function ($item) {
                $statusMap = [0 => '待审核', 1 => '已通过', 2 => '已拒绝'];
                return [
                    'status' => $item->status,
                    'status_name' => $statusMap[$item->status] ?? '未知状态',
                    'num' => $item->num
                ];
            });

        return response()->json([
            'code' => 200,
            'message' => '获取成功',
            'data' => [
                'total' => $total,
                'department_stats' => $departmentStats,
                'status_stats' => $statusStats
            ]
        ]);
    }
}
