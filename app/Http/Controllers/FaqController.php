<?php
namespace App\Http\Controllers;

use App\Models\Faq;
use App\Http\Traits\ApiResponseTrait; // 👈 改成你真实的 trait 名
use Illuminate\Http\Request;

class FaqController extends Controller
{
    use ApiResponseTrait; // 👈 这里统一

    // ==========================
    // 前台：获取显示的 FAQ 列表
    // ==========================
    public function index()
    {
        try {
            // 只获取【显示】的 FAQ
            $faqs = Faq::where('is_show', 1)
                ->orderBy('sort', 'asc')
                ->get();

            return $this->success($faqs);
        } catch (\Exception $e) {
            return $this->error('获取FAQ失败');
        }
    }

    // ==========================
    // 后台：获取所有 FAQ
    // ==========================
    public function adminList()
    {
        try {
            $faqs = Faq::orderBy('sort', 'asc')->get();
            return $this->success($faqs);
        } catch (\Exception $e) {
            return $this->error('获取FAQ失败');
        }
    }

    // ==========================
    // 后台：新增 FAQ
    // ==========================
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:200',
            'answer'   => 'required|string',
            'sort'     => 'integer|nullable',
            'is_show'  => 'integer|nullable',
        ]);

        Faq::create([
            'question' => $request->question,
            'answer'   => $request->answer,
            'sort'     => $request->sort ?? 0,
            'is_show'  => $request->is_show ?? 1,
        ]);

        return $this->success([], 'FAQ 新增成功');
    }

    // ==========================
    // 后台：修改 FAQ
    // ==========================
    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);

        $faq->update([
            'question' => $request->question,
            'answer'   => $request->answer,
            'sort'     => $request->sort ?? $faq->sort,
            'is_show'  => $request->is_show ?? $faq->is_show,
        ]);

        return $this->success([], 'FAQ 修改成功');
    }

    // ==========================
    // 后台：删除 FAQ
    // ==========================
    public function destroy($id)
    {
        Faq::destroy($id);
        return $this->success([], 'FAQ 删除成功');
    }
}
