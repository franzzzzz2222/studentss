<?php

namespace App\Http\Controllers;

use App\Models\Official;
use Illuminate\Http\Request;

class OfficialListController extends Controller
{
    public function index()
    {
        $officials = Official::all(); // Fetch all officials
        return view('admin.official-list.index', compact('officials'));
    }
}
