<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class WeatherController extends Controller
{
    public function getWeather(Request $request)
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
        //dd($weatherData);
        return view('home.home', compact('weatherData', 'cityName', 'formatWeekDays', 'startDay', 'endDay'));
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
