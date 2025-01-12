<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommitteeMeetingRequest;
use App\Http\Requests\UpdateCommitteeMeetingRequest;
use App\Models\Committee;
use App\Models\CommitteeMeeting;
use App\Models\CommitteeMeetingAgendaItem;
use App\Models\CommitteeMeetingMember;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CommitteeMeetingController extends Controller
{


    public static function middleware(): array
    {
        return [

            // 'permission:view all committee meetings|view own committee meetings|view member committee meetings'
            new Middleware('role_or_permission:meetings-access|meeting-view|meeting-edit', only: ['index']),
            new Middleware('role_or_permission:meeting-edit', only: ['edit']),
            new Middleware('role_or_permission:meeting-view', only: ['show']),
        ];
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $meetings = null;
        if (Auth::user()->hasRole(['Super-Admin', 'DH and Committee Secretary'])) {
            $committeeMeetings = CommitteeMeeting::visibleToUser(auth()->user())
                ->with(['creator', 'members'])
                ->orderByDesc('id')
                ->get();
        } else {
            $committeeMeetings = CommitteeMeeting::visibleToUser(auth()->user())
            ->with(['creator', 'members'])
            ->where('status','Unlock')
            ->orderByDesc('id')
            ->get();
        }



        return view('CommitteeMeeting.index', compact('committeeMeetings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('CommitteeMeeting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommitteeMeetingRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $request->merge(['user_id' => auth()->id()]);

                $committee_meeting = CommitteeMeeting::create($request->all());

                $committee = Committee::find($request->committee_id);
                foreach ($committee->members as $member) {
                    CommitteeMeetingMember::create([
                        'created_by_id' => auth()->id(),
                        'committee_meeting_id' => $committee_meeting->id,
                        'user_id' => $member->user_id,
                    ]);
                }

                return redirect()
                    ->route('committee_meeting.index')
                    ->with('success', 'Committee Meeting created successfully.');
            });
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to create Committee Meeting. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CommitteeMeeting $committeeMeeting)
    {
        return view('CommitteeMeeting.show', compact('committeeMeeting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommitteeMeeting $committeeMeeting)
    {
        return view('CommitteeMeeting.edit', compact('committeeMeeting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommitteeMeetingRequest $request, CommitteeMeeting $committeeMeeting)
    {
        $committeeMeeting->update($request->all());
        return redirect()->route('committee_meeting.index')->with('success', 'Committee Meeting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommitteeMeeting $committeeMeeting)
    {
        $committeeMeeting->delete();
        return redirect()->route('committee_meeting.index')->with('success', 'Committee Meeting deleted successfully.');
    }
}
