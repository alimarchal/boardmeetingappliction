<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommitteeRequest;
use App\Http\Requests\UpdateCommitteeRequest;
use App\Models\Committee;
use App\Models\CommitteeMember;
use App\Models\User; // Make sure to import the User model
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all committees and return them to a view
        $committees = Committee::all();
        return view('committees.index', compact('committees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all users to populate the members dropdown
        $users = User::all(); // You can add filtering if necessary (e.g., User::where('role', 'member')->get())

        // Pass users to the view
        return view('committees.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommitteeRequest $request)
    {

        try {
            // Start a database transaction
            DB::beginTransaction();

            $request->merge(['user_id' => auth()->id()]);
            $committee = Committee::create($request->all());

            // Add committee members
            foreach ($request->members as $member) {
                CommitteeMember::create([
                    'committee_id' => $committee->id,
                    'user_id' => $member['user_id'],
                    'position' => $member['position']
                ]);
            }

            // Commit the transaction
            DB::commit();

            return redirect()
                ->route('committees.index')
                ->with('success', 'Committee created successfully.');

        } catch (\Exception $e) {
            // Rollback the transaction if anything goes wrong
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error creating committee: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Committee $committee)
    {
        // Show details of a specific committee
        return view('committees.show', compact('committee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Committee $committee)
    {
        $users = User::orderBy('name')->get();
        // Return a view with a form to edit the specified committee
        return view('committees.edit', compact('committee', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommitteeRequest $request, Committee $committee)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            $request->merge(['user_id' => auth()->id()]);
            $committee->update($request->all());


            // Get current member IDs for comparison
            $existingMemberIds = $committee->members()->pluck('user_id')->toArray();

            $newMemberIds = collect($request->members)->pluck('user_id')->toArray();

            // Members to remove (exist in database but not in request)
            $membersToDelete = array_diff($existingMemberIds, $newMemberIds);
            // Delete removed members
            if (!empty($membersToDelete)) {
                $committee->members()
                    ->whereIn('user_id', $membersToDelete)
                    ->delete();
            }

            // Update or create members
            foreach ($request->members as $memberData) {
                $committee->members()->updateOrCreate(
                    [
                        'user_id' => $memberData['user_id'],
                        'committee_id' => $committee->id
                    ],
                    [
                        'position' => $memberData['position']
                    ]
                );
            }



            // Commit the transaction
            DB::commit();

            return redirect()
                ->route('committees.index')
                ->with('success', 'Committee updated successfully.');

        } catch (\Exception $e) {
            // Rollback the transaction if anything goes wrong
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error creating committee: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Committee $committee)
    {
        // Delete the committee
        $committee->delete();

        // Redirect back with success message
        return redirect()->route('committees.index')->with('success', 'Committee deleted successfully.');
    }
}