<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //トップページとユーザーページに対するコントローラー
    public function index()
    {
        return view("home/home");
    }

   /*  public function indexTop()
    {
        $name = Auth::user()->name;
        $id = Auth::id();
        return view("home/top",compact('name','id'));
    } */
}
