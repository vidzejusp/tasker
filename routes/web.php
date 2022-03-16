<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminPanel\PermissionController;
use App\Http\Controllers\UploadController;
use App\Http\Middleware\CheckEmployee;
use Illuminate\Support\Facades\Route;

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
//Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
//    return view('tasks');
//})->name('tasks');

Route::middleware(['auth', 'check_restriction'])->group(function () {
    Route::middleware('employee.check:true')->group(function () {
        Route::get('/', function () {
            return view('tasks.dashboard');
        })->name('dashboard');
        Route::prefix('tasks/')->name('tasks.')->group(function () {
            Route::get('control', function () {
                return view('tasks.control');
            })->name('control');
        });
        Route::prefix('task/')->name('task.')->group(function () {
            Route::get('/new', function () {
                return view('tasks.new');
            })->name('new');
        });
        Route::get('/control/users', function () {
            return view('control-panel/users');
        })->name('users');
        Route::post('/switch', [CompanyController::class, 'switch'])->name('switch');

        Route::get('/notes', function () {
           return view('notes/index');
        })->name('notes.index');
    });
    Route::prefix('employee')->name('employee.')->group(function () {
        Route::middleware('employee.check:false')->group(function () {
            Route::get('/login', [EmployeeController::class, 'login'])->name('login');
            Route::post('/auth', [EmployeeController::class, 'auth'])->name('auth');
        });
        Route::middleware('employee.check:true')->group(function () {
            Route::post('/logout', [EmployeeController::class, 'logout'])->name('logout');
        });
    });
    Route::prefix('admin')->name('admin.')->group(function() {
       Route::get('/permissions', function () {
           return view('admin-panel/permissions');
       })->name('permissions');
    });

    Route::post('/upload/{folder}', [UploadController::class, 'upload']);
});

Route::get('/app', function () {
    $path = public_path() . '/taskeris.apk';
    return response()->file($path, [
        'Content-Type'=>'application/vnd.android.package-archive',
        'Content-Disposition'=> 'attachment; filename="taskeris.apk"',
    ]);
});
