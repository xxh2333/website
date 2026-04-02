<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id()->comment('配置ID');
            $table->string('key', 50)->unique()->comment('配置键（如：apply_switch）');
            $table->string('value', 100)->comment('配置值（如：1=开启报名，0=关闭）');
            $table->string('desc', 200)->nullable()->comment('配置描述');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('configs');
    }
};
