<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request_Ofw_Address extends Model
{
    protected $table = 'request_ofw_address';

    protected $fillable = [
        'request_id',
        'request_ofw_id',
        'province',
        'municipality',
        'brgy',
        'house_no',
        'zip_code'
    ];
}
