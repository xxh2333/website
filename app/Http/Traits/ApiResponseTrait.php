<?php
namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;


trait ApiResponseTrait
{
    /**
     * 成功响应（兼容Collection，解决中文乱码）
     * @param mixed $data 响应数据（支持数组/Collection/null）
     * @param string $message 提示信息
     * @param int $code HTTP状态码
     * @return JsonResponse
     */
    public function success($data = null, string $message = '请求成功', int $code = 200): JsonResponse
    {
        // 自动将Collection转为数组，避免类型问题
        if ($data instanceof Collection) {
            $data = $data->toArray();
        }

        // 关键：添加JSON_UNESCAPED_UNICODE解决中文乱码
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], $code, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * 失败响应（统一格式，解决中文乱码）
     * @param string $message 错误信息
     * @param int $code HTTP状态码
     * @param mixed $data 附加数据
     * @return JsonResponse
     */
    public function error(string $message = '请求失败', int $code = 400, $data = null): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], $code, [], JSON_UNESCAPED_UNICODE);
    }
}
