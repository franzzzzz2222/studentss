<?php

namespace App\Http\Controllers;

use App\Models\BarangayInformation;
use Illuminate\Http\Request;

class BarangayInformationController extends Controller
{
    public function index()
    {
        $info = BarangayInformation::first();
        return view('admin.information.index', compact('info'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'barangay_name' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $info = BarangayInformation::first() ?? new BarangayInformation;

        if ($request->hasFile('logo')) {
            $logoName = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('logos'), $logoName);
            $info->logo = $logoName;
        }

        $info->barangay_name = $request->barangay_name;
        $info->municipality = $request->municipality;
        $info->province = $request->province;
        $info->phone_number = $request->phone_number;
        $info->email = $request->email;

        $info->save();

        return redirect()->back()->with('success', 'Information updated successfully!');
    }
}
