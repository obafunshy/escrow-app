<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BlockonomicsController;

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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/escrow/initiate', function () {
        return view('escrow.initiate');
    })->name('escrow.initiate');

    Route::post('/escrow/initiate', [TransactionController::class, 'initiateTransaction']);

    Route::get('/escrow/dashboard', [TransactionController::class, 'viewEscrowDashboard'])->name('escrow.dashboard');

    Route::post('/blockonomics/callback', [BlockonomicsController::class, 'handleCallback'])->name('blockonomics.callback');
});

require __DIR__.'/auth.php';

Route::prefix('dashboard')->middleware(['auth'])->group(function () {

    Route::prefix('admin')->group(function() {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/posts', [AdminController::class, 'showPosts'])->name('admin.posts.index');
    });

    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('posts.index');
        Route::get('/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/store', [PostController::class, 'store'])->name('posts.store');
        Route::get('/{post:slug}', [PostController::class, 'show'])->name('posts.show');

        Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
        Route::get('/tags/{tag}', [TagController::class, 'show'])->name('tags.show');
    });
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
