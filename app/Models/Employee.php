<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function details()
    {
        return $this->hasOne(EmployeeDetails::class, 'employeeId', 'id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'employeeId', 'id');
    }
}
