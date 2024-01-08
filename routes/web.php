<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CalendarController;
use App\Events\MessageSent;
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

    // フォルダとタスクの表示機能
    Route::get('/folders/tasks', [TaskController::class, 'index'])->name('tasks.index');
    //get方式(URL,[コントローラー,呼ぶメソッド])->Routeに名前を付ける(この名前で呼び出しが可能)
    // フォルダー追加機能
    Route::post('/folders/create/', [FolderController::class, 'store'])->name('folders.store');
    // フォルダー削除機能
    Route::delete('/folders/destroy',[FolderController::class,'destroy'])->name('folders.destroy');
    // タスク追加機能
    Route::post('/folders/{id}/tasks/create', [TaskController::class, 'store'])->name('tasks.store');
    // タスク編集機能
    Route::post('/folders/{id}/tasks/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    // タスク完了機能
    Route::post('/folders/tasks/complete', [TaskController::class, 'completeTask'])->name('tasks.complete');
    // タスク削除機能
    Route::delete('/folders/tasks/{id}/destroy', [TaskController::class, 'destroy'])->name('tasks.destroy');
    // カレンダー表示用
    Route::get('calendar',[CalendarController::class, 'index'])->name('calendar.index');
    // カレンダー機能用ルーティング
    Route::get('get_events', [CalendarController::class, 'getEvents']);
});

//チャット機能追加学習用
Route::get('/chat', function () {
    event(new MessageSent);
});

require __DIR__ . '/auth.php';

/* 以下の記述は、レイアウト変更時に使わなくなったルーティング */
//ユーザートップページの表示
    /* Route::get('/top', [HomeController::class,'indexTop'])->name('top.index'); */
//タスクの詳細表示機能
    //Route::get('/folders/{id}/show',[TaskController::class,'show'])->name('tasks.show');
//フォルダの追加処理
    /* Route::get('/folders/create', [FolderController::class, 'create'])->name('folders.create'); */
//フォルダの削除機能
    //Route::get('/folders/destroy',[FolderController::class,'showDestroy'])->name('folders.destroy');
//タスクの追加処理
    //Route::get('/folders/{id}/tasks/create', [TaskController::class, 'createTask'])->name('tasks.create');
//タスクの編集処理
    //Route::get('/folders/{id}/tasks/{task_id}/edit', [TaskController::class, 'editTask'])->name('tasks.edit');
//タスクの削除処理
    //Route::get('/folders/{id}/tasks/{task_id}/destroy', [TaskController::class, 'showDestroyTask'])->name('tasks.destroy');