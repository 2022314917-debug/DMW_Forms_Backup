<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request_Form_Entries extends Model
{
    protected $table = 'request_form_entries';

    protected $fillable = [
        'request_id',
        'request_form_id',
        'status',
    ];

    public function request()
    {
        return $this->belongsTo(Request_Number::class, 'request_id', 'id');
    }

    public function form()
    {
        return $this->belongsTo(Request_Form::class, 'request_form_id', 'id');
    }

    public function fieldValues()
    {
        return $this->hasMany(Request_Form_Field_Values::class, 'request_form_entry_id', 'id');
    }
}