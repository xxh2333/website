<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lab_info', function (Blueprint $table) {
            $table->id()->comment('主键ID');
            $table->string('name', 100)->comment('实验室名称');
            $table->text('desc')->comment('实验室简介');
            $table->string('address')->nullable()->comment('实验室地址');
            $table->string('contact')->nullable()->comment('联系方式');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `lab_info` COMMENT = '实验室信息表（存储实验室基础信息）'");
    }

    public function down()
    {
        Schema::dropIfExists('lab_info');
    }
};
