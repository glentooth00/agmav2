<?php

namespace App\Http\Controllers;

use App\Models\attendees;
use Illuminate\Http\Request;

class AttendeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalAttendees = attendees::count();

        return view('layouts.app.sidebar', [
            'totalAttendees' => $totalAttendees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(attendees $attendees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(attendees $attendees)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, attendees $attendees)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(attendees $attendees)
    {
        //
    }
}
