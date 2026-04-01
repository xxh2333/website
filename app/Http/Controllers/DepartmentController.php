<?php
namespace App\Http\Controllers;

use App\Http\Traits\ApiResponse;
use App\Models\Department;

class DepartmentController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $list = Department::all(["id","name","desc","tech_stack"]);
        return $this->success($list);
    }
}
