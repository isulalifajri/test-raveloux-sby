<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\LoginController;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Notifications\DatabaseNotification;

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
    return view('auth.login');
})->name('home');

Route::get('/login', [LoginController::class,'index'])->name('login');

Route::group(['middleware' => ['auth','notification']], function () {
    // dashboard
    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');

    // users
    Route::get('users', [UserController::class,'index'])->name('users');
    Route::get('users/create', [UserController::class,'create'])->name('create.users');
    Route::post('users/store', [UserController::class,'store'])->name('store.users');
    Route::get('users/{user}/edit', [UserController::class,'edit'])->name('edit.users');
    Route::put('users/{user}/update', [UserController::class,'update'])->name('update.users');
    Route::delete('users/{user}/destroy', [UserController::class,'destroy'])->name('destroy.users');

    Route::get('users/softDelete', [UserController::class,'softDelete'])->name('softDeletes.users');
    Route::get('users/{id}/restore', [UserController::class, 'restoreData'])->name('restore.users');
    Route::delete('users/{id}/forcedelete/', [UserController::class,'forcedelete'])->name('forcedelete.users');

    // clients
    Route::get('clients', [ClientController::class,'index'])->name('clients');
    Route::get('clients/create', [ClientController::class,'create'])->name('create.clients');
    Route::post('clients/store', [ClientController::class,'store'])->name('store.clients');
    Route::get('clients/{client}/edit', [ClientController::class,'edit'])->name('edit.clients');
    Route::put('clients/{client}/update', [ClientController::class,'update'])->name('update.clients');
    Route::delete('clients/{client}/destroy', [ClientController::class,'destroy'])->name('destroy.clients');

    Route::get('clients/softDelete', [ClientController::class,'softDelete'])->name('softDeletes.clients');
    Route::get('clients/{id}/restore', [ClientController::class, 'restoreData'])->name('restore.clients');
    Route::delete('clients/{id}/forcedelete/', [ClientController::class,'forcedelete'])->name('forcedelete.clients');

    // projects
    Route::get('projects', [ProjectController::class,'index'])->name('projects');
    Route::get('projects/create', [ProjectController::class,'create'])->name('create.projects');
    Route::post('projects/store', [ProjectController::class,'store'])->name('store.projects');
    Route::get('projects/{project}/edit', [ProjectController::class,'edit'])->name('edit.projects');
    Route::put('projects/{project}/update', [ProjectController::class,'update'])->name('update.projects');
    Route::delete('projects/{project}/destroy', [ProjectController::class,'destroy'])->name('destroy.projects');
    Route::get('projects/{project}/destroyImage/{id}', [ProjectController::class,'destroyImage'])->name('projects.image.destroy');
    Route::get('projects/detail/{project}', [ProjectController::class,'detail'])->name('detail.projects');

    Route::get('projects/softDelete', [ProjectController::class,'softDelete'])->name('softDeletes.projects');
    Route::get('projects/{id}/restore', [ProjectController::class, 'restoreData'])->name('restore.projects');
    Route::delete('projects/{id}/forcedelete/', [ProjectController::class,'forcedelete'])->name('forcedelete.projects');


    // tasks
    Route::get('tasks', [TaskController::class,'index'])->name('tasks');
    Route::get('tasks/create', [TaskController::class,'create'])->name('create.tasks');
    Route::post('tasks/store', [TaskController::class,'store'])->name('store.tasks');
    Route::get('tasks/{task}/edit', [TaskController::class,'edit'])->name('edit.tasks');
    Route::put('tasks/{task}/update', [TaskController::class,'update'])->name('update.tasks');
    Route::delete('tasks/{task}/destroy', [TaskController::class,'destroy'])->name('destroy.tasks');
    Route::get('tasks/detail/{task}', [TaskController::class,'detail'])->name('detail.tasks');

    Route::get('tasks/softDelete', [TaskController::class,'softDelete'])->name('softDeletes.tasks')->middleware('role:admin');
    Route::get('tasks/{id}/restore', [TaskController::class, 'restoreData'])->name('restore.tasks')->middleware('role:admin');
    Route::delete('tasks/{id}/forcedelete/', [TaskController::class,'forcedelete'])->name('forcedelete.tasks')->middleware('role:admin');


    // route notifications
    Route::get('notifiacations', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('detail-notification/{notification}', [NotificationController::class, 'detailNotification'])->name('detail-notification');
    Route::put('mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('mark-as-read');

    // logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // test permission
    Route::get('testPermission', function () {
        return 'test permission';
    })->middleware(['permission:detail']);
    Route::get('testPermission1', function () {
        return 'test permission1';
    })->middleware(['role_or_permission:detail|admin']);

    // Manajement User
    Route::get('managementUsers/permission', [UserManagementController::class,'permission'])->name('managementUsers.permission');
    Route::get('managementUsers', [UserManagementController::class,'index'])->name('managementUsers');
    Route::get('managementUsers/edit/{user}', [UserManagementController::class,'edit'])->name('managementUsers.edit');
    Route::put('managementUsers/update/{user}', [UserManagementController::class,'update'])->name('managementUsers.update');

    // profile
    Route::get('profiles', [ProfileController::class,'index'])->name('profiles');
    Route::post('profiles/uploadImage/{user}', [ProfileController::class,'uploadImage'])->name('profiles.uploadImage');
    Route::put('profiles/update/{user}', [ProfileController::class, 'updateprofile'])->name('profiles.update');
    

    // Reset Password
    Route::get('/password/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::post('/password/forgot-password', function (Request $request) {
        $request->validate(['email' => ['required','email']]);
     
        if ((auth()->user()->email == $request->email || auth()->user()->hasRole('admin'))) {
            $status = Password::sendResetLink(
                $request->only('email')
            );
    
            return $status === Password::RESET_LINK_SENT
                        ? back()->with(['success' => __($status)])
                        : back()->withErrors(['email' => __($status)]);
        }else{
            return back()->with('success-danger', 'User Unauthorize');
        }

    })->name('password.email');

    Route::get('/password/reset-password/{token}', function ($token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed',
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('password.request')->with('success', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    })->name('password.update');

});

// login
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
});