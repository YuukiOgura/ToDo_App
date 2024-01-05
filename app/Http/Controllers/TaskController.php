<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskCreateRequest;
use App\Models\Folder;
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
        $prioritys = [1 => '重要', 2 =>'普通' , 3 =>'後回し'];
        $folderFirst = $user->folders()->first();
        // priorityの値に合わせて、配列を返す。
        /* $priorityHigh = $userFoldersWithTasks->folders->flatMap->tasks->where('priority', '重要')->all();
        $priorityMiddle = $userFoldersWithTasks->folders->flatMap->tasks->where('priority', '普通')->all();
        $priorityLow = $userFoldersWithTasks->folders->flatMap->tasks->where('priority', '後回し')->all(); */
    
        return view('tasks/index', [
            'folders' => $folders,
            'tasks' => $tasks,
            'user' => $user,
            'id' => $id,
            'prioritys' => $prioritys,
            'folderFirst' => $folderFirst,
            
            /* 'priorityHigh' => $priorityHigh,
            'priorityMiddle' => $priorityMiddle,
            'priorityLow' => $priorityLow, */
        ]);
    }
    /* public function index()
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
    } */

    /* public function show(int $id)
    {
        $tasks = Task::find($id);
        $id = Auth::id();
        return view('tasks.show', compact('tasks', 'id'));
    } */

   /*  public function createTask(int $id)
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
    } */

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

   /*  public function editTask(int $id, int $task_id)
    {
        $tasks = Task::find($task_id);
        //dd($tasks);
        //$task = Task::find($task_id);
        return view(
            'tasks.edit',
            compact('id', 'task_id', 'tasks')
        );
    } */

    public function edit(int $id ,TaskCreateRequest $request)
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

    public function showDestroyTask(int $id, int $task_id)
    {
        /* $user = Auth::user();
        $id = Auth::id();

        $folders = $user->folders;
        foreach ($folders as $folder) {
            $tasks = $folder->tasks;
            foreach ($tasks as $task) {
                $taskId = $task->id;
            }
        }
        $task_id = Task::find($taskId); */
        $tasks = Task::find($task_id);
        return view('tasks/destroy', [
            'id' => $id,
            'task_id' => $task_id,
            'tasks' => $tasks
        ]);
    }


    public function destroy(Request $request)
    {
        $task_id = $request->input('task_id');
        $task = Task::where('id', $task_id)->where('del_flug', 1)->first();
        if ($task) {
            $task->delete();
        }

        //$task ->delete();

        return redirect()->route('tasks.index');
    }

    public function completeTask(Request $request)
    {
        $id = Auth::id();
        $task = Task::find($request->del_flug);

        if ($task) {
            $task->del_flug = 1;
            $task->save();
        }
        $del_flug_id = Task::where('folder_id', $task->id)
            ->where('del_flug', 0) // ここでdel_flugが0（非表示でない）を指定
            ->get();
        return redirect()->route('tasks.index', ['del_flug_id' => $del_flug_id]);
    }
}
