<?php
namespace App\Http\Traits;

trait ApiResponseTrait
{
    /**
     * 成功响应
     * @param mixed $data 响应数据
     * @param string $message 提示信息
     * @param int $code HTTP状态码
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data = null, string $message = '请求成功', int $code = 200)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * 失败响应
     * @param string $message 错误信息
     * @param int $code HTTP状态码
     * @param mixed $data 附加数据
     * @return \Illuminate\Http\JsonResponse
     */
    public function error(string $message = '请求失败', int $code = 400, $data = null)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
