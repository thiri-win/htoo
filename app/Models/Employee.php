<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name', 'dob', 'join_date', 'leave_date'];

    public function salaryHistories()
    {
        return $this->hasMany(SalaryHistory::class);
    }

    public function latestSalary()
    {
        return $this->hasOne(SalaryHistory::class)->latestOfMany();
    }
}
