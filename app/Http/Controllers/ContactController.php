<?php

namespace App\Http\Controllers;

use App\Enums\ContactRoles;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Jobs\ProcessUploadedContactAvatar;
use App\Models\Contact;
use App\Models\Implementation;
use App\Models\Jiri;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use function Sodium\compare;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $col = $request->get('col');
        $direction = $request->get('direction', 'asc');
        $contacts = Contact::orderBy($col, $direction)->get();

        return view('contacts.index', compact('contacts', 'col', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jiris = Jiri::all();
        return view('contacts.create', compact('jiris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        $validated = $request->validated();
        if ($validated['avatar']) {
            $new_original_file_name = uniqid() . '.' . config('contactavatars.image_type');
            $full_path_to_original = Storage::putFileAs(
                config('contactavatars.original_path'),
                $validated['avatar'],
                $new_original_file_name
            );
            if ($full_path_to_original) {
                $validated['avatar'] = $new_original_file_name;
                ProcessUploadedContactAvatar::dispatch($full_path_to_original, $new_original_file_name);
            } else {
                $validated['avatar'] = '';
            }
        }

        $contact = auth()->user()->contacts()->create($validated);

        if (!empty($validated['jiris'])) {
            foreach ($validated['jiris'] as $jiri) {
                $findJiri = Jiri::findOrFail($jiri);
                $role = $validated['roles'][$jiri];
                $findJiri->contacts()->attach($contact->id, ['role' => $role]);
                $projects = $findJiri->projects;
                foreach ($projects as $project) {
                    $assignment = $findJiri->assignments()->where('project_id', $project->id)->first();
                    if ($findJiri->projects) {
                        Implementation::create([
                            'contact_id' => $contact->id,
                            'assignment_id' => $assignment->id,
                        ]);
                    }
                }

            }
        }


        return redirect(route('contacts.show', $contact));
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $attendances = $contact->attendances;
        $jiriIds = $attendances->pluck('jiri_id');
        $jiris = Jiri::whereNotIn('id', $jiriIds)->get();
        return view('contacts.edit', compact('contact', 'attendances', 'jiris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $validated = $request->validated();
        $contact->update($validated);
        $contact->implementations()->delete();

        if (!empty($validated['jiris'])) {
            $newJiriList = [];
            foreach ($validated['jiris'] as $jiriId) {
                $role = $validated['roles'][$jiriId];
                $newJiriList[$jiriId] = ['role' => $role];
                if ($role === ContactRoles::Evaluated->value) {
                    $jiri = Jiri::findOrFail($jiriId);
                    $projects = $jiri->projects;
                    foreach ($projects as $project) {
                        $assignment = $jiri->assignments()->where('project_id', $project->id)->first();
                        if ($assignment) {
                            Implementation::create([
                                'contact_id' => $contact->id,
                                'assignment_id' => $assignment->id,
                            ]);
                        }
                    }
                }
            }

            foreach ($validated['jiris'] as $jiriId) {
                $jiri = Jiri::findOrFail($jiriId);
                $role = $validated['roles'][$jiriId];
                $jiri->contacts()->sync([$contact->id => ['role' => $role]]);
            }
        } else {
            $contact->attendances()->delete();
        }

        if ($validated['avatar']) {
            $new_original_file_name = uniqid() . '.' . config('contactavatars.image_type');
            $full_path_to_original = Storage::putFileAs(
                config('contactavatars.original_path'),
                $validated['avatar'],
                $new_original_file_name
            );
            if ($full_path_to_original) {
                $validated['avatar'] = $new_original_file_name;
                ProcessUploadedContactAvatar::dispatch($full_path_to_original, $new_original_file_name);
            } else {
                $validated['avatar'] = '';
            }
        }

        $contact->save();

        return redirect(route('contacts.show', $contact));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect(route('contacts.index'));
    }
}
