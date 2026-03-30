<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessingRequest extends Model
{
    // huwag mo pansinin to
    use HasFactory;

    protected $fillable = [
        'ofw_family_name',
        'ofw_first_name',
        'ofw_middle_name',
        'jobsite',
        'record_year',
        'purpose',
        'agency_name',
        'req_family_name',
        'req_first_name',
        'req_middle_name',
        'relationship_ofw',
        'contact_number',
        'phil_address',
        'province',
        'municipality',
        'barangay',
        'zipcode',
        'telephone_number',
        'email_address',
    ];
}
