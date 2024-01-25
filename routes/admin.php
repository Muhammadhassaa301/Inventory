<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::prefix('user')->controller(\App\Http\Controllers\System\UserController::class)->middleware(['auth', 'role:Super Admin'])->name('admin.user.')->group(function () {
//
//    Route::get('list', 'list')->name('list');
//    Route::get('detail/{id}', 'detail')->name('detail');
//    Route::post('add', 'add')->name('add');
//    Route::post('update', 'update')->name('update');
//    Route::get('delete/{id}', 'delete')->name('delete');
//
//    Route::post('assign_role1', 'assign_role1')->name('assign_role1');
////
////    Route::get('getlist', 'getlist')->name('getlist');
////
////    Route::get('impersonate/{user_id}', 'impersonate')->name('impersonate');
////
////    Route::post('/update_target', 'update_target')->name('update_target');
//
//    Route::get('disable/login/{id}', 'disable_enable_login')->name('disable_enable_login');
//});
//
//Route::prefix('role')->controller(\App\Http\Controllers\System\RolesController::class)->middleware(['auth', 'role:Super Admin'])->name('admin.role.')->group(function () {
//
//    Route::get('list', 'list')->name('list');
//    Route::post('create', 'create')->name('create');
//    Route::post('update', 'update')->name('update');
//    Route::get('delete/{id}', 'delete')->name('delete');
//});
//
//Route::prefix('permission')->controller(\App\Http\Controllers\System\PermissionsController::class)->middleware(['auth', 'role:Super Admin'])->name('admin.permission.')->group(function () {
//
//    Route::get('list', 'list')->name('list');
//    Route::post('create', 'create')->name('create');
//    Route::post('update', 'update')->name('update');
//    Route::get('delete/{id}', 'delete')->name('delete');
//    Route::post('add_module', 'add_module')->name('add_module');
//});

