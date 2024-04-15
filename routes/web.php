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
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

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


require __DIR__.'/auth.php';
