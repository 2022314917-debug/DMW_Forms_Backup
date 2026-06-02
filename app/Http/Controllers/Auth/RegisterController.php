<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use App\Models\Division;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        $divisions = Division::all();
        $offices = Office::all();
        return view('auth.register', compact('divisions', 'offices'));
    }

    /**
     * Validate and create a new employee.
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        Employees::create([
            'office_id'      => $request->office_id,
            'division_id'    => $request->division_id,
            'emp_lname'      => $request->emp_lname,
            'emp_fname'      => $request->emp_fname,
            'emp_mname'      => $request->emp_mname,
            'emp_ename'      => $request->emp_ename,
            'emp_gender'     => $request->emp_gender,
            'emp_bday'       => $request->emp_bday,
            'emp_email'      => $request->emp_email,
            'emp_password'   => Hash::make($request->emp_password),
            'emp_contact_no' => $request->emp_contact_no,
            'emp_position'   => $request->emp_position,
        ]);

        return redirect()->route('login')->with('success', 'Account created successfully. Please log in.');
    }

    /**
     * Validation rules matching the employees migration.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'office_id'      => ['required', 'exists:office,id'],
            'division_id'    => ['required', 'exists:division,id'],
            'emp_lname'      => ['required', 'string', 'max:255'],
            'emp_fname'      => ['required', 'string', 'max:255'],
            'emp_mname'      => ['nullable', 'string', 'max:255'],
            'emp_ename'      => ['nullable', 'string', 'max:255'],
            'emp_gender'     => ['required', 'in:Male,Female,Other'],
            'emp_bday'       => ['required', 'date', 'before:today'],
            'emp_email'      => ['required', 'string', 'email', 'max:255', 'unique:employees,emp_email'],
            'emp_password'   => ['required', 'string', 'min:8', 'confirmed'],
            'emp_contact_no' => ['required', 'string', 'max:20'],
            'emp_position'   => ['required', 'string', 'max:255'],
        ]);
    }
}