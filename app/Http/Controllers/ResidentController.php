<?php

namespace App\Http\Controllers;

use App\Models\Official;
use App\Models\Resident; // Import the Resident model
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Resident::query();

        if ($search) {
            $query->where('full_name', 'like', '%' . $search . '%');
        }

        $residents = $query->paginate(10);

        return view('admin.resident-list.index', compact('residents'));
    }

    public function show($id)
    {
        $resident = Resident::findOrFail($id);
        return view('admin.resident-list.show', compact('resident'));
    }

    public function edit($id)
    {
        $resident = Resident::findOrFail($id);
        return view('admin.resident-list.edit', compact('resident'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'full_name' => 'required',
            'gender' => 'required',
            'purok' => 'required',
            'street' => 'required',
        ]);

        $resident = Resident::findOrFail($id);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $resident->photo = $photoPath;
        }

        $resident->status = $request->status;
        $resident->full_name = $request->full_name;
        $resident->gender = $request->gender;
        $resident->purok = $request->purok;
        $resident->street = $request->street;

        $resident->save();

        return redirect()->route('admin.resident-list.index')->with('success', 'Resident updated successfully.');
    }

    public function create()
    {
        // Updated view path to match the new structure
        return view('admin.manage-resident.add-resident');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_initial' => 'nullable|string|max:10',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'street' => 'nullable|string|max:255',
            'purok' => 'nullable|string|max:255',
            'gender' => 'required|string',
            'civil_status' => 'required|string',
            'citizenship' => 'nullable|string|max:255',
            'disabled' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('photo')) {
            $fileName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads'), $fileName);
            $validated['photo'] = $fileName;
        }

        // Save the resident data
        Resident::create($validated);

        return redirect()->route('resident.create')->with('success', 'Resident added successfully!');
    }

    public function destroy($id)
    {
        $resident = Resident::findOrFail($id);
        $resident->delete();
        return redirect()->route('admin.resident-list.index')->with('success', 'Resident deleted successfully.');
    }
}