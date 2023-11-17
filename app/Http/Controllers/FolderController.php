<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function createFolder()
    {
        return view('folders/create');
        /*
        viewヘルパーで表示を行う。
        あくまでfolders/createの情報をレスポンスとして返している。
        実際に表示しているのはレスポンスを受け取ったviewヘルパーというLaravelの機能です。
        その為、変数等をviewで返しても、viewヘルパーが受け取り、その変数の処理を行い表示してくれる。
        その機能の事を"レンダリング"という。
        */
    }

    public function create(Request $request)
    {
        $user = Auth::user();//認証済みユーザーの取得
        
        $folder = new Folder();
        $folder -> title = $request->title;
        $folder -> user_id= $user->id;
        $folder ->save();//認証済みユーザーに紐づけて保存する必要がある。
        
        return redirect()->route('tasks.index',['id'=>$folder->user_id]);
        //リダイレクト先のURLはweb.phpに記載のあるURLを指定しています。その際、
        //web.phpにある変数{id}に値を入れて、URLを作る必要がある。
        //今回は認証済みユーザーのIDを入れています。
        //これにより、routeメソッドでURLを作成し、そこにリダイレクトしています。
    }
}