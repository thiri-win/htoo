<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['record_id', 'customer_name', 'customer_phone', 'car_number', 'car_brand', 'car_model'];
}
