<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccountDetails extends Model
{
    protected $table = 'bank_acc_details';

    protected $fillable = [
        'request_id',
        'bank_name',
        'bank_branch',
        'bank_acc_num',
        'bank_acc_name',
    ];

    public function request()
    {
        return $this->belongsTo(Request_Number::class, 'request_id', 'id');
    }
}
