<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller

//Viewで書いた値が、ルート（web.php）に入って、その入った値が下記の引数に入る。
{
    public function index(int $id)//URLから渡ってきた引数
    {
        $folders=Folder::where('user_id',Auth::user()->id)->get();
        //下記の記述を変更して認証済みユーザーのテーブルだけ表示できた。
        //$folders = Folder::all();//Folderモデルの情報を全て取得
        $current_folder = Folder::find($id);//プライマリーキーのレコードを1行取得(indexに渡ってきたURLの引数を元に取得)

        $tasks = $current_folder->tasks()->get();//Folder::find($id)と同じfolder_idレコードを持つ値をTaskクラス通しタスクテーブルから取得する。 

        return view('tasks/index',[//tasks.indexに値を渡す
            'folders' => $folders,//Folderモデルの情報を渡す
            'current_folder_id' => $current_folder->id,
            //Folderモデル中にあるidを呼び出して渡す（Folder::find($id)ではレコード毎取ってきている為、idを指定）

            'tasks'=>$tasks,
        ]);
    }
    
    public function showCreateTask(int $id)//tasks/createにURLに入っているidを渡す。
    {
        return view('tasks/create',[
            'folder_id'=>$id,
        ]);
    }

    public function create(int $id, Request $request)
    {
        $current_folder = Folder::find($id);

        $task = new Task();
        $task ->title = $request->title_task;
        $task ->due_date = $request->due_date;

        $current_folder->tasks()->save($task);

        return redirect()->route('tasks.index',['id'=>$current_folder->id]);
    }

    public function showEditTask(int $id,int $task_id)
    {
        $task = Task::find($task_id);
        return view('tasks/edit',[
            'task'=>$task, 
        ]);
    }

    public function edit(int $id, int $task_id, Request $request)
    {
        $task = Task::find($task_id);

        $task ->title = $request->title_edit;
        $task ->due_date = $request->due_date_edit;

        $task->save();

        return redirect()->route('tasks.index',['id'=>$task->folder_id]);
    }

    public function showDestroyTask(int $id, int $task_id)
    {
        $task = Task::find($task_id);
        return view('tasks/destroy',[
            'task'=>$task
        ]);
    }

    public function destroy(int $id, int $task_id, Request $request)
    {
        $task = Task::find($task_id);//レコードを1行取得

        $task ->delete();

        return redirect()->route('tasks.index',['id'=>$task->folder_id]);
    }
}
