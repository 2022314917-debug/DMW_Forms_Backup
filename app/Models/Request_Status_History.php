<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employees;

class Request_Status_History extends Model
{
    protected $table = 'request_status_history';

    protected $fillable = [
        'request_id',
        'employee_id',
        'status',
        'remarks'
    ];

    public function employee()
    {
        return $this->belongsTo(Employees::class, 'employee_id');
    }
}
