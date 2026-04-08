<?php
namespace App\Http\Controllers;

use App\Http\Traits\ApiResponse;
use App\Models\News;

class NewsController extends Controller
{
    use ApiResponse;

    // 新闻列表（已修复分页，前端可正常使用）
    public function index()
    {
        // 1. 查询新闻数据，每页10条，只取需要的字段
        $news = News::select("id","title","cover","created_at")
            ->orderBy("created_at","desc")
            ->paginate(10);//每页显示10条数据

        // 2. 组装前端需要的标准分页格式
        $data = [
            // 当前页的新闻列表
            "list" => $news->items(),

            // 分页核心信息
            "meta" => [
                "current_page" => $news->currentPage(),   // 当前页码
                "per_page"     => $news->perPage(),       // 每页多少条
                "total"        => $news->total(),         // 总条数（必须！）
                "total_pages"  => $news->lastPage(),      // 总页数（必须！）
            ]
        ];

        // 3. 返回给前端
        return $this->success($data);
    }

    // 新闻详情（完全保留你原来的逻辑，只修正了语法）
    public function show($id)
    {
        $news = News::find($id);//根据id查询单条新闻

        if(!$news){
            return $this->error("新闻不存在",404);
        }

        return $this->success($news);
    }
}
