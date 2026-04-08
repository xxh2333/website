<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. 创建表（仅字段，不含表注释）
        Schema::create('configs', function (Blueprint $table) {
            // 主键ID
            $table->id()->comment('配置ID');
            // 配置键（唯一索引，如apply_switch）
            $table->string('key', 50)->unique()->comment('配置键（如：apply_switch）');
            // 配置值（如1=开启报名，0=关闭）
            $table->string('value', 100)->comment('配置值（如：1=开启报名，0=关闭）');
            // 配置描述（可选）
            $table->string('desc', 200)->nullable()->comment('配置描述');
            // 创建时间/更新时间（Laravel默认字段）
            $table->timestamps();
        });

        // 2. 单独设置表注释（兼容所有Laravel 8版本）
        DB::statement("ALTER TABLE `configs` COMMENT = '系统配置表（存储报名开关等动态业务配置，无需改代码即可调整）'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 回滚时删除configs表
        Schema::dropIfExists('configs');
    }
};
