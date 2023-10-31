<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //トップページとユーザーページに対するコントローラー
    public function index()
    {
        return view("home/home");
    }

    public function indexTop()
    {
        return view("home/top");
    }
}
