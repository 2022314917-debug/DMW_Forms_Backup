<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $table = 'office';

    protected $fillable = [
        'office_name',
        'office_address',
    ];

    public function employees()
    {
        return $this->hasMany(Employees::class);
    }
}
