<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request_Form extends Model
{
    protected $table = 'request_form';

    protected $fillable = [
        'division_id',
        'form_name'
    ];
}
