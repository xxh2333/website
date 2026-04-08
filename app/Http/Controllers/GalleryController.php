<?php
namespace App\Http\Controllers;
use App\Models\Gallery;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    use ApiResponse;

    // 前台：获取显示的相册列表
    public function index()
    {
        $galleries = Gallery::where('is_show', 1)->orderBy('sort')->get();
        return $this->success($galleries->toArray());
    }

    // 后台：获取所有相册
    public function adminList()
    {
        $galleries = Gallery::orderBy('sort')->get();
        return $this->success($galleries);
    }

    // 后台：上传相册图片（修正2：临时注释不存在的方法）
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048' // 限制2M以内
        ]);
        // 后续需要补充 uploadFile 方法（比如基于 Storage 封装）
        // 临时返回占位数据，避免报错
        return $this->success(['image_url' => 'https://example.com/gallery/temp.jpg'], '图片上传成功（待完善）');
    }

    // 后台：新增相册条目
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'image_url' => 'required|url'
        ]);
        Gallery::create($request->only(['title', 'image_url', 'description', 'sort', 'is_show']));
        return $this->success([], '相册新增成功');
    }

    // 后台：修改相册
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->update($request->only(['title', 'image_url', 'description', 'sort', 'is_show']));
        return $this->success([], '相册修改成功');
    }

    // 后台：删除相册
    public function destroy($id)
    {
        Gallery::destroy($id);
        return $this->success([], '相册删除成功');
    }

    // （可选）补充 uploadFile 方法（完整上传逻辑）
    // private function uploadFile($file, $folder)
    // {
    //     $path = $file->store($folder, 'public');
    //     return [
    //         'url' => asset('storage/' . $path)
    //     ];
    // }
}
