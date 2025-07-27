<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'status', 'remark'];

    public function records() 
    {
        return $this->hasMany(Record::class);
    }
}
