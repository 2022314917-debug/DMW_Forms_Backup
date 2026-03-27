<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request_Status_History extends Model
{
    protected $table = 'request_status_history';

    protected $fillable = [
        'request_id',
        'emp_id',
        'status',
        'remarks'
    ];
}
