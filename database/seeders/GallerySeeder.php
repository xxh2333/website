<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GallerySeeder extends Seeder
{
    public function run()
    {
        DB::table('galleries')->insert([
            [
                'title' => '实验室环境',
                'image_url' => asset('images/gallery/1.jpg'),
                'description' => '实验室办公区域，配备高性能开发设备',
                'sort' => 1,
                'is_show' => 1
            ],
            [
                'title' => '项目研讨会议',
                'image_url' => asset('images/gallery/2.jpg'),
                'description' => '团队定期开展项目研讨与技术分享',
                'sort' => 2,
                'is_show' => 1
            ],
        ]);
    }
}
