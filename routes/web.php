<?php

use App\Http\Controllers\AgendaItemsController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\MeetingMinutesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
//    return view('welcome');
    return to_route('login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::get('/dashboard',[DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/meeting',[MeetingController::class, 'index'])->name('meeting.index');
    Route::get('/meeting/{meeting}/show',[MeetingController::class, 'show'])->name('meeting.show');
    Route::get('/meeting/{meeting}/edit',[MeetingController::class, 'edit'])->name('meeting.edit');
    Route::get('/meeting/create',[MeetingController::class, 'create'])->name('meeting.create');
    Route::post('/meeting',[MeetingController::class, 'store'])->name('meeting.store');
    Route::put('/meeting/{meeting}',[MeetingController::class, 'update'])->name('meeting.update');

    Route::post('/meeting/{meeting}/comment',[CommentController::class, 'store'])->name('comment.store');
    Route::delete('/meeting/{comment}/destroy',[CommentController::class, 'destroy'])->name('comment.destroy');

    Route::resource('attendance', AttendanceController::class);

    Route::get('/meeting-minutes',[MeetingMinutesController::class, 'index'])->name('meeting-minutes.index');
    Route::get('/meeting-minutes/create',[MeetingMinutesController::class, 'create'])->name('meeting-minutes.create');
    Route::get('/meeting-minutes/{meetingMinutes}',[MeetingMinutesController::class, 'show'])->name('meeting-minutes.show');
    Route::get('/meeting-minutes/{meetingMinutes}/edit',[MeetingMinutesController::class, 'edit'])->name('meeting-minutes.edit');
    Route::put('/meeting-minutes/{meetingMinutes}',[MeetingMinutesController::class, 'update'])->name('meeting-minutes.update');
    Route::post('/meeting-minutes',[MeetingMinutesController::class, 'store'])->name('meeting-minutes.store');
    Route::delete('/meeting-minutes/{meetingMinutes}',[MeetingMinutesController::class, 'destroy'])->name('meeting-minutes.destroy');


//    Route::resource('agenda-items', AgendaItemsController::class);



});
