@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #f4f4f4; font-family: 'Assistant', Arial, sans-serif; }
        .form-header { background-color: #f9f8f2; border: 1px solid #e0d8b4; border-radius: 4px; padding: 1rem; margin-bottom: 1rem; }
        .form-card { background: #e8f1ff; border: 1px solid #b7d0f0; border-radius: 8px; padding: 1rem; margin-bottom: 1rem; }
        .form-section h5 { font-weight: 700; color: #0f3d91; margin-bottom: .75rem; }
        .form-label { font-weight: 600; }
        .field-group { background: #ebf4ff; border: 1px solid #b4d5f3; border-radius: 6px; padding: .9rem; margin-bottom: 1rem; }
        .grid-2 { display: grid; grid-template-columns: repeat(1,1fr); gap: .75rem; }
        @media (min-width: 768px) { .grid-2 { grid-template-columns: repeat(2,1fr); } }
    </style>

    <div class="container my-4">
        <div class="form-header">
            <h4 class="fw-bold">AKSYON REQUEST FOR ASSISTANCE</h4>
            <p class="mb-0">Use this form to record agency and complaints details. All fields are optional unless indicated required.</p>
        </div>

        <div class="form-card">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('forms.aksyon.store') }}">
                @csrf

                <div class="field-group">
                    <h5>A. Agency Information</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Name of Philippine Recruitment Agency</label>
                            <input type="text" class="form-control" name="agency_name" placeholder="e.g. XYZ Agency">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Position</label>
                            <input type="text" class="form-control" name="position" placeholder="e.g. Manager">
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-12">
                            <label class="form-label">Agency Address</label>
                            <input type="text" class="form-control" name="agency_address" placeholder="Office Address">
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-3"><input type="text" class="form-control" name="province" placeholder="Province"></div>
                        <div class="col-md-3"><input type="text" class="form-control" name="municipality" placeholder="City/Municipality"></div>
                        <div class="col-md-3"><input type="text" class="form-control" name="barangay" placeholder="Barangay"></div>
                        <div class="col-md-3"><input type="text" class="form-control" name="zipcode" placeholder="Zip Code"></div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6"><input type="text" class="form-control" name="contact_person" placeholder="Contact Person"></div>
                        <div class="col-md-6"><input type="text" class="form-control" name="contact_number" placeholder="Contact Number"></div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6"><input type="email" class="form-control" name="email" placeholder="Email Address"></div>
                        <div class="col-md-6"><input type="text" class="form-control" name="facebook" placeholder="Facebook/Messenger"></div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-12"><input type="text" class="form-control" name="nature_of_business" placeholder="Nature of Business"></div>
                    </div>
                </div>

                <div class="field-group">
                    <h5>B. Complaints Filed at Other Office/Agency</h5>
                    <div class="grid-2">
                        <div>
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" name="complaint_date">
                        </div>
                        <div>
                            <label class="form-label">Office</label>
                            <input type="text" class="form-control" name="complaint_office" placeholder="Office Name">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Nature of Case</label>
                            <input type="text" class="form-control" name="complaint_nature" placeholder="Case nature/details">
                        </div>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success btn-lg fw-bold">Submit</button>
                </div>

            </form>
        </div>
    </div>
@endsection
