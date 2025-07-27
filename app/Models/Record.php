<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = ['date', 'title', 'category_id', 'amount', 'remark'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
