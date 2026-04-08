<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminApplicationController;
use App\Http\Controllers\Admin\AdminStatisticsController;

// ======================
// 公共接口（任何人可访问）
// ======================

// 1. 实验室信息
Route::get('/lab', [PublicController::class, 'lab']);

// 2. 部门列表
Route::get('/departments', [PublicController::class, 'departments']);

// 3. 新闻列表
Route::get('/news', [PublicController::class, 'news']);

// 4. 新闻详情
Route::get('/news/{id}', [PublicController::class, 'newsDetail']);

// ======================
// 报名接口（无需登录）
// ======================

Route::post('/applications', [ApplicationController::class, 'store']);
Route::get('/applications/status', [ApplicationController::class, 'status']);
Route::get('/applications/registration-status', [ApplicationController::class, 'registrationStatus']);

// ======================
// 管理员接口
// ======================

// 登录（无需Token）
Route::post('admin/login', [AdminAuthController::class, 'login']);

// 需要登录 + 管理员权限
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('admin/applications', [AdminApplicationController::class, 'index']);
    Route::put('admin/applications/{id}', [AdminApplicationController::class, 'update']);
    Route::get('admin/statistics', [AdminStatisticsController::class, 'index']);
});
