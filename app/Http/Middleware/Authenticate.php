<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // 针对API请求，直接返回401 JSON，不跳转
        if ($request->is('api/*')) {
            return response()->json([
                'code' => 401,
                'message' => '请先登录',
                'data' => null
            ], 401);
        }

        // 非API请求（如后台页面），如果需要跳转，定义对应的路由
        // 这里如果是纯API项目，可直接删除，只保留API判断
        return route('login');
    }
}
