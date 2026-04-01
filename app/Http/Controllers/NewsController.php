<?php
namespace App\Http\Controllers;

use App\Http\Traits\ApiResponse;
use App\Models\News;

class NewsController extends Controller
{
    use ApiResponse;

    // 新闻列表
    public function index()
    {
        $news = News::select("id","title","cover","created_at")
            ->orderBy("created_at","desc")
            ->paginate(10);

        return $this->success($news);
    }

    // 新闻详情
    public function show($id)
    {
        $news = News::find($id);

        if(!$news){
            return $this->error("新闻不存在",404);
        }

        return $this->success($news);
    }
}
