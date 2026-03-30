<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'request';
    
    protected $fillable = [
        'user_id',
        'status'
    ];

    public function requestParty()
    {
        return $this->hasOne(Request_Party::class);
    }

    public function requestOfw()
    {
        return $this->hasOne(Request_OFW::class);
    }

    public function requestFormEntries()
    {
        return $this->hasMany(Request_Form_Entries::class);
    }

    public function requestFormFieldValues()
    {
        return $this->hasMany(Request_Form_Field_Values::class);
    }

    public function requestPartyAddress()
    {
        return $this->hasOne(Request_Party_Address::class);
    }
}
