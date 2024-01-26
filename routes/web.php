<?php

use App\Models\User;
use App\Http\Controllers\CIController;
use App\Http\Controllers\BSController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/tickets');
});

Route::get('/dashboard', function () {
    return redirect('/tickets');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/users', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('users.index');
Route::post('/users', [UserController::class, 'create'])->middleware(['auth', 'verified']);
Route::get('/users/{user}', [UserController::class, 'show'])->middleware(['auth', 'verified'])->name('users.show');
Route::post('/users/{user}/update', [UserController::class, 'update'])->middleware(['auth', 'verified'])->name('users.update');
Route::post('/users/{user}/teams/edit', [UserController::class, 'editTeams'])->middleware(['auth', 'verified'])->name('users.editteams');
Route::post('/users/{user}/teams/update', [UserController::class, 'updateTeams'])->middleware(['auth', 'verified'])->name('users.updateteams');

Route::get('/ci', [CIController::class, 'index'])->middleware(['auth', 'verified'])->name('ci.index');
Route::post('/ci', [CIController::class, 'create'])->middleware(['auth', 'verified']);
Route::get('/ci/{ci}', [CIController::class, 'show'])->middleware(['auth', 'verified'])->name('ci.show');
Route::post('/ci/{ci}/update', [CIController::class, 'update'])->middleware(['auth', 'verified'])->name('ci.update');

Route::get('/bs', [BSController::class, 'index'])->middleware(['auth', 'verified'])->name('bs.index');
Route::post('/bs', [BSController::class, 'create'])->middleware(['auth', 'verified']);
Route::get('/bs/{bs}', [BSController::class, 'show'])->middleware(['auth', 'verified'])->name('bs.show');
Route::post('/bs/{bs}/update', [BSController::class, 'update'])->middleware(['auth', 'verified'])->name('bs.update');


Route::get('/teams', [TeamController::class, 'index'])->middleware(['auth', 'verified'])->name('teams.index');
Route::post('/teams', [TeamController::class, 'create'])->middleware(['auth', 'verified']);
Route::post('/teams/{team}/update', [TeamController::class, 'update'])->middleware(['auth', 'verified'])->name('teams.update');
Route::get('/teams/{team}', [TeamController::class, 'show'])->middleware(['auth', 'verified'])->name('teams.show');
Route::get('/teams/{team}/delete', [TeamController::class, 'delete'])->middleware(['auth', 'verified']);

Route::get('/tickets', [TicketController::class, 'index'])->middleware(['auth', 'verified'])->name('tickets.index');
Route::get('/tickets/create', [TicketController::class, 'create'])->middleware(['auth', 'verified'])->name('tickets.create');
// Route::post('/tickets', [TicketController::class, 'create'])->middleware(['auth', 'verified'])->name('tickets.create');
Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->middleware(['auth', 'verified'])->name('tickets.show');
Route::post('/tickets/{ticket}/update', [TicketController::class, 'update'])->middleware(['auth', 'verified'])->name('tickets.update');
Route::post('/tickets/{ticket}/save', [TicketController::class, 'save'])->middleware(['auth', 'verified'])->name('tickets.save');
Route::post('/tickets/{ticket}/savepost', [TicketController::class, 'savepost'])->middleware(['auth', 'verified'])->name('tickets.savepost');
Route::post('/tickets/{ticket}/onhold', [TicketController::class, 'onhold'])->middleware(['auth', 'verified']);
Route::post('/tickets/{ticket}/resume', [TicketController::class, 'resume'])->middleware(['auth', 'verified']);
Route::post('/tickets/{ticket}/resolve', [TicketController::class, 'resolve'])->middleware(['auth', 'verified']);

Route::get('/views/{view}', [TicketController::class, 'view'])->middleware(['auth', 'verified'])->name('view');

Route::get('/kb', [ArticleController::class, 'index'])->middleware(['auth', 'verified'])->name('articles.index');
Route::get('/kb/{article}', [ArticleController::class, 'show'])->middleware(['auth', 'verified'])->name('articles.show');

Route::post('/updatearticle', [ArticleController::class, 'update'])->middleware(['auth', 'verified']);
Route::post('/md', [ArticleController::class, 'md'])->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
