<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function create()
    {
        return view('admin.Add-student.index'); // Show the enrollment form
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'school_year' => 'required|string|max:10',
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'age' => 'required|integer|min:1',
            'sex' => 'required|in:Male,Female',
            'program' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'contact_no' => 'required|string|max:15',
            'father_name' => 'required|string|max:255',
            'father_contact_no' => 'nullable|string|max:15',
            'mother_name' => 'required|string|max:255',
            'mother_contact_no' => 'nullable|string|max:15',
            'guardian_name' => 'required|string|max:255',
            'guardian_contact_no' => 'nullable|string|max:15',
            'guardian_address' => 'nullable|string|max:255',
        ]);

        // Generate student number
        $lastStudent = Student::orderBy('id', 'desc')->first();
        $studentNumber = $lastStudent ? $lastStudent->student_number + 1 : 2211600001;

        $validatedData['student_number'] = $studentNumber;

        Student::create($validatedData);

        return response()->json(['success' => true, 'message' => 'Student added successfully.']);
    }

    public function viewStudent()
    {
        return view('admin.View-Student.index'); // Show the view student form
    }

    public function searchStudent(Request $request)
    {
        $request->validate([
            'student_number' => 'required|string|max:255',
        ]);

        $student = Student::where('student_number', $request->student_number)->first();

        if ($student) {
            return view('admin.View-Student.index', compact('student'));
        } else {
            return redirect()->back()->with('error', 'Student not found.');
        }
    }
}
