<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 重点1：创建 applications 表（不是 configs！）
        Schema::create('applications', function (Blueprint $table) {
            $table->id()->comment('报名ID');
            $table->integer('user_id')->comment('关联用户ID');
            $table->integer('department_id')->comment('关联部门ID');
            $table->string('student_id', 20)->comment('学号');
            $table->text('resume')->comment('报名简历/自我介绍');
            $table->tinyInteger('status')->default(0)->comment('审核状态：0=待审核，1=通过，2=拒绝');
            $table->timestamps();
        });

        // 可选：添加表注释（和你configs表的写法保持一致）
        DB::statement("ALTER TABLE `applications` COMMENT = '实验室报名表（存储学生报名部门的信息）'");
    }

    public function down()
    {
        // 重点2：删除 applications 表（不是 configs！）
        Schema::dropIfExists('applications');
    }
};
