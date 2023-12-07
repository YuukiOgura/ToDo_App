<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CalendarController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,'index'])->name('home.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //ユーザートップページの表示
    Route::get('/top', [HomeController::class,'indexTop'])->name('top.index');

    //フォルダとタスクの表示機能
    Route::get('/folders/{id}/tasks', [TaskController::class, 'index'])->name('tasks.index');
    //get方式(URL,[コントローラー,呼ぶメソッド])->Routeに名前を付ける(この名前で呼び出しが可能)

    //カレンダーの表示
    Route::get('get_events', [CalendarController::class, 'getEvents']);

    //タスクの詳細表示機能
    Route::get('/folders/{id}/show',[TaskController::class,'show'])->name('tasks.show');
    
    //フォルダの追加処理
    Route::get('/folders/create', [FolderController::class, 'createFolder'])->name('folders.create');
    Route::post('/folders/create/', [FolderController::class, 'create']);
    
    //フォルダの削除機能
    Route::get('/folders/destroy',[FolderController::class,'showDestroy'])->name('folders.destroy');
    Route::delete('/folders/destroy',[FolderController::class,'destroy']);

    //タスクの追加処理
    Route::get('/folders/{id}/tasks/create', [TaskController::class, 'createTask'])->name('tasks.create');
    Route::post('/folders/{id}/tasks/create', [TaskController::class, 'create']);
    
    //タスクの編集処理
    Route::get('/folders/{id}/tasks/{task_id}/edit', [TaskController::class, 'editTask'])->name('tasks.edit');
    Route::post('/folders/{id}/tasks/{task_id}/edit', [TaskController::class, 'edit']);
    
    //タスクの完了処理
    Route::post('/folders/{id}/tasks/{task_id}/complete', [TaskController::class, 'completeTask'])->name('tasks.complete');
    
    //タスクの削除処理
    Route::get('/folders/{id}/tasks/{task_id}/destroy', [TaskController::class, 'showDestroyTask'])->name('tasks.destroy');
    Route::delete('/folders/{id}/tasks/{task_id}/destroy', [TaskController::class, 'destroy']);
});

require __DIR__ . '/auth.php';
