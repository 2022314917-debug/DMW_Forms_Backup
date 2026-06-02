<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ofw_Training_Record extends Model
{
    protected $table = 'elpor_ofw_training_record';
    protected $fillable = [
        'request_id',
        'training_name',
        'venue',
        'issued_by',
        'training_date'
    ];

    public function request()
    {
        return $this->belongsTo(Request_Number::class, 'request_id', 'id');
    }
}
