<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requirements extends Model
{
    protected $table = 'requirements';

    protected $fillable = [
        'request_id',
        'file_name',
        'file_path',
        'file_type'
    ];

    public function request()
    {
        return $this->belongsTo(Request_Number::class, 'request_id', 'id');
    }
}
