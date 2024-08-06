<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeetingCommitteeRequest;
use App\Http\Requests\UpdateMeetingCommitteeRequest;
use App\Models\MeetingCommittee;
use App\Models\CommitteeMember;
use App\Models\CommitteeMeeting;
use App\Models\User;
use Illuminate\Http\Request;

class MeetingCommitteeController extends Controller
{
    public function index()
    {
        $committees = MeetingCommittee::with('members.user')->get();
        return view('committees.index', compact('committees'));
    }

    public function create()
    {
        $users = User::all(); // Fetch all users
        return view('committees.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'members.*.user_id' => 'required|exists:users,id',
            'members.*.position' => 'required|string|max:255',
        ]);

        $committee = MeetingCommittee::create($request->only(['name', 'type']));

        foreach ($request->members as $member) {
            $user = User::find($member['user_id']);
            $committee->members()->create([
                'user_id' => $member['user_id'],
                'name' => $user->name, // Use the user's name
                'position' => $member['position'],
            ]);
        }

        return redirect()->route('committees.index');
    }

    public function show(MeetingCommittee $committee)
    {
        // Eager load the meetings relationship
        $committee->load('meetings');

        return view('committees.show', compact('committee'));
    }

    public function edit(MeetingCommittee $committee)
    {
        $users = User::all(); // Fetch all users for editing
        return view('committees.edit', compact('committee', 'users'));
    }

    public function update(Request $request, MeetingCommittee $committee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'members.*.user_id' => 'required|exists:users,id',
            'members.*.position' => 'required|string|max:255',
        ]);

        $committee->update($request->only(['name', 'type']));
        $committee->members()->delete(); // Clear existing members

        foreach ($request->members as $member) {
            $user = User::find($member['user_id']);
            $committee->members()->create([
                'user_id' => $member['user_id'],
                'name' => $user->name, // Use the user's name
                'position' => $member['position'],
            ]);
        }

        return redirect()->route('committees.index');
    }

    public function destroy(MeetingCommittee $committee)
    {
        $committee->delete();
        return redirect()->route('committees.index');
    }

    public function addMeeting(Request $request, MeetingCommittee $committee)
    {
        $request->validate([
            'meeting_date' => 'required|date_format:Y-m-d\TH:i',
            'title' => 'required|string|max:1000',
        ]);

        // Create a new meeting
        $committee->meetings()->create([
            'user_id' => auth()->user()->id,
            'date_and_time' => $request->meeting_date,
            'title' => $request->title,
        ]);

        return redirect()->route('committees.show', $committee->id)
            ->with('success', 'Meeting added successfully.');
    }
}
