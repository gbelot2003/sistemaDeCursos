<?php

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Curso;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard', [
            'query' => Curso::select('cursos.id', 'cursos.nombre', DB::raw('COUNT(curso_student.student_id) as total_estudiantes'))
                ->join('curso_student', 'cursos.id', '=', 'curso_student.curso_id')
                ->whereBetween(
                    'created_at',
                    [Carbon::now()->subMonth(6), Carbon::now()]
                )
                ->groupBy('cursos.id', 'cursos.nombre')
                ->orderByDesc('total_estudiantes')
                ->take(3)
                ->get()
        ]);
    })->name('dashboard');

    // Cursos Routes
    Route::get('/cursos', [CursoController::class, 'index'])->name('cursos.index');
    Route::get('/cursos/create', [CursoController::class, 'create'])->name('cursos.create');
    Route::post('/cursos', [CursoController::class, 'store'])->name('cursos.store');
    Route::get('/cursos/{curso}/edit', [CursoController::class, 'edit'])->name('cursos.edit');
    Route::get('/cursos/{curso}', [CursoController::class, 'show'])->name('cursos.show');
    Route::post('cursos/{curso}', [CursoController::class, 'update'])->name('cursos.update');
    Route::post('/cursos-destroy/{id}', [CursoController::class, 'delete'])->name('cursos.delete');



    // Estudiantes Routes
    Route::get('/estudiantes', [StudentController::class, 'index'])->name('students.index');
    Route::get('/estudiantes/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/estudiantes', [StudentController::class, 'store'])->name('students.store');
    Route::get('/estudiantes/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::post('/estudiantes/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::post('/estudiantes-destroy/{id}', [StudentController::class, 'delete'])->name('students.delete');
    Route::get('/estudiantes/{student}', [StudentController::class, 'show']);

});
