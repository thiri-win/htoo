<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['record_id', 'description', 'quantity', 'unit_price', 'total'];
}
