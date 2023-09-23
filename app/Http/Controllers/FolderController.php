<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;

class FolderController extends Controller
{
    public function showCreateFolder()
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
        $folder = new Folder();
        $folder -> title = $request->title;
        $folder ->save();
        
        return redirect()->route('tasks.index',['id'=>$folder->id]);
    }
}
