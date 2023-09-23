<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;//ファサードの使用の為に記載
use Carbon\Carbon;//Laravelに標準搭載されているPHPの日付を使う為のパッケージ
class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    //Seederはテストデータを挿入する物
    //勘違い（DBのデフォルト値を入れる物ではない！！！！！！！！！！！）
    //DBの設定はMigrationかModelに記載、Seederはあくまでも動作を確認する為のテストデータの挿入
    public function run(): void
    {

        $user= DB::table('users')->first();//first()メソッドはレコード1行"だけ"を取得する

        $titles = ['プライベート','仕事','勉強'];

        foreach($titles as $title){
            DB::table('folders')->insert([
                'title' => $title,
                'user_id'=>$user->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
