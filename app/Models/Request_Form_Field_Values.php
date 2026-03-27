<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request_Form_Field_Values extends Model
{
    protected $table = 'request_form_field_values';

    protected $fillable = [
        'request_form_entry_id',
        'request_form_field_id',
        'value'
    ];
}
