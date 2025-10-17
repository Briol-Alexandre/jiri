<?php

namespace App\Http\Controllers;

use App\Enums\ContactRoles;
use App\Http\Requests\StoreJiriRequest;
use App\Models\Contact;
use App\Models\Implementation;
use App\Models\Jiri;
use App\Models\Project;
use Auth;
use Gate;
use Illuminate\Http\Request;

class JiriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jiris = Jiri::all();

        return view('jiris.index', compact('jiris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contacts = Contact::all();
        $projects = Project::all();
        return view('jiris.create', compact('contacts', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|min:3',
            'description' => 'max:255|nullable',
            'date' => 'date_format:Y-m-d H:i:s',
            'contacts' => 'array|nullable',
            'roles' => 'nullable|array',
            'projects' => 'nullable|array'
        ]);

        $jiri = auth()->user()->jiris()->create($validated);


        if (!empty($validated['contacts'])) {
            foreach ($validated['contacts'] as $contact) {
                $role = $validated['roles'][$contact];
                $jiri->contacts()->attach($contact, ['role' => $role]);
            }
        }


        if (!empty($validated['projects'])) {
            foreach ($validated['projects'] as $project) {
                $jiri->projects()->attach($project);
            }
        }

        if (!empty($validated['projects']) && !empty($validated['contacts'])) {
            foreach ($validated['contacts'] as $contact) {
                $role = $validated['roles'][$contact] ?? null;
                if ($role === ContactRoles::Evaluated->value) {
                    foreach ($validated['projects'] as $projectId) {
                        $assignment = $jiri->assignments()
                            ->where('project_id', $projectId)
                            ->first();
                        if ($assignment) {
                            Implementation::create([
                                'contact_id' => $contact,
                                'assignment_id' => $assignment->id
                            ]);
                        }
                    }
                }
            }
        }

        return redirect(route('jiris.show', $jiri));
    }

    /**
     * Display the specified resource.
     */
    public function show(Jiri $jiri)
    {
        return view('jiris.show', compact('jiri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jiri $jiri)
    {
        $assignments = $jiri->assignments()->with('project')->get()->pluck('project');
        $assignmentsIds = $assignments->pluck('id');
        $projects = Project::whereNotIn('id', $assignmentsIds)->get();
        $assignedProjects = Project::whereIn('id', $assignmentsIds)->get();

        $attendances = $jiri->attendances()->with('contact')->get()->pluck('contact');
        $attendancesIds = $attendances->pluck('id');
        $contacts = Contact::whereNotIn('id', $attendancesIds)->get();
        $assignedContacts = Contact::whereIn('id', $attendancesIds)->get();

        return view('jiris.edit', compact('jiri', 'contacts', 'assignedContacts', 'projects', 'assignedProjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreJiriRequest $request, Jiri $jiri)
    {
        Gate::authorize('update', $jiri);
        $validated = $request->validated();
        $jiri->update($validated);

        if (!empty($validated['contacts'])) {
            $newContactList = [];
            foreach ($validated['contacts'] as $contact) {
                $role = $validated['roles'][$contact];
                $newContactList[$contact] = ['role' => $role];
            }
            $jiri->contacts()->sync($newContactList);
        }

        if (!empty($validated['projects'])) {
            $jiri->projects()->sync($validated['projects']);
        }

        $jiri->save();

        return redirect(route('jiris.show', $jiri));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jiri $jiri)
    {
        Gate::authorize('delete', $jiri);

        $jiri->delete();

        return redirect(route('jiris.index'));
    }
}
