<?php

namespace App\Http\Controllers;

use App\Http\Requests\FolderCreateRequest;
use Illuminate\Http\Request;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class FolderController extends Controller
{
    public function create()
    {
        /* return view('folders/create'); */
        /*
        viewヘルパーで表示を行う。
        あくまでfolders/createの情報をレスポンスとして返している。
        実際に表示しているのはレスポンスを受け取ったviewヘルパーというLaravelの機能です。
        その為、変数等をviewで返しても、viewヘルパーが受け取り、その変数の処理を行い表示してくれる。
        その機能の事を"レンダリング"という。
        */
    }

    public function store(FolderCreateRequest $request)
    {

        // 認証済みユーザーIDの取得
        $id = Auth::id();
        // 認証済みユーザーと紐づけて保存する。リレーションの活用。
        $folder = auth()->user()->folders()->create([
            'title' => $request->title
        ]);
        // 認証済みユーザーのIDをもとにリダイレクトする。
        return redirect()->route('tasks.index');

        /* 
        こちらの記載でもDBへの登録は出来ます。
        $folder = new Folder();
        // foldersテーブルにデータを挿入する。
        $folder -> title = $request->title;
        $folder -> user_id= $id;
        //挿入したデータを保存する。
        $folder ->save();
        */
    }

    public function showDestroy()
    {
        // 認証済みユーザーのIDを取得
        $id = Auth::id();
        // リレーションにて、紐づいているfoldersテーブルの情報を取得する。
        $folders = Auth::user()->folders;
        // ページを表示し、値を渡す
        return view('folders.destroy', compact('folders', 'id'));
    }

    public function destroy(Request $request)
    {
        // bladeのname = "check_folder[]"として、配列として送ってきた値を取得する。
        $check_folder = $request->input('check_folder', []);
        // 繰り返し処理を行い、受取った値を持つカラムに紐づいたtasksカラムを削除する。
        foreach ($check_folder as $folder_id) {
            Folder::find($folder_id)->tasks()->delete();
        }
        // 受け取ったid値を持つFolderカラムを削除する。
        Folder::whereIn('id', $check_folder)->delete();
        // 元のURLに戻る。
        return redirect()->route('tasks.index');
    }
}
