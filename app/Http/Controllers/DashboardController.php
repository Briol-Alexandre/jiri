<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\Contact;
use App\Models\Implementation;
use App\Models\Jiri;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = \request()->user();
        $user->loadCount('jiris');
        $projects = Project::all();
        $contacts = Contact::all();
        $implementations = $user->jiris();
        $attendances = Attendance::all();
        $assignments = Assignment::all();


        $upcommingJiris = $user->upcomingJiris;

        return view('dashboard', compact('contacts', 'projects', 'user', 'upcommingJiris', 'implementations', 'assignments', 'attendances'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
