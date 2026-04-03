<?php
namespace App\Http\Controllers;

use App\Http\Traits\ApiResponse;

class LabController extends Controller
{
    use ApiResponse;

    public function show()
    {
        $data = [
            "name" => "计算机实验室",
            "desc" => "专注软件开发、人工智能、网络安全",
            "contact" => "lab@school.com",
            "address" => "实验楼A座302"
        ];

        return $this->success($data);
    }
}
