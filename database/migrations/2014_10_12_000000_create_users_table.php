<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // ===== 保留 Laravel 默认字段 =====
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // ===== 追加实验室报名系统需要的字段 =====
            $table->string('student_id', 20)->unique()->nullable()->comment('学号/工号（报名核心字段）');
            $table->string('phone', 11)->unique()->nullable()->comment('手机号（通知审核结果）');
            $table->string('avatar', 255)->nullable()->comment('学员头像URL');
        });

        // 可选：添加表注释（兼容所有Laravel版本）
        DB::statement("ALTER TABLE `users` COMMENT = '用户表（兼容Laravel认证+实验室报名学员信息）'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
