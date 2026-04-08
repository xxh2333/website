<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
    protected $fillable = ['question', 'answer', 'sort', 'is_show'];
    protected $table = 'faqs';
    public $timestamps = true;
}
