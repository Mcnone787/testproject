<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\RecursoController;


use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Curso;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'cursos' => Curso::all()->where("visible","1"),
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name("home");

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'cursos' => Curso::all(),
        
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::post('/createcurso', [CursosController::class, 'createcurso'])->name('createcurso');
Route::post('/getALlCursos', [CursosController::class, 'getALlCursos'])->name('getALlCursos');

Route::get('/recurso/{id}', [RecursoController::class, 'recursoIndex'])->name('recursoIndex');

Route::post('/createrecurso', [RecursoController::class, 'createrecurso'])->name('createrecurso');
Route::post('/getALlRecursos', [RecursoController::class, 'getALlRecursos'])->name('getALlRecursos');
Route::post('/editRecurso', [RecursoController::class, 'editRecurso'])->name('editRecurso');
Route::post('/loadRecruso', [RecursoController::class, 'loadRecruso'])->name('loadRecruso');
Route::post('/deleteRecurso', [RecursoController::class, 'deleteRecurso'])->name('deleteRecurso');

Route::get('/Recursos_Users/{id}', [RecursoController::class, 'Recursos_Users'])->name('Recursos_Users');

Route::get('/infoRecurso/{id}', [RecursoController::class, 'infoRecurso'])->name('infoRecurso');


require __DIR__.'/auth.php';
