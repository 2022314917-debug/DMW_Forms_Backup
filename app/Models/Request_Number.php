<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request_Number extends Model
{
    protected $table = 'request';
    
    protected $fillable = [
        'user_id',
        'status'
    ];

    public function requestParty()
    {
        return $this->hasOne(Request_Party::class, 'request_id', 'id');
    }

    public function requestOfw()
    {
        return $this->hasOne(Request_OFW::class, 'request_id', 'id');
    }

    public function requestFormEntries()
    {
        return $this->hasMany(Request_Form_Entries::class, 'request_id', 'id');
    }

    public function requestFormFieldValues()
    {
        return $this->hasMany(Request_Form_Field_Values::class, 'request_id', 'id');
    }

    public function requestOfwAddress()
    {
        return $this->hasOne(Request_Ofw_Address::class, 'request_id', 'id');
    }

    public function requestPartyAddress()
    {
        return $this->hasOne(Request_Party_Address::class, 'request_id', 'id');
    }

    public function statusHistory()
    {
        return $this->hasMany(Request_Status_History::class, 'request_id', 'id');
    }

    public function requirements()
    {
        return $this->hasMany(Requirements::class, 'request_id', 'id');
    }
}