<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['customer_name', 'customer_phone', 'car_number', 'car_brand', 'car_model'];

    public function records()
    {
        return $this->hasMany(Record::class);
    }
}
