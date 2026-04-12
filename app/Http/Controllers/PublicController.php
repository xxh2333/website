<?php

// 定义这个类的命名空间，说明它在 app/Http/Controllers 文件夹下
namespace App\Http\Controllers;

// 引入 Laravel 控制器基类
use Illuminate\Routing\Controller;

// 引入模型
use App\Models\Lab;
use App\Models\Department;
use App\Models\News;

// 引入表单验证类
use App\Http\Requests\NewsListRequest;
use App\Http\Requests\NewsDetailRequest;

// 引入统一响应工具类
use App\Http\Traits\ApiResponseTrait;

// PublicController 公共页面控制器
// 负责：实验室信息、部门列表、新闻列表、新闻详情 4个接口
class PublicController extends Controller
{
    // 使用统一响应格式，所有接口返回结构统一
    use ApiResponseTrait;

    // ==============================
    // 接口1：获取实验室信息 GET /api/lab
    // ==============================
    public function lab()
    {
        try {
            // 获取第一条实验室信息（后台只需要一条）
            $lab = Lab::first();

            // 如果没有数据，返回错误
            if (!$lab) {
                return $this->error('暂无实验室信息');
            }

            // 成功返回数据
            return $this->success($lab);
        } catch (\Exception $e) {
            // 异常捕获，防止接口报错
            return $this->error('获取实验室信息失败');
        }
    }

    // ==============================
    // 接口2：获取部门列表 GET /api/departments
    // ==============================
    public function departments()
    {
        try {
            // 获取所有状态为显示的部门
            $list = Department::where('status', 1)->get();

            // 返回部门列表
            return $this->success($list);
        } catch (\Exception $e) {
            return $this->error('获取部门列表失败');
        }
    }

    // ==============================
    // 接口 3：新闻列表（分页）GET /api/news
    // ==============================
    public function news(NewsListRequest $request)
    {
        try {
            // 获取页码，默认第 1 页
            $page = $request->input('page', 1);

            // 获取每页条数，默认 10 条
            $limit = $request->input('limit', 10);

            // 查询状态为显示的新闻，按时间倒序，分页返回
            $news = News::where('status', 1)
                ->orderBy('id', 'desc')
                ->paginate($limit, ['*'], 'page', $page);

            // 格式化分页数据，只保留前端需要的字段
            $data = [
                'current_page' => $news->currentPage(),
                'data' => $news->items(),
                'per_page' => (int) $news->perPage(),
                'prev_page_url' => $news->currentPage() > 1 ? $news->url($news->currentPage() - 1) : null,
                'to' => $news->lastItem() ?? 0,
                'total' => $news->total(),
            ];

            // 成功返回分页数据
            return $this->success($data);
        } catch (\Exception $e) {
            return $this->error('获取新闻列表失败');
        }
    }

    // ==============================
    // 接口 4：新闻详情 GET /api/news/{id}
    // ==============================
    public function newsDetail($id)
    {
        try {
            // 根据 ID 查找新闻，且必须是已发布状态
            $news = News::where('status', 1)->find($id);

            // 如果新闻不存在，返回 200 但 data 为 null
            if (!$news) {
                return $this->success(null, '新闻不存在或已下架');
            }

            // 浏览量 +1
            $news->increment('view_count');

            // 返回新闻详情
            return $this->success($news);
        } catch (\Exception $e) {
            return $this->error('获取新闻详情失败');
        }
    }
}
