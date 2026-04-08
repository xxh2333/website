<?php
namespace App\Http\Controllers;
use App\Models\Config;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    use ApiResponse;

    // 前台：获取报名开关状态
    public function applyStatus()
    {
        $switch = Config::where('key', 'apply_switch')->value('value');
        $start = Config::where('key', 'apply_start')->value('value');
        $end = Config::where('key', 'apply_end')->value('value');
        return $this->success([
            'is_open' => $switch == '1',
            'start_time' => $start,
            'end_time' => $end
        ]);
    }

    // 后台：获取所有配置
    public function index(Request $request)
    {
        $configs = Config::orderBy('key')->get();
        return $this->success($configs);
    }

    // 后台：修改配置值
    public function update(Request $request, $key)
    {
        $config = Config::where('key', $key)->firstOrFail();
        $config->value = $request->input('value');
        $config->save();
        return $this->success([], '配置修改成功');
    }
}
