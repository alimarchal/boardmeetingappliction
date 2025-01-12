<?php

use App\Http\Controllers\AgendaItemsController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommitteeMeetingAgendaItemController;
use App\Http\Controllers\CommitteeMeetingCommentController;
use App\Http\Controllers\CommitteeMeetingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\MeetingMinutesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommitteeController;
use Illuminate\Support\Facades\Route;

use Spatie\Permission\Models\Permission;

Route::get('/', function () {
    return to_route('login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/meeting', [MeetingController::class, 'index'])->name('meeting.index');
    Route::get('/meeting/{meeting}/show', [MeetingController::class, 'show'])->name('meeting.show');
    Route::get('/meeting/{meeting}/edit', [MeetingController::class, 'edit'])->name('meeting.edit');
    Route::get('/meeting/create', [MeetingController::class, 'create'])->name('meeting.create');
    Route::post('/meeting', [MeetingController::class, 'store'])->name('meeting.store');
    Route::put('/meeting/{meeting}', [MeetingController::class, 'update'])->name('meeting.update');
    Route::delete('meeting/{meeting}', [MeetingController::class, 'destroy'])->name('meeting.destroy');

    Route::post('/meeting/{meeting}/agenda-item/store', [AgendaItemsController::class, 'store'])->name('meeting.agenda-item.store');
    Route::get('/meeting/{meeting}/agenda-item/{agendaItems}/show', [AgendaItemsController::class, 'show'])->name('meeting.agenda-item.show');
    Route::get('/meeting/{meeting}/agenda-item/{agendaItems}/edit', [AgendaItemsController::class, 'edit'])->name('meeting.agenda-item.edit');
    Route::put('/meeting/{meeting}/agenda-item/{agendaItems}/update', [AgendaItemsController::class, 'update'])->name('meeting.agenda-item.update');
    Route::delete('/meeting/{meeting}/agenda-item/{agendaItems}', [AgendaItemsController::class, 'destroy'])->name('meeting.agenda-item.destroy');

    Route::post('/meeting/{meeting}/agenda-item/{agendaItems}/store', [CommentController::class, 'store'])->name('meeting.agendaItem.comment.store');
    Route::delete('/agenda-item/{agendaItems}/comment/{comment}/destroy', [CommentController::class, 'destroy'])->name('meeting.agendaItem.comment.destroy');


    Route::resource('attendance', AttendanceController::class);

    Route::get('/meeting-minutes', [MeetingMinutesController::class, 'index'])->name('meeting-minutes.index');
    Route::get('/meeting-minutes/create', [MeetingMinutesController::class, 'create'])->name('meeting-minutes.create');
    Route::get('/meeting-minutes/{meetingMinutes}', [MeetingMinutesController::class, 'show'])->name('meeting-minutes.show');
    Route::get('/meeting-minutes/{meetingMinutes}/edit', [MeetingMinutesController::class, 'edit'])->name('meeting-minutes.edit');
    Route::put('/meeting-minutes/{meetingMinutes}', [MeetingMinutesController::class, 'update'])->name('meeting-minutes.update');
    Route::post('/meeting-minutes', [MeetingMinutesController::class, 'store'])->name('meeting-minutes.store');
    Route::delete('/meeting-minutes/{meetingMinutes}', [MeetingMinutesController::class, 'destroy'])->name('meeting-minutes.destroy');


    // Routes for CommitteeMeeting
    Route::get('/committee-meeting', [CommitteeMeetingController::class, 'index'])->name(name: 'committee_meeting.index');
    Route::get('/committee-meeting/create', [CommitteeMeetingController::class, 'create'])->name('committee_meeting.create');
    Route::post('/committee-meeting', [CommitteeMeetingController::class, 'store'])->name('committee_meeting.store');
    Route::get('/committee-meeting/{committeeMeeting}/show', [CommitteeMeetingController::class, 'show'])->name('committee_meeting.show');
    Route::get('/committee-meeting/{committeeMeeting}/edit', [CommitteeMeetingController::class, 'edit'])->name('committee_meeting.edit');
    Route::put('/committee-meeting/{committeeMeeting}', [CommitteeMeetingController::class, 'update'])->name('committee_meeting.update');
    Route::delete('/committee-meeting/{committeeMeeting}', [CommitteeMeetingController::class, 'destroy'])->name('committee_meeting.destroy');

    // Routes for CommitteeMeetingAgendaItem
    Route::get('/committee-meeting/{committeeMeeting}/agenda-item/create', [CommitteeMeetingAgendaItemController::class, 'create'])->name('committee_meeting.agenda_item.create');
    Route::post('/committee-meeting/{committeeMeeting}/agenda-item', [CommitteeMeetingAgendaItemController::class, 'store'])->name('committee_meeting.agenda_item.store');
    Route::get('/committee-meeting/{committeeMeeting}/agenda-item/{committeeMeetingAgendaItem}/show', [CommitteeMeetingAgendaItemController::class, 'show'])->name('committee_meeting.agenda_item.show');
    Route::get('/committee-meeting/{committeeMeeting}/agenda-item/{committeeMeetingAgendaItem}/edit', [CommitteeMeetingAgendaItemController::class, 'edit'])->name('committee_meeting.agenda_item.edit');
    Route::put('/committee-meeting/{committeeMeeting}/agenda-item/{committeeMeetingAgendaItem}', [CommitteeMeetingAgendaItemController::class, 'update'])->name('committee_meeting.agenda_item.update');
    Route::delete('/committee-meeting/{committeeMeeting}/agenda-item/{committeeMeetingAgendaItem}', [CommitteeMeetingAgendaItemController::class, 'destroy'])->name('committee_meeting.agenda_item.destroy');

    // Routes for CommitteeMeetingComment
    Route::post('/committee-meeting/{committeeMeeting}/agenda-item/{committeeMeetingAgendaItem}/comment-store', [CommitteeMeetingCommentController::class, 'store'])->name('committee_meeting.agenda_item.comment.store');
    Route::delete('/committee-meeting/{committeeMeeting}/agenda-item/{committeeMeetingAgendaItem}/comment/{comment}', [CommitteeMeetingCommentController::class, 'destroy'])->name('committee_meeting.agenda_item.comment.destroy');


    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');


//    Route::resource('agenda-items', AgendaItemsController::class);


    Route::get('committees', action: [CommitteeController::class, 'index'])->name('committees.index'); // Display a listing of the resource
    Route::get('committees/create', [CommitteeController::class, 'create'])->name('committees.create'); // Show the form for creating a new resource
    Route::post('committees', [CommitteeController::class, 'store'])->name('committees.store'); // Store a newly created resource in storage
    Route::get('committees/{committee}', [CommitteeController::class, 'show'])->name('committees.show'); // Display the specified resource
    Route::get('committees/{committee}/edit', [CommitteeController::class, 'edit'])->name('committees.edit'); // Show the form for editing the specified resource
    Route::put('committees/{committee}', [CommitteeController::class, 'update'])->name('committees.update'); // Update the specified resource in storage
    Route::delete('committees/{committee}', [CommitteeController::class, 'destroy'])->name('committees.destroy'); // Remove the specified resource from storage
//	CommitteeMeetingMember
});
