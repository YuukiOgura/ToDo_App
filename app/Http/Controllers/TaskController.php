<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $folders = $user->folders;
        $foldersIds = $user->folders->pluck('id');
        $tasks = Task::whereIn('folder_id',$foldersIds)->get();
        
        return view('tasks/index',[
            'folders' => $folders,
            'user' => $user,
            'tasks'=>$tasks,
        ]);
    }
    
    public function showCreateTask(int $id)
    {
        $user = Auth::user();
        $id = Auth::id();
        $folders = $user->folders;

        return view('tasks.create', compact('id','folders'));
    }

    public function create(int $id, Request $request)
    {
        $current_folder = Folder::find($id);
        
        $task = new Task();
        $task ->title = $request->title_task;
        $task ->due_date = $request->due_date;
        $task ->priority = $request->priority;
        $task ->textarea = $request->textarea;
        $task ->folder_id = $request->folders_select;
        $task ->save();
        
        return redirect()->route('tasks.index',[
            'id'=>$current_folder->id,
        ]);
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
        $task = Task::find($task_id);

        $task ->delete();

        return redirect()->route('tasks.index',['id'=>$task->folder_id]);
    }
}
