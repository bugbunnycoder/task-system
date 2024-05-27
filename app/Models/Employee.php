<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['username', 'useremail', 'userid'];

    // Additional model logic, such as relationships or custom methods, can be added here
}
