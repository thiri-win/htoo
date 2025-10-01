<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = ['date', 'description', 'category_id', 'sub_total', 'discount', 'grand_total', 'remark'];

    protected $casts = ['date' => 'datetime'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function car()
    {
        return $this->hasOne(Car::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
