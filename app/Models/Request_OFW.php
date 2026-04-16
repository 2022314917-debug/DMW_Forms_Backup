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
        'ofw_gender',
        'ofw_civil_status',
        'ofw_email',
        'ofw_phone',
        'ofw_bday',
        'ofw_country',
        'ofw_job',
        'ofw_employer',
        'ofw_agency'
    ];

    public function request()
    {
        return $this->belongsTo(Request_Number::class, 'request_id', 'id');
    }
}
