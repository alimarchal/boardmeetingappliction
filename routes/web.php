<?php

use App\Http\Controllers\AgendaItemsController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\MeetingMinutesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
/*
        Permission::create(['name' => 'meetings-access']);
        Permission::create(['name' => 'meeting-delete']);
        Permission::create(['name' => 'meeting-create']);
        Permission::create(['name' => 'meeting-edit']);
        Permission::create(['name' => 'meeting-view']);

        Permission::create(['name' => 'agenda-item-access']);
        Permission::create(['name' => 'agenda-item-create']);
        Permission::create(['name' => 'agenda-item-add-attachment']);
        Permission::create(['name' => 'agenda-item-edit']);
        Permission::create(['name' => 'agenda-item-view']);
        Permission::create(['name' => 'agenda-item-delete']);

        Permission::create(['name' => 'attendance-access']);
        Permission::create(['name' => 'attendance-create']);
        Permission::create(['name' => 'attendance-edit']);
        Permission::create(['name' => 'attendance-view']);
        Permission::create(['name' => 'attendance-delete']);

        Permission::create(['name' => 'meeting-minutes-access']);
        Permission::create(['name' => 'meeting-minutes-create']);
        Permission::create(['name' => 'meeting-minutes-edit']);
        Permission::create(['name' => 'meeting-minutes-view']);
        Permission::create(['name' => 'meeting-minutes-delete']);

        Permission::create(['name' => 'users-access']);
        Permission::create(['name' => 'users-create']);
        Permission::create(['name' => 'users-edit']);
        Permission::create(['name' => 'users-view']);
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
 */

Route::get('/', function () {
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
    Route::delete('meeting/{meeting}',[MeetingController::class, 'destroy'])->name('meeting.destroy');

    Route::post('/meeting/{meeting}/agenda-item/store',[AgendaItemsController::class, 'store'])->name('meeting.agenda-item.store');
    Route::get('/meeting/{meeting}/agenda-item/{agendaItems}/show',[AgendaItemsController::class, 'show'])->name('meeting.agenda-item.show');
    Route::get('/meeting/{meeting}/agenda-item/{agendaItems}/edit',[AgendaItemsController::class, 'edit'])->name('meeting.agenda-item.edit');
    Route::put('/meeting/{meeting}/agenda-item/{agendaItems}/update',[AgendaItemsController::class, 'update'])->name('meeting.agenda-item.update');
    Route::delete('/meeting/{meeting}/agenda-item/{agendaItems}',[AgendaItemsController::class, 'destroy'])->name('meeting.agenda-item.destroy');

    Route::post('/meeting/{meeting}/agenda-item/{agendaItems}/store',[CommentController::class, 'store'])->name('meeting.agendaItem.comment.store');
    Route::delete('/agenda-item/{agendaItems}/comment/{comment}/destroy',[CommentController::class, 'destroy'])->name('meeting.agendaItem.comment.destroy');


    Route::resource('attendance', AttendanceController::class);

    Route::get('/meeting-minutes',[MeetingMinutesController::class, 'index'])->name('meeting-minutes.index');
    Route::get('/meeting-minutes/create',[MeetingMinutesController::class, 'create'])->name('meeting-minutes.create');
    Route::get('/meeting-minutes/{meetingMinutes}',[MeetingMinutesController::class, 'show'])->name('meeting-minutes.show');
    Route::get('/meeting-minutes/{meetingMinutes}/edit',[MeetingMinutesController::class, 'edit'])->name('meeting-minutes.edit');
    Route::put('/meeting-minutes/{meetingMinutes}',[MeetingMinutesController::class, 'update'])->name('meeting-minutes.update');
    Route::post('/meeting-minutes',[MeetingMinutesController::class, 'store'])->name('meeting-minutes.store');
    Route::delete('/meeting-minutes/{meetingMinutes}',[MeetingMinutesController::class, 'destroy'])->name('meeting-minutes.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');


//    Route::resource('agenda-items', AgendaItemsController::class);



});
