<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'emp_email'    => ['required', 'email'],
            'emp_password' => ['required', 'string'],
        ]);

        // Find employee by email
        $employee = Employees::where('emp_email', $request->emp_email)->first();

        // Check if employee exists and password matches
        if (! $employee || ! Hash::check($request->emp_password, $employee->emp_password)) {
            return back()
                ->withInput($request->only('emp_email', 'remember'))
                ->withErrors([
                    'emp_email' => __('These credentials do not match our records.'),
                ]);
        }

        // Log the employee in using Auth::login()
        // Auth::login($employee, $request->boolean('remember'));
        Auth::guard('web')->login($employee, $request->boolean('remember'));

        $request->session()->regenerate();
        

        return redirect()->route('forms-submitted.index');
    }

    /**
     * Log the employee out.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}