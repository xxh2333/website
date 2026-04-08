<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 把原 lab_info 表重命名为 labs（匹配路由/Seeder）
        Schema::rename('lab_info', 'labs');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 回滚时恢复为 lab_info（兼容旧逻辑）
        Schema::rename('labs', 'lab_info');
    }
};
