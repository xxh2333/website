<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'image_url', 'description', 'sort', 'is_show'];
    protected $table = 'galleries';
    public $timestamps = true;
}
