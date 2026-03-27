<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request_Party_Address extends Model
{
    protected $table = 'request_party_address';

    protected $fillable = [
        'request_id',
        'request_party_id',
        'province',
        'municipality',
        'brgy',
        'house_no',
        'zip_code'
    ];
}
