<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Startup_Equipment_Products extends Model
{
    protected $table = 'elpor_startup_equipment_products';
    protected $fillable = [
        'request_id',
        'item_category',
        'supplier_name',
        'item_name',
        'item_price',
        'item_qty',
        'item_total'
    ];

    public function request()
    {
        return $this->belongsTo(Request_Number::class, 'request_id', 'id');
    }
}
