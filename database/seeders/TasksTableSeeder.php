<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;//時間を取得するLaravelの標準機能の追加
use Illuminate\Support\Facades\DB;
class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(range(1,3) as $num)//rangeはfor文を短縮して書いたもの。
        {
            DB::table('tasks')->insert([//DBファサードを利用し、foldersテーブルを取得insertメソッドを呼び出して追加する。
                'folder_id' => 1,
                'title' => "サンプルタスク{$num}",
                'status' => $num,
                'due_date' => Carbon::now()->addDay($num),//Carbonで現在時刻を取得し、addDayで取得した日から$num日加算した日数を取得。
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
