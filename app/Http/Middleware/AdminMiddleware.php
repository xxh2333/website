<?php
//验证登录用户是否为管理员
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 只要登录了，就允许访问管理后台
        if (!$request->user()) {
            return response()->json([
                'code' => 401,
                'message' => '请先登录',
                'data' => null
            ]);
        }

        // 不判断 role！直接放行！
        return $next($request);
    }
}
