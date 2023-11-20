<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    /* 
    foldersテーブル'id'とtasksテーブルの'folder_id'を紐付ける（リレーション）為に
    FolderモデルにTaskモデルのカラムを取得する記載をする。
    これによりコントローラーからテーブルの情報を取得する為のコードを読みやすい形に変える事が出来る。
    (情報を取得するだけならコントローラーからの記載だけで出来る)
    */
    
    
    public static function boot(){
        parent::boot();
        static::deleting(function($folder){
            $folder->tasks()->delete();
        });
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /* 
    メソッドtasksを作成
    多くの(hasMany)カラムを持っているTaskモデルを呼び出す。
    このようにテーブル同士を紐づけ、関連付ける事（リレーション）で
    Folderクラス(class)のインスタンスから、紐づいたTaskクラス(class)の情報を取得する

    hasManyは引数を省略できる
    上記のを正式に書くと……
    hasMany('App\Models\Task',folder_id,id)
    hasMany(リレーション先,取得したいカラム,連携させたい自分のカラム)
    なのだが、
    hasMany(リレーション先,単数形のカラム,id)
    の時は省略が可能。
    */
}
