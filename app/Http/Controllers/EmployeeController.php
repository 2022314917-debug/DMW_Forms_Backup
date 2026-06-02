<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Division;
use App\Models\Office;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of employees
     */
    public function index()
    {
        $employees = Employees::with('division')->paginate(10);
        $divisions = Division::all();
        $offices = Office::all();
        
        return view('employees.index', compact('employees', 'divisions', 'offices'));
    }

    /**
     * Store a newly created employee
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'emp_fname' => 'required|string|max:255',
            'emp_lname' => 'required|string|max:255',
            'emp_mname' => 'nullable|string|max:255',
            'emp_ename' => 'nullable|string|max:255',
            'emp_gender' => 'required|in:Male,Female,Other',
            'emp_bday' => 'required|date',
            'emp_contact_no' => 'required|string|max:20',
            'emp_email' => 'required|email|unique:employees,emp_email',
            'emp_password' => 'required|string|min:8|confirmed',
            'office_id' => 'required|exists:office,id',
            'division_id' => 'required|exists:division,id',
            'emp_position' => 'required|string|max:255',
        ]);

        $validated['emp_password'] = bcrypt($validated['emp_password']);

        Employees::create($validated);

        return redirect()->route('employees.index')->with('success', 'Employee added successfully!');
    }

    /**
     * Show the form for editing an employee (JSON endpoint for modal)
     */
    public function edit(Employees $employee)
    {
        $employee->load('division');
        $employee->load('office');
        
        // Return JSON if requested via AJAX
        if (request()->wantsJson()) {
            return response()->json($employee);
        }

        $divisions = Division::all();
        $offices = Office::all();
        return view('employees.edit', compact('employee', 'divisions', 'offices'));
    }

    /**
     * Update the specified employee
     */
    public function update(Request $request, Employees $employee)
    {
        $validated = $request->validate([
            'emp_fname' => 'required|string|max:255',
            'emp_lname' => 'required|string|max:255',
            'emp_mname' => 'nullable|string|max:255',
            'emp_ename' => 'nullable|string|max:255',
            'emp_gender' => 'required|in:Male,Female,Other',
            'emp_bday' => 'required|date',
            'emp_contact_no' => 'required|string|max:20',
            'emp_email' => 'required|email|unique:employees,emp_email,' . $employee->id,
            'division_id' => 'required|exists:division,id',
            'emp_position' => 'required|string|max:255',
        ]);

        // Only hash password if provided
        if ($request->filled('emp_password')) {
            $request->validate([
                'emp_password' => 'string|min:8|confirmed',
            ]);
            $validated['emp_password'] = bcrypt($request->emp_password);
        } else {
            unset($validated['emp_password']);
        }

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    /**
     * Delete an employee
     */
    public function destroy(Employees $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }
}
