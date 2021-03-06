<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BirthdayController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\ReminderController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\CalendarController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/events', [CalendarController::class, 'index']);

Route::post('/birthday-store', [BirthdayController::class, 'store']);
Route::put('/birthday-update', [BirthdayController::class, 'update']);
Route::post('/birthday-destroy', [BirthdayController::class, 'destroy']);

Route::post('/event-store', [EventController::class, 'store']);
Route::put('/event-update', [EventController::class, 'update']);
Route::post('/event-destroy', [EventController::class, 'destroy']);

Route::post('/reminder-store', [ReminderController::class, 'store']);
Route::put('/reminder-update', [ReminderController::class, 'update']);
Route::post('/reminder-destroy', [ReminderController::class, 'destroy']);

Route::post('/task-store', [TaskController::class, 'store']);
Route::put('/task-update', [TaskController::class, 'update']);
Route::post('/task-destroy', [TaskController::class, 'destroy']);

Route::post('/login', \App\Http\Controllers\API\AuthController::class);

Route::post('/update-colors', [CalendarController::class, 'updateColors']);

Route::post('confirm-event', [EventController::class, 'confirm']);
