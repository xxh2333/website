<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id()->comment('新闻ID');
            $table->string('title', 100)->comment('新闻标题');
            $table->string('cover')->nullable()->comment('新闻封面图路径');
            $table->longText('content')->comment('新闻内容（富文本）');
            $table->string('author', 30)->nullable()->comment('作者');
            $table->tinyInteger('is_top')->default(0)->comment('是否置顶：0=否，1=是');
            $table->integer('view_count')->default(0)->comment('阅读量');
            $table->tinyInteger('status')->default(1)->comment('状态：1=显示 0=隐藏');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('news');
    }
};
