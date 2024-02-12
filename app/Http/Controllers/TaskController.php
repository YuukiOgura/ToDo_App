<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskDeleteRequest;
use App\Http\Requests\TaskEditRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller

{
    public function index()
    {
        // 認証済みユーザーの値を取得
        $user = Auth::user();
        $id = Auth::id();

        // ユーザーに関連する全てのフォルダとタスクを取得
        $userFoldersWithTasks = $user->load('folders.tasks');

        // foldersテーブルとtasksテーブルに分ける。
        $folders = $userFoldersWithTasks->folders;
        $tasks = $userFoldersWithTasks->tasks;

        // @if文に渡すための配列を準備する。
        $prioritys = [1 => '重要', 2 => '普通', 3 => '後回し'];
        // foldersにカラムがあるか判定。
        $folderFirst = $user->folders->first();
        // tasksテーブルのdel_flugが1のカラムを取得
        $grandchildren = $tasks->where('del_flug', 1);
        //dd($grandchildren);
        return view('tasks/index', [
            'folders' => $folders,
            'tasks' => $tasks,
            'user' => $user,
            'id' => $id,
            'prioritys' => $prioritys,
            'folderFirst' => $folderFirst,
            'grandchildren' => $grandchildren
        ]);
    }

    public function store(TaskCreateRequest $request)
    {
        //$current_folder = Folder::find($id);

        $task = new Task();
        $task->title = $request->title_task;
        $task->due_date = $request->due_date;
        $task->priority = $request->priority;
        $task->textarea = $request->textarea;
        $task->folder_id = $request->folders_select;
        if ($task->save()) {
            return redirect()->route('tasks.index');
        } else {
            return back()->withInput();
        }
        return redirect()->route('tasks.index');
    }



    public function edit(int $id, TaskEditRequest $request)
    {
        $task = Task::find($id);
        $task->title = $request->title_task;
        $task->due_date = $request->due_date;
        $task->priority = $request->priority;
        $task->textarea = $request->textarea;
        $task->folder_id = $request->folders_select;

        $task->save();

        return redirect()->route('tasks.index');
    }

    public function destroy(TaskDeleteRequest $request)
    {
        $task_id = $request->input('check_task', []);
        $action = $request->input('action');

        foreach ($task_id as $id) {
            $task = Task::find($id);
            if($task){
                if($action === 'delete'){
                    $task->delete();
                }
                if($action === 'update'){
                    $task->del_flug = 0;
                    $task->save();
                }
            }
        }

        return redirect()->route('tasks.index');
    }

    public function completeTask(Request $request)
    {
        $user = Auth::user();
        $task = Task::find($request->del_flug);
        $task->del_flug = 1;
        $task->save();

        /* $back_task = Task::find($request->back_task);
        if ($back_task->del_flug === 1) {
            $back_task->del_flug = 0;
            $back_task->save();
        } */

        return redirect()->route('tasks.index');
    }
}
/*
レイアウトの変更に伴い現在未使用

    public function showDestroyTask(int $id, int $task_id)
    {
         $user = Auth::user();
        $id = Auth::id();

        $folders = $user->folders;
        foreach ($folders as $folder) {
            $tasks = $folder->tasks;
            foreach ($tasks as $task) {
                $taskId = $task->id;
            }
        }
        $task_id = Task::find($taskId);
        $tasks = Task::find($task_id);
        return view('tasks/destroy', [
            'id' => $id,
            'task_id' => $task_id,
            'tasks' => $tasks
        ]);
    }

     public function editTask(int $id, int $task_id)
    {
        $tasks = Task::find($task_id);
        //dd($tasks);
        //$task = Task::find($task_id);
        return view(
            'tasks.edit',
            compact('id', 'task_id', 'tasks')
        );
    }

     public function index()
    {
        $user = Auth::user();
        $id = Auth::id();
        $folders = $user->folders;
        $foldersIds = $user->folders->pluck('id'); //認証ユーザーのfoldersテーブルのidを配列で取得
        $tasks = Task::whereIn('folder_id', $foldersIds)->get(); //foldersテーブルのカラムfoloder_idのidを取得。
        //$task_id = Task::whereIn('id',$foldersIds)->get();
        return view('tasks/index', [
            'folders' => $folders,
            'user' => $user,
            'tasks' => $tasks,
            'id' => $id,
        ]);
    } 

     public function show(int $id)
    {
        $tasks = Task::find($id);
        $id = Auth::id();
        return view('tasks.show', compact('tasks', 'id'));
    } 

     public function createTask(int $id)
    {
        $user = Auth::user();
        //$id = Auth::id();
        $folders = $user->folders;

        $folder = Auth::user()->folders()->first();
        if (!$folder || $folder->user_id === null) {
            return back();
        } else {
            return view('tasks.create', compact('id', 'folders'));
        }
    } 
*/
