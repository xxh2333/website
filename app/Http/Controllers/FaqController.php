<?php
namespace App\Http\Controllers;
use App\Models\Faq;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    use ApiResponse;

    // 前台：获取显示的FAQ列表
    public function index()
    {
        $faqs = Faq::where('is_show', 1)->orderBy('sort')->get();
        return $this->success($faqs->toArray());
    }

    // 后台：获取所有FAQ
    public function adminList()
    {
        $faqs = Faq::orderBy('sort')->get();
        return $this->success($faqs);
    }

    // 后台：新增FAQ
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:200',
            'answer' => 'required|string'
        ]);
        Faq::create($request->only(['question', 'answer', 'sort', 'is_show']));
        return $this->success([], 'FAQ新增成功');
    }

    // 后台：修改FAQ
    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->update($request->only(['question', 'answer', 'sort', 'is_show']));
        return $this->success([], 'FAQ修改成功');
    }

    // 后台：删除FAQ
    public function destroy($id)
    {
        Faq::destroy($id);
        return $this->success([], 'FAQ删除成功');
    }
}
