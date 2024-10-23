<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommitteeRequest;
use App\Http\Requests\UpdateCommitteeRequest;
use App\Models\Committee;
use App\Models\User; // Make sure to import the User model
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;


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
        // Validate and store the committee
        Committee::create($request->validated());


        // Redirect back with success message
        return redirect()->route('committees.index')->with('success', 'Committee created successfully.');
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
        // Return a view with a form to edit the specified committee
        return view('committees.edit', compact('committee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommitteeRequest $request, Committee $committee)
    {
        // Validate and update the committee
        $committee->update($request->validated());

        // Redirect back with success message
        return redirect()->route('committees.index')->with('success', 'Committee updated successfully.');
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