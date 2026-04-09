<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id()->comment('FAQ唯一ID');
            $table->string('question', 200)->comment('常见问题标题');
            $table->text('answer')->comment('问题回答内容');
            $table->integer('sort')->default(0)->comment('排序值（数字越小越靠前）');
            $table->boolean('is_show')->default(1)->comment('是否前台显示：1=显示，0=隐藏');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `faqs` COMMENT = '常见问题表（存储前台展示的FAQ列表）'");
    }
    public function down() { Schema::dropIfExists('faqs'); }
};
