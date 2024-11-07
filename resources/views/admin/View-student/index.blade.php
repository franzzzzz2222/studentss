@extends('adminlte::page')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Search Form -->
            <h3 class="text-center"></h3>
            <form action="{{ route('students.search') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="student_number" class="form-control" placeholder="Enter Student No." required>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>

            <!-- Error Message -->
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Student Information -->
            @if(isset($student))
            <div class="container mt-4 p-4 border rounded shadow">
                <h3 class="text-center">Student Data Profile</h3>
                <form>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" 
                                   value="{{ $student->last_name . ', ' . $student->first_name . ' ' . ($student->middle_name ? $student->middle_name : '') }}" 
                                   readonly>
                        </div>

                        <div class="col-md-3">
                            <label for="student_no">Student No.</label>
                            <input type="text" id="student_no" class="form-control" value="{{ $student->student_number }}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="lrn">LRN</label>
                            <input type="text" id="lrn" class="form-control" value="{{ $student->lrn }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-8">
                            <label for="address">Address</label>
                            <input type="text" id="address" class="form-control" value="{{ $student->address }}" readonly>
                        </div>
                        <div class="col-md-2">
                            <label for="year_enrolled">Year Enrolled</label>
                            <input type="text" id="year_enrolled" class="form-control" value="{{ $student->school_year }}" readonly>
                        </div>
                        <div class="col-md-2">
                            <label for="program">Program</label>
                            <input type="text" id="program" class="form-control" value="{{ $student->program }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="phone_no">Phone No.</label>
                            <input type="text" id="phone_no" class="form-control" value="{{ $student->contact_no }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" value="{{ $student->email }}" readonly>
                        </div>
                    </div>

                    <hr>

                    <h4 class="text-center">Family Information</h4>
                    
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="family_name">Name (Emergency Contact)</label>
                            <input type="text" id="family_name" class="form-control" value="{{ $student->guardian_name }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="contact_no">Contact No.</label>
                            <input type="text" id="contact_no" class="form-control" value="{{ $student->guardian_contact_no }}" readonly>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('students.search') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
