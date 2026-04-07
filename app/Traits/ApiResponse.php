<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * 统一成功返回格式
     *
     * @param array<mixed> $data
     * @param string $msg
     * @param int $code
     * @return JsonResponse
     */
    public function success(array $data = [], string $msg = '操作成功', int $code = 200): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'msg'  => $msg,
            'data' => $data
        ]);
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
        ]);
    }
}
