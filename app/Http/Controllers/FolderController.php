<?php

namespace App\Http\Controllers;

use App\Http\Requests\FolderCreateRequest;
use App\Http\Requests\FolderDeleteRequest;
use Illuminate\Http\Request;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class FolderController extends Controller
{

    public function store(FolderCreateRequest $request)
    {
        // 認証済みユーザーと紐づけて保存する。リレーションの活用。
        auth()->user()->folders()->create([
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


    public function destroy(FolderDeleteRequest $request)
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
