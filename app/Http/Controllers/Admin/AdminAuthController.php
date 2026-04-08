<?php
//管理员登录接口
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    //
    public function login(Request $request)
    {
        //校验参数
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        //查询管理员
        $user = User::where('email', $request->email)->first();
        //验证账号、密码
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'code' => 400,
                'message' => '账号或密码错误',
                'data' => null
            ]);
        }
        //生成Sanctum Token
        $token = $user->createToken('admin-token')->plainTextToken;

        //返回结果
        return response()->json([
            'code' => 200,
            'message' => '登录成功',
            'data' => [
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ]
            ]
        ]);
    }
}
