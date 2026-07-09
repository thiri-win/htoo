<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = ['date', 'record_number', 'description', 'car_id', 'category_id', 'sub_total', 'discount', 'advance', 'grand_total', 'remark'];

    protected $casts = ['date' => 'datetime'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($record) {
            if ($record->category_id === 1) {
                $recordDate = $record->date ? \Carbon\Carbon::parse($record->date) : now();
                $datePrefix = $recordDate->format('Ym');
                $count = static::where('record_number', 'like', 'INV' . $datePrefix . '%')->count();
                $sequence = sprintf('%04d', $count + 1);
                $record->record_number = 'INV' . $datePrefix . $sequence;
            } else {
                $record->record_number = null;
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
