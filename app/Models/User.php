<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // 保留认证功能
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable // 注意：继承 Authenticatable 而非普通 Model
{
    use HasFactory, Notifiable;

    /**
     * 允许批量赋值的字段（包含默认+新增字段）
     */
    protected $fillable = [
        'name', 'email', 'password', // 默认字段
        'student_id', 'phone', 'avatar' // 新增业务字段
    ];

    /**
     * 隐藏敏感字段（密码）
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * 字段类型转换（可选）
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // 关联报名记录（一个用户可有多条报名记录）
    public function applications()
    {
        return $this->hasMany(\App\Models\Application::class);
    }
}
