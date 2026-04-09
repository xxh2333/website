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

            // 学生信息
            $table->string('name')->comment('姓名');
            $table->string('student_id', 20)->comment('学号');
            $table->string('phone')->comment('手机号');
            $table->string('email')->comment('邮箱');

            // 报名内容
            $table->text('intro')->comment('自我介绍');
            $table->text('resume_path')->comment('简历路径');

            // 审核状态 → 只保留这一个！
            $table->tinyInteger('status')->default(0)
                ->comment('审核状态：0=待审核，1=通过，2=拒绝');

            $table->text('review_comment')->nullable()->comment('审核备注');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `applications` COMMENT = '实验室报名表'");
    }

    public function down()
    {
        Schema::dropIfExists('applications');
    }
};
