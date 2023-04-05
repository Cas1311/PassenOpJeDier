<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class petsController extends Controller
{
    // Show all pets
    public function index()
    {
        return view('pets.index', [
            'pets' => Pet::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    //Show single pets
    public function show(Pet $pets)
    {
        return view('pets.show', [
            'pets' => $pets
        ]);
    }

    // Show Create Form
    public function create()
    {
        return view('pets.create');
    }

    // Store Pet Data
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('pets', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Pet::create($formFields);

        return redirect('/')->with('message', 'Pet created successfully!');
    }

    // Show Edit Form
    public function edit(Pet $pets)
    {
        return view('pets.edit', ['pets' => $pets]);
    }

    // Update Pet Data
    public function update(Request $request, Pet $pets)
    {
        // Make sure logged in user is owner
        if ($pets->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $pets->update($formFields);

        return back()->with('message', 'Pet updated successfully!');
    }

    // Delete Pet
    public function destroy(Pet $pets)
    {
        // Make sure logged in user is owner
        // if ($pets->user_id != auth()->id()) {
        //     abort(403, 'Unauthorized Action');
        // }

        // if ($pets->logo && Storage::disk('public')->exists($pets->logo)) {
        //     Storage::disk('public')->delete($pets->logo);
        // }
        // $pets->delete();
        // return redirect('/')->with('message', 'Pet deleted successfully');
    }

    // Manage pets
    public function manage()
    {
        // return view('pets.manage', ['pets' => auth()->user()->pets()->get()]);
    }
}
