<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
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
}
