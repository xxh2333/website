<?php

// 路由文件：api.php
// 作用：定义前端可以访问的接口地址
// 成员2任务：实验室、部门、新闻 4个公共接口

// 引入路由系统
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApplicationController;
// 引入公共控制器
use App\Http\Controllers\PublicController;

// ======================
// 成员2 公共接口路由
// ======================

// 1. 实验室信息接口 GET /api/lab
Route::get('/lab', [PublicController::class, 'lab']);

// 2. 部门列表接口 GET /api/departments
Route::get('/departments', [PublicController::class, 'departments']);

// 3. 新闻列表（分页）接口 GET /api/news
Route::get('/news', [PublicController::class, 'news']);

// 4. 新闻详情接口 GET /api/news/{id}
Route::get('/news/{id}', [PublicController::class, 'newsDetail']);


// 报名接口（无需登录）
    // 报名相关
Route::post('/applications', [ApplicationController::class, 'store']);
Route::get('/applications/status', [ApplicationController::class, 'status']);
Route::get('/applications/registration-status', [ApplicationController::class, 'registrationStatus']);
