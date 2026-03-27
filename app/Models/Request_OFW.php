<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request_OFW extends Model
{
    protected $table = 'request_ofw';

    protected $fillable = [
        'request_id',
        'ofw_lname',
        'ofw_fname',
        'ofw_ename',
        'ofw_mname',
        'ofw_passport_no',
        'ofw_country',
        'ofw_job',
        'ofw_employer',
        'bday',
        'gender'
    ];
}
