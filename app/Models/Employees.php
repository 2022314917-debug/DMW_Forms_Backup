<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Employees extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'employees';

    protected $fillable = [
        'division_id',
        'emp_lname',
        'emp_fname',
        'emp_ename',
        'emp_mname',
        'emp_gender',
        'emp_bday',
        'emp_email',
        'emp_password',
        'emp_contact_no',
        'emp_position'
    ];

    protected $hidden = [
        'emp_password',

    ];

    // 🔐 Auto-hash password when saving
    // public function setEmpPasswordAttribute($value)
    // {
    //     if (!empty($value)) {
    //         $this->attributes['emp_password'] = Hash::make($value);
    //     }
    // }

    // 🔑 Tell Laravel this is the login password field
    public function getAuthPassword()
    {
        return $this->emp_password;
    }

    public function getAuthIdentifierName()
    {
        return 'emp_email';
    }

    // public function getRememberTokenName()
    // {
    //     return null; // disables remember token functionality
    // }

    // 📅 Optional: cast date fields
    protected $casts = [
        'emp_bday' => 'date',
    ];
}
