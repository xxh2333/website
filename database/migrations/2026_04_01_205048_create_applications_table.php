<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id()->comment('报名ID');
            $table->integer('user_id')->comment('关联用户ID');
            $table->integer('department_id')->comment('关联部门ID');
            $table->string('student_id', 20)->comment('学号');
            $table->text('resume')->comment('报名简历/自我介绍');
            $table->tinyInteger('status')->default(0)->comment('审核状态：0=待审核，1=通过，2=拒绝');
            // 新增：审核备注字段（nullable 允许为空，适配初始无备注的场景）
            $table->text('review_comment')->nullable()->comment('审核备注/意见');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `applications` COMMENT = '实验室报名表（存储学生报名部门的信息）'");
    }

    public function down()
    {
        Schema::dropIfExists('applications');
    }
};
