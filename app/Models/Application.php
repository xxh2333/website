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
        'department_id',
        'user_id',
        'phone',
        'email',
        'intro',
        'resume_path',
        'resume',
        'status',
        'review_comment',
        'reviewed_by',
        'reviewed_at',
        'review_note',
    ];


    protected $casts = [
        'reviewed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    // ========== 新增这行：关联学员（User） ==========
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 关联部门
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // 关联审核人
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    // 状态访问器
    public function getStatusTextAttribute()
    {
        $map = [
            'pending' => '待审核',
            'approved' => '已通过',
            'rejected' => '已拒绝',
        ];
        return $map[$this->status] ?? '未知';
    }

    // 获取简历URL
    public function getResumeUrlAttribute()
    {
        if ($this->resume_path) {
            return asset('storage/' . $this->resume_path);
        }
        return null;
    }
}
