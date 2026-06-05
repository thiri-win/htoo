<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = ['date', 'subject', 'to', 'items', 'sub_total', 'discount', 'advance',  'grand_total', 'remark'];

    protected $casts = ['items' => 'array'];
}