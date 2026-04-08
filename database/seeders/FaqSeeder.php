<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    public function run()
    {
        DB::table('faqs')->insert([
            [
                'question' => '报名需要满足什么条件？',
                'answer' => '全日制在校本科生/研究生，成绩良好，对实验室方向感兴趣即可报名。',
                'sort' => 1,
                'is_show' => 1
            ],
            [
                'question' => '报名后多久出审核结果？',
                'answer' => '报名截止后3个工作日内，将通过短信/邮箱通知审核结果。',
                'sort' => 2,
                'is_show' => 1
            ],
        ]);
    }
}
