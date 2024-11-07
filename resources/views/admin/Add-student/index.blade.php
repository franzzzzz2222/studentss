@extends('adminlte::page')

@section('content')
<div class="container" style="background-image: url('{{ asset('logo.png') }}'); background-size: cover; background-position: center; padding: 20px;">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <h1>ENROLLMENT FORM</h1>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="studentForm" action="{{ route('students.store') }}" method="POST">
        @csrf

        <div class="form-group text-right mb-3">
            <label for="school_year">School Year:</label>
            <select name="school_year" class="form-control form-control-sm d-inline-block" style="width: auto;" required>
                @for ($year = 2023; $year <= 2040; $year++)
                    <option value="{{ $year }}-{{ $year + 1 }}">{{ $year }}-{{ $year + 1 }}</option>
                @endfor
            </select>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="middle_name">Middle Name:</label>
                    <input type="text" name="middle_name" class="form-control" placeholder="Middle Name">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" name="age" class="form-control" placeholder="Age" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="sex">Sex:</label>
                    <select name="sex" class="form-control" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="program">Program:</label>
                    <select name="program" class="form-control" required>
                        <option value="BSIT">BSIT</option>
                        <option value="Engineering">Engineering</option>
                        <option value="BLIS">BLIS</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" name="address" class="form-control" placeholder="Address" required>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="contact_no">Contact No.:</label>
                    <input type="text" name="contact_no" class="form-control" placeholder="Contact No." required>
                </div>
            </div>
        </div>

        <h3>Family Information</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="father_name">Father's Name:</label>
                    <input type="text" name="father_name" class="form-control" placeholder="Father's Name" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="father_contact_no">Father's Contact No.:</label>
                    <input type="text" name="father_contact_no" class="form-control" placeholder="Father's Contact No.">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="mother_name">Mother's Name:</label>
                    <input type="text" name="mother_name" class="form-control" placeholder="Mother's Name" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="mother_contact_no">Mother's Contact No.:</label>
                    <input type="text" name="mother_contact_no" class="form-control" placeholder="Mother's Contact No.">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="guardian_name">Guardian:</label>
                    <input type="text" name="guardian_name" class="form-control" placeholder="Guardian's Name" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="guardian_contact_no">Guardian Contact No.:</label>
                    <input type="text" name="guardian_contact_no" class="form-control" placeholder="Guardian's Contact No.">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="guardian_address">Guardian Address:</label>
            <input type="text" name="guardian_address" class="form-control" placeholder="Guardian's Address">
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">Add Student</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('studentForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var form = event.target;
        var formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Student added successfully.',
                }).then(() => {
                    window.location.href = "{{ route('students.create') }}";
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: data.message,
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'An error occurred while processing your request.',
            });
        });
    });
</script>
@endsection
