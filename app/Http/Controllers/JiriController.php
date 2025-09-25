<?php

namespace App\Http\Controllers;

use App\Models\Jiri;
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
        return view('jiris.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:5',
            'description' => 'max:255|nullable',
            'date' => 'date_format:Y-m-d H:i:s',

        ]);
        Jiri::create($validated);

        return redirect(route('jiris.index'));
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jiri $jiri)
    {
        $jiri->update(['name' => $request['name']]);
        $jiri->save();

        return redirect(route('jiris.show'), $jiri);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jiri $jiri)
    {
        $jiri->delete();

        return redirect(route('jiris.index'));
    }
}
