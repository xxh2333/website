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


// ======================
// 新增：遗漏模块接口 成员1补充
// ======================
// 引入新增控制器（需确保控制器文件已创建）
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\TraineeController;
use App\Http\Controllers\ApplyController;

// ------------ 前台通用接口（无需登录）------------
// 1. 系统配置：报名开关状态（给报名页用）
Route::get('/config/apply-status', [ConfigController::class, 'applyStatus']);

// 2. FAQ：前台展示的FAQ列表
Route::get('/faqs', [FaqController::class, 'index']);

// 3. 相册：前台展示的实验室相册列表
Route::get('/galleries', [GalleryController::class, 'index']);

// 4. 简历上传（补充报名接口的缺失功能）
Route::post('/v1/applications/upload-resume', [ApplyController::class, 'uploadResume']);

// 5. 学员中心（基于学号查询，无需登录的简易版）
Route::get('/v1/trainee/dashboard', [TraineeController::class, 'dashboard']); // 个人信息+报名记录
Route::post('/v1/trainee/profile', [TraineeController::class, 'updateProfile']); // 修改个人资料
Route::get('/v1/trainee/application/{id}', [TraineeController::class, 'applicationStatus']); // 报名状态详情

// ------------ 后台管理接口（建议后续加登录中间件）------------
Route::prefix('v1/admin')->group(function () {
    // 1. 系统配置管理
    Route::get('/configs', [ConfigController::class, 'index']); // 获取所有配置
    Route::put('/configs/{key}', [ConfigController::class, 'update']); // 修改配置值

    // 2. FAQ管理
    Route::get('/faqs', [FaqController::class, 'adminList']); // 获取所有FAQ（含隐藏）
    Route::post('/faqs', [FaqController::class, 'store']); // 新增FAQ
    Route::put('/faqs/{id}', [FaqController::class, 'update']); // 修改FAQ
    Route::delete('/faqs/{id}', [FaqController::class, 'destroy']); // 删除FAQ

    // 3. 相册管理
    Route::get('/galleries', [GalleryController::class, 'adminList']); // 获取所有相册
    Route::post('/galleries/upload', [GalleryController::class, 'upload']); // 上传相册图片
    Route::post('/galleries', [GalleryController::class, 'store']); // 新增相册条目
    Route::put('/galleries/{id}', [GalleryController::class, 'update']); // 修改相册
    Route::delete('/galleries/{id}', [GalleryController::class, 'destroy']); // 删除相册
});
