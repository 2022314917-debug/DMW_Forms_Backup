@extends('layouts.app')

@section('content')

<div class="container-fluid py-4 bg-light min-vh-100">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
            <h5 class="mb-0 fw-semibold text-dark">Employee Accounts</h5>
            <div class="d-flex align-items-center gap-3">
                <div class="input-group" style="width: 200px;">
                    <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search" onkeyup="filterTable()">
                    <span class="input-group-text bg-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#999" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                    </span>
                </div>
                <button class="btn btn-success btn-sm px-2" data-bs-toggle="modal" data-bs-target="#employeeModal">+</button>
            </div>
        </div>

        <div class="card-body p-0">
            @if ($errors->any())
                <div class="alert alert-danger border-start border-danger border-4 rounded-0 mb-0">
                    <strong>Errors:</strong>
                    <ul class="mb-0 ps-3 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success border-start border-success border-4 rounded-0 mb-0">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3 text-secondary small fw-semibold">Employee ID No.</th>
                            <th class="px-4 py-3 text-secondary small fw-semibold">Employee Name</th>
                            <th class="px-4 py-3 text-secondary small fw-semibold">Employee Email</th>
                            <th class="px-4 py-3 text-secondary small fw-semibold">Division</th>
                            <th class="px-4 py-3 text-secondary small fw-semibold">Account Created</th>
                            <th class="px-4 py-3 text-secondary small fw-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody id="employeeTable">
                        @forelse ($employees as $employee)
                            <tr class="employee-row" data-search="{{ strtolower($employee->emp_fname . ' ' . $employee->emp_lname . ' ' . $employee->emp_email) }}">
                                <td class="px-4 py-3 small">{{ $employee->id }}</td>
                                <td class="px-4 py-3 small">{{ $employee->emp_lname }}, {{ $employee->emp_fname }}</td>
                                <td class="px-4 py-3 small">{{ $employee->emp_email }}</td>
                                <td class="px-4 py-3 small">{{ $employee->division->division_name ?? 'N/A' }}</td>
                                <td class="px-4 py-3 small">{{ $employee->created_at ? $employee->created_at->format('M d, Y') : 'N/A' }}</td>
                                <td class="px-4 py-3">
                                    <button class="btn btn-primary btn-sm" onclick="viewEmployee('{{ $employee->id }}')">View</button>
                                    <button class="btn btn-warning btn-sm" onclick="editEmployee('{{ $employee->id }}')">Edit</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">No employees found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($employees->hasPages())
                <div class="px-4 py-3 border-top">
                    {{ $employees->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Add Employee Modal -->
<div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-white" style="background: #4080BF;">
                <h5 class="modal-title" id="addModalLabel">Add Employee</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="employeeForm" method="POST" action="{{ route('employees.store') }}">
                @csrf
                <div class="modal-body">

                    <p class="fw-semibold text-secondary small mb-2">Employee Name</p>
                    <div class="row g-3 mb-3">
                        <div class="col-md-3">
                            <label class="form-label small fw-medium">Surname</label>
                            <input type="text" class="form-control form-control-sm" id="add_emp_lname" name="emp_lname" placeholder="Last Name" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-medium">First Name</label>
                            <input type="text" class="form-control form-control-sm" id="add_emp_fname" name="emp_fname" placeholder="First Name" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-medium">Ext. Name</label>
                            <input type="text" class="form-control form-control-sm" id="add_emp_ename" name="emp_ename" placeholder="Jr.">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-medium">Middle Initial</label>
                            <input type="text" class="form-control form-control-sm" id="add_emp_mname" name="emp_mname" placeholder="A." maxlength="5">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-medium">Gender</label>
                            <select class="form-select form-select-sm" id="add_emp_gender" name="emp_gender" required>
                                <option value="">Choose</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-medium">Birthdate</label>
                            <input type="date" class="form-control form-control-sm" id="add_emp_bday" name="emp_bday" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-medium">Contact No.</label>
                        <input type="text" class="form-control form-control-sm" id="add_emp_contact_no" name="emp_contact_no" placeholder="Ex. 09001234567" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-medium">Division</label>
                            <select class="form-select form-select-sm" id="add_division_id" name="division_id" required>
                                <option value="">Choose</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->div_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-medium">Position</label>
                            <input type="text" class="form-control form-control-sm" id="add_emp_position" name="emp_position" placeholder="Ex. Information Technology Officer III" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-medium">Email</label>
                        <input type="email" class="form-control form-control-sm" id="add_emp_email" name="emp_email" placeholder="sample@acme.gov.ph" required>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-medium">Password</label>
                            <input type="password" class="form-control form-control-sm" id="add_emp_password" name="emp_password" placeholder="••••••••" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-medium">Confirm Password</label>
                            <input type="password" class="form-control form-control-sm" id="add_emp_password_confirm" name="emp_password_confirmation" placeholder="••••••••" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Employee Modal -->
<div class="modal fade" id="viewEmployeeModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-white" style="background: #4080BF;">
                <h5 class="modal-title" id="viewModalLabel">Employee Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <p class="fw-semibold text-secondary small mb-2">Employee Name</p>
                <div class="row g-3 mb-3">
                    <div class="col-md-3">
                        <label class="form-label small fw-medium">Surname</label>
                        <div class="form-control form-control-sm bg-light" id="view_emp_lname">-</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-medium">First Name</label>
                        <div class="form-control form-control-sm bg-light" id="view_emp_fname">-</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-medium">Ext. Name</label>
                        <div class="form-control form-control-sm bg-light" id="view_emp_ename">-</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-medium">Middle Initial</label>
                        <div class="form-control form-control-sm bg-light" id="view_emp_mname">-</div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-medium">Gender</label>
                        <div class="form-control form-control-sm bg-light" id="view_emp_gender">-</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-medium">Birthdate</label>
                        <div class="form-control form-control-sm bg-light" id="view_emp_bday">-</div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-medium">Contact No.</label>
                    <div class="form-control form-control-sm bg-light" id="view_emp_contact_no">-</div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-medium">Division</label>
                        <div class="form-control form-control-sm bg-light" id="view_division_id">-</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-medium">Position</label>
                        <div class="form-control form-control-sm bg-light" id="view_emp_position">-</div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-medium">Email</label>
                    <div class="form-control form-control-sm bg-light" id="view_emp_email">-</div>
                </div>

                <div class="mb-1">
                    <label class="form-label small fw-medium">Account Created</label>
                    <div class="form-control form-control-sm bg-light" id="view_emp_created_at">-</div>
                </div>

            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Employee Modal -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-white" style="background: #4080BF;">
                <h5 class="modal-title" id="editModalLabel">Edit Employee</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editEmployeeForm" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_EmployeeId" name="employee_id">
                <div class="modal-body">

                    <p class="fw-semibold text-secondary small mb-2">Employee Name</p>
                    <div class="row g-3 mb-3">
                        <div class="col-md-3">
                            <label class="form-label small fw-medium">Surname</label>
                            <input type="text" class="form-control form-control-sm" id="edit_emp_lname" name="emp_lname" placeholder="Last Name" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-medium">First Name</label>
                            <input type="text" class="form-control form-control-sm" id="edit_emp_fname" name="emp_fname" placeholder="First Name" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-medium">Ext. Name</label>
                            <input type="text" class="form-control form-control-sm" id="edit_emp_ename" name="emp_ename" placeholder="Jr.">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-medium">Middle Initial</label>
                            <input type="text" class="form-control form-control-sm" id="edit_emp_mname" name="emp_mname" placeholder="A." maxlength="5">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-medium">Gender</label>
                            <select class="form-select form-select-sm" id="edit_emp_gender" name="emp_gender" required>
                                <option value="">Choose</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-medium">Birthdate</label>
                            <input type="date" class="form-control form-control-sm" id="edit_emp_bday" name="emp_bday" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                    <div class="col-md-6">
                            <label class="form-label small fw-medium">Contact No.</label>
                            <input type="text" class="form-control form-control-sm" id="edit_emp_contact_no" name="emp_contact_no" placeholder="Ex. 09001234567" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-medium">Email</label>
                            <input type="email" class="form-control form-control-sm" id="edit_emp_email" name="emp_email" placeholder="sample@acme.gov.ph" required>
                        </div>
                    </div>
                    

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-medium">Division</label>
                            <select class="form-select form-select-sm" id="edit_division_id" name="division_id" required>
                                <option value="">Choose</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->div_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-medium">Position</label>
                            <input type="text" class="form-control form-control-sm" id="edit_emp_position" name="emp_position" placeholder="Ex. Information Technology Officer III" required>
                        </div>
                    </div>


                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addModal  = bootstrap.Modal.getOrCreateInstance(document.getElementById('employeeModal'));
        const viewModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('viewEmployeeModal'));
        const editModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('editEmployeeModal'));

        document.getElementById('employeeModal').addEventListener('hidden.bs.modal', function () {
            document.getElementById('employeeForm').reset();
        });

        window.viewEmployee = function (id) {
            fetch(`/employees/${id}/edit`, { headers: { 'Accept': 'application/json' } })
                .then(r => r.json())
                .then(data => {
                    document.getElementById('view_emp_lname').textContent      = data.emp_lname;
                    document.getElementById('view_emp_fname').textContent      = data.emp_fname;
                    document.getElementById('view_emp_mname').textContent      = data.emp_mname || '-';
                    document.getElementById('view_emp_ename').textContent      = data.emp_ename || '-';
                    document.getElementById('view_emp_gender').textContent     = data.emp_gender;
                    document.getElementById('view_emp_bday').textContent       = new Date(data.emp_bday).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
                    document.getElementById('view_emp_contact_no').textContent = data.emp_contact_no;
                    document.getElementById('view_division_id').textContent    = data.division?.division_name || 'N/A';
                    document.getElementById('view_emp_position').textContent   = data.emp_position;
                    document.getElementById('view_emp_email').textContent      = data.emp_email;
                    document.getElementById('view_emp_created_at').textContent = new Date(data.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
                    viewModal.show();
                })
                .catch(err => console.error('Error:', err));
        };

        window.editEmployee = function (id) {
            fetch(`/employees/${id}/edit`, { headers: { 'Accept': 'application/json' } })
                .then(r => r.json())
                .then(data => {
                    document.getElementById('editEmployeeForm').action         = `/employees/${id}`;
                    document.getElementById('edit_EmployeeId').value           = id;
                    document.getElementById('edit_emp_lname').value            = data.emp_lname;
                    document.getElementById('edit_emp_fname').value            = data.emp_fname;
                    document.getElementById('edit_emp_mname').value            = data.emp_mname || '';
                    document.getElementById('edit_emp_ename').value            = data.emp_ename || '';
                    document.getElementById('edit_emp_gender').value           = data.emp_gender;
                    document.getElementById('edit_emp_bday').value             = data.emp_bday.split('T')[0]; // fix: strip timestamp
                    document.getElementById('edit_emp_contact_no').value       = data.emp_contact_no;
                    document.getElementById('edit_division_id').value          = data.division_id;
                    document.getElementById('edit_emp_position').value         = data.emp_position;
                    document.getElementById('edit_emp_email').value            = data.emp_email;
                    editModal.show();
                })
                .catch(() => alert('Failed to load employee data. Please try again.'));
        };

        window.filterTable = function () {
            const input = document.getElementById('searchInput').value.toLowerCase();
            document.querySelectorAll('.employee-row').forEach(row => {
                row.style.display = row.getAttribute('data-search').includes(input) ? '' : 'none';
            });
        };
    });
</script>
@endsection