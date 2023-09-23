<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\HomeController;
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

/*Route::get('/', function () {
    return view('home/home');
});
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

    //フォルダとタスクの表示機能
    Route::get('/folders/{id}/tasks', [TaskController::class, 'index'])->name('tasks.index');
    //get方式(URL,[コントローラー,呼ぶメソッド])->Routeに名前を付ける(この名前で呼び出しが可能)
    
    //フォルダの追加処理
    Route::get('/folders/create', [FolderController::class, 'showCreateFolder'])->name('folders.create');
    Route::post('/folders/create/', [FolderController::class, 'create']);
    
    //タスクの追加処理
    Route::get('/folders/{id}/tasks/create', [TaskController::class, 'showCreateTask'])->name('tasks.create');
    Route::post('/folders/{id}/tasks/create', [TaskController::class, 'create']);
    
    //タスクの編集処理
    Route::get('/folders/{id}/tasks/{task_id}/edit', [TaskController::class, 'showEditTask'])->name('tasks.edit');
    Route::post('/folders/{id}/tasks/{task_id}/edit', [TaskController::class, 'edit']);
    
    //タスクの削除処理
    Route::get('/folders/{id}/tasks/{task_id}/destroy', [TaskController::class, 'showDestroyTask'])->name('tasks.destroy');
    Route::post('/folders/{id}/tasks/{task_id}/destroy', [TaskController::class, 'destroy']);
    
    //ホームページの表示
    Route::get('/', [HomeController::class, 'index'])->name('home');
    //Route::middleware('auth')->group(function () {の中に記述する事で全てのページで認証機能を使用する事が出来る。

require __DIR__ . '/auth.php';
