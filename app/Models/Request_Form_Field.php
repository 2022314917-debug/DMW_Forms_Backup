<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request_Form_Field extends Model
{
    protected $table = 'request_form_field';

    protected $fillable = [
        'request_form_id',
        'parent_id',
        'field_name',
        'field_label',
        'field_type',
        'option_group'
    ];

    public function form()
    {
        return $this->belongsTo(Request_Form::class, 'request_form_id', 'id');
    }
}
