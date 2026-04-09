<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id()->comment('相册图片唯一ID');
            $table->string('title', 100)->comment('图片标题');
            $table->string('image_url', 255)->comment('图片访问URL');
            $table->text('description')->nullable()->comment('图片描述');
            $table->integer('sort')->default(0)->comment('排序值（数字越小越靠前）');
            $table->boolean('is_show')->default(1)->comment('是否前台显示：1=显示，0=隐藏');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `galleries` COMMENT = '相册表（存储实验室成果/环境展示图片）'");
    }
    public function down() { Schema::dropIfExists('galleries'); }
};
