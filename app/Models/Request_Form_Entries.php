<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request_Form_Entries extends Model
{
    protected $table = 'request_form_entries';

    protected $fillable = [
        'request_id',
        'request_form_field_id',
        'value'
    ];
}
