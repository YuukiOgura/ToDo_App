<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class HomeController extends Controller
{
    //トップページとユーザーページに対するコントローラー
    public function index(Request $request)
    {
         // APIキーの取得
         $apiKey = env('OPENWEATHER_API_KEY');
         // デフォルトで浜松を指定し、リクエストから値を取得
         $city = $request->input('city', 'Hamamatsu');
         // Privateから変換された町の名前を取得
         $cityName = $this->cityName($city);
         // OpenWeatherMapに接続して、一週間分3時間ごとの天気情報を取得
         $response = Http::get("http://api.openweathermap.org/data/2.5/forecast?q=$city,jp&appid={$apiKey}&lang=ja&units=metric");
         // データをJSON型に変換
         $weatherData = $response->json();
         // 今日の日付を取得
         $startDay = Carbon::today()->format('m-d');
         // 今日を含めて6日後の日付を取得
         $endDay = Carbon::today()->addDays(5)->format('m-d');
         // データを6日間分フォーマットしてから渡す。
         $formatWeekDays = [];
         for ($i = 0; $i <= 5; $i++) {
             $formatWeekDays[] = Carbon::today()->addDays($i)->format('m-d');
         }
         $prefectures = [
            '北海道' => 'Hokkaido',
            '青森県' => 'Aomori',
            '岩手県' => 'Iwate',
            '宮城県' => 'Miyagi',
            '秋田県' => 'Akita',
            '山形県' => 'Yamagata',
            '福島県' => 'Fukushima',
            '茨城県' => 'Ibaraki',
            '栃木県' => 'Tochigi',
            '群馬県' => 'Gunma',
            '埼玉県' => 'Saitama',
            '千葉県' => 'Chiba',
            '東京都' => 'Tokyo',
            '神奈川県' => 'Kanagawa',
            '新潟県' => 'Niigata',
            '富山県' => 'Toyama',
            '石川県' => 'Ishikawa',
            '福井県' => 'Fukui',
            '山梨県' => 'Yamanashi',
            '長野県' => 'Nagano',
            '岐阜県' => 'Gifu',
            '静岡県' => 'Shizuoka',
            '愛知県' => 'Aichi',
            '三重県' => 'Mie',
            '滋賀県' => 'Shiga',
            '京都府' => 'Kyoto',
            '大阪府' => 'Osaka',
            '兵庫県' => 'Hyogo',
            '奈良県' => 'Nara',
            '和歌山県' => 'Wakayama',
            '鳥取県' => 'Tottori',
            '島根県' => 'Shimane',
            '岡山県' => 'Okayama',
            '広島県' => 'Hiroshima',
            '山口県' => 'Yamaguchi',
            '徳島県' => 'Tokushima',
            '香川県' => 'Kagawa',
            '愛媛県' => 'Ehime',
            '高知県' => 'Kochi',
            '福岡県' => 'Fukuoka',
            '佐賀県' => 'Saga',
            '長崎県' => 'Nagasaki',
            '熊本県' => 'Kumamoto',
            '大分県' => 'Oita',
            '宮崎県' => 'Miyazaki',
            '鹿児島県' => 'Kagoshima',
            '沖縄県' => 'Okinawa',
        ];
        
         //dd($weatherData);
         return view('home.home', compact('weatherData', 'cityName', 'formatWeekDays', 'startDay', 'endDay','prefectures'));
     }
 
     private function cityName($city)
     {
         if ($city === "Hamamatsu") {
             return "浜松";
         }
         if ($city === "Shizuoka") {
             return "静岡";
         }
         return $city;
     }
 
    }
