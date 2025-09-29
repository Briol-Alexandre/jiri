<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Jiri;
use Illuminate\Http\Request;

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
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:8',
            'email' => 'email|unique:contacts|required',
        ]);
        $contact = Contact::create($validated);
        $jiris = $request['jiris'];
        if ($jiris) {
            foreach ($jiris as $jiri) {
                $findJiri = Jiri::findOrFail($jiri);
                $role = $request['roles'][$jiri];
                $findJiri->contacts()->attach($contact->id, ['role' => $role]);
            }
        }

        return redirect(route('contacts.index'));
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
    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'name' => 'required|min:8',
            'email' => 'email|required|unique:contacts,email,' . $contact->id,
        ]);
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
