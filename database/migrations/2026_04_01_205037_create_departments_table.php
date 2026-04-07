<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id()->comment('部门ID');
            $table->string('name', 50)->comment('部门名称（如：算法部/前端部）');
            $table->text('desc')->nullable()->comment('部门描述');
            $table->json('tech_stack')->nullable()->comment('技术栈（JSON格式，如["PHP","Vue"]）');
            $table->tinyInteger('sort')->default(0)->comment('排序（数字越小越靠前）');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `departments` COMMENT = '实验室部门表（存储各研发部门信息）'");
    }

    public function down()
    {
        Schema::dropIfExists('departments');
    }
};
