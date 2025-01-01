<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ViewsController;
use App\Http\Controllers\UserAuth;
use App\Http\Controllers\BoardsController;
use App\Http\Controllers\TasksController;

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

//rotas de views
Route::get('/',[ViewsController::class, 'index']);
Route::get('/new',[ViewsController::class, 'cadastro']);
Route::get('/home',[ViewsController::class, 'home']);

//rotas de authentication
Route::post('/new',[UserAuth::class, 'newCadastro']);
Route::post('/',[UserAuth::class, 'login']);
Route::get('/logout',[UserAuth::class, 'logout']);

//rotas dos quadros
Route::get('/home/{board_name}', [BoardsController::class, 'getBoard']);
Route::post('/home/new', [BoardsController::class, 'newBoard']);
Route::delete('/home/{boardName}', [BoardsController::class, 'deleteBoard']);

//rotas das tarefas
Route::post('/home/task/new', [TasksController::class, 'newTask']);
Route::put('/home/task/update', [TasksController::class, 'updateTask']);
Route::put('/home/task/updateChecked', [TasksController::class, 'updateTaskChecked']);
Route::delete('/home/{boardName}/{taskId}', [TasksController::class, 'deleteTask']);
