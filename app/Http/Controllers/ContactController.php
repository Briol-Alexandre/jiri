<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Jobs\ProcessUploadedContactAvatar;
use App\Models\Contact;
use App\Models\Jiri;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();

        return view('contacts.index', compact('contacts'));
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

        /*if ($request->hasFile('avatar')) {
            $image = Image::read($validated['avatar'])
                ->resize(300, 300)
                ->toJpeg(80);
            $fileName = 'contact_' . uniqid() . '_300x300.jpg';
            $path = "contacts/$fileName";
            Storage::disk('public')->put($path, $image->toString());
            $validated['avatar'] = $path;
        }*/
        if ($validated['avatar']) {
            $new_original_file_name = uniqid() . '.' . config('contactavatars.image_type');
            $full_path_to_original = Storage::putFileAs(config('contactavatars.original_path'),
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
                /*if ($findJiri->projects) {

                }*/
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreContactRequest $request, Contact $contact)
    {
        $validated = $request->validated();
        $contact->update($validated);
        $contact->save();

        return redirect(route('contacts.show'), $contact);
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
