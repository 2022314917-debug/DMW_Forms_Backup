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

    public function fields()
    {
        return $this->hasMany(Request_Form_Field::class, 'request_form_id', 'id');
    }

    // Add this relationship
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }
}