<?php
//验证登录用户是否为管理员
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 获取当前登录用户
        $user = $request->user();

        // 验证：用户存在 + 是管理员（role=1）
        if (!$user || $user->role != 1) {
            return response()->json([
                'code' => 403,
                'message' => '无管理员权限',
                'data' => null
            ], 403);
        }

        return $next($request);
    }
}
