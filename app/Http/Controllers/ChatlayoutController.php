<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatlayoutController extends Controller
{
    //チャットページレイアウト用コントローラー
    public function index(){
        $user = Auth::user();
        $userAll = User::all();
        $userId = Auth::id();
        $otherUsers = [];

        foreach($userAll as $other){
            if($userId !== $other->id){
                $otherUsers[] = $other;
            }
        }
        return view('chat/chat',compact('user','otherUsers'));
    }

    public function layout(){
        $data = 'あいうえお'; // Viewに渡すデータ

        return response()->json(['data' => $data]);
    }
}
