<?php

use App\Http\Controllers\AlunoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/teste', function(){
//     return 'cheguei na rota de teste';
// });

Route::get('/alunos', [AlunoController::class, 'index'])->name('alunos.index');

Route::get('/alunos/{aluno}', [AlunoController::class, 'show'])->name('alunos.show');

Route::post('/alunos', [AlunoController::class, 'store'])->name('alunos.store');

Route::put('/alunos/{aluno}', [AlunoController::class, 'update'])->name('alunos.update');

Route::delete('/alunos', function(){
    return 'apagar aluno';
})->name('alunos.destroy');


