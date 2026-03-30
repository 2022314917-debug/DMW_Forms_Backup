<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request_Party extends Model
{
    protected $table = 'request_party';

    protected $fillable = [
        'request_id',
        'party_lname',
        'party_fname',
        'party_ename',
        'party_mname',
        'party_email',
        'party_phone',
        'party_bday',
        'party_gender',
        'party_relationship'
    ];

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function address()
    {
        return $this->hasOne(Request_Party_Address::class);
    }
}
