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
    public function field()
    {
        return $this->belongsTo(Request_Form_Field::class, 'request_form_field_id', 'id');
    }

    public function entry()
    {
        return $this->belongsTo(Request_Form_Entries::class, 'request_form_entry_id', 'id');
    }
}
