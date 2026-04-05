<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('student_id',191);
            $table->string('phone',191);
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('status')->default('pending');
            $table->text('content')->nullable();
            // 根据你的实际需求添加其他字段
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
