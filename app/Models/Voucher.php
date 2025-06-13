<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = ['date', 'customer_name', 'customer_phone', 'car_brand', 'car_model', 'car_number', 'discount', 'total', 'note'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
