<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection; // 引入集合类
use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * 统一成功返回格式
     *
     * @param mixed $data 支持数组/Collection/null
     * @param string $msg
     * @param int $code
     * @return JsonResponse
     */
    public function success($data = [], string $msg = '操作成功', int $code = 200): JsonResponse
    {
        // 关键：如果是集合，自动转数组
        if ($data instanceof Collection) {
            $data = $data->toArray();
        }

        // 关键：添加 JSON_UNESCAPED_UNICODE 解决中文乱码
        return response()->json([
            'code' => $code,
            'msg'  => $msg,
            'data' => $data
        ], $code, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * 统一错误返回格式
     *
     * @param string $msg
     * @param int $code
     * @param array<mixed> $data
     * @return JsonResponse
     */
    public function error(string $msg = '操作失败', int $code = 400, array $data = []): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'msg'  => $msg,
            'data' => $data
        ], $code, [], JSON_UNESCAPED_UNICODE);
    }
}
