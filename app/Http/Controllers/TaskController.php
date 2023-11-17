<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskCreateRequest;
//use App\Models\User;
use App\Models\Folder;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller

{
    public function index()
    {
        //$user = Auth::user()->id;
        //$folders = User::find($user)->folders;
        $user = Auth::user();
        $id = Auth::id();
        $folders = $user->folders;
        $foldersIds = $user->folders->pluck('id');//認証ユーザーのfoldersテーブルのidを配列で取得
        $tasks = Task::whereIn('folder_id',$foldersIds)->get();//foldersテーブルのカラムfoloder_idのidを取得。
        //$task_id = Task::whereIn('id',$foldersIds)->get();
        return view('tasks/index',[
            'folders' => $folders,
            'user' => $user,
            'tasks'=>$tasks,
            'id' =>$id,
        ]);
    }
    
    public function show(int $id){
        $tasks =Task::find($id);
        $id = Auth::id();
        return view('tasks.show',compact('tasks','id'));
    }

    public function createTask(int $id)
    {
        $user = Auth::user();
        //$id = Auth::id();
        $folders = $user->folders;

        return view('tasks.create', compact('id','folders'));
    }

    public function create(int $id, TaskCreateRequest $request )
    {
        //$current_folder = Folder::find($id);
        
        $task = new Task();
        $task ->title = $request->title_task;
        $task ->due_date = $request->due_date;
        $task ->priority = $request->priority;
        $task ->textarea = $request->textarea;
        $task ->folder_id = $request->folders_select;
        if ($task->save()) {
            return redirect()->route('tasks.index', ['id' => $id]);
        } else {
            return back()->withInput();
        }
        return redirect()->route('tasks.index',[
            'id'=>$id,
        ]);
    }

    public function editTask(int $id,int $task_id)
    {
        $tasks= Task::find($task_id);
        //dd($tasks);
        //$task = Task::find($task_id);
        return view('tasks.edit',
            compact('id','task_id','tasks'));
    }

    public function edit(int $id, int $task_id, Request $request)
    {
        $task = Task::find($task_id);

        $task ->title = $request->title_edit;
        $task ->textarea = $request->textarea_edit;
        $task ->due_date = $request->due_date_edit;
        $task ->priority = $request->priority_edit;

        $task->save();

        return redirect()->route('tasks.index',['id'=>$task->folder_id]);
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
        return view('tasks/destroy',[
            'id'=>$id,
            'task_id'=>$task_id,
            'tasks' => $tasks
        ]);
    }
    

    public function destroy(Request $request ,int $id,/* int $task_id */)
    {
        $task_id = $request->input('task_id');
        $task = Task::where('id', (int)$task_id)->where('del_flug', 1)->first();
        if ($task) {
            $task->delete();
        }
        
        //$task ->delete();
        
        return redirect()->route('tasks.index',['id'=>$id]);
    }

    public function completeTask(Request $request){
        $id = Auth::id();
        $task = Task::find($request->del_flug);
        
        if ($task) {
            $task->del_flug = 1;
            $task ->save(); 
        }
        $del_flug_id = Task::where('folder_id', $task->id)
                 ->where('del_flug', 0) // ここでdel_flugが0（非表示でない）を指定
                 ->get();
        return redirect()->route('tasks.index',['id' =>$id, 'del_flug_id' => $del_flug_id]);
    }
}
