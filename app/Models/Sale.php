<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['description', 'quantity', 'unit_price', 'sub_total'];

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}
