<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    // 表名
    protected $table = 'applications';

    // 允许批量添加的字段
    protected $fillable = [
        'name',
        'student_id',
        'phone',
        'email',
        'intro',
        'resume',
        'status'
    ];
}
