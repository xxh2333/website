<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;
    // 对应你表中的字段：id/key/value/desc/timestamps
    protected $fillable = ['key', 'value', 'desc'];
    protected $table = 'configs';
    public $timestamps = true;
}
