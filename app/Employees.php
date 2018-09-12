<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $table = "employees";
    protected $fillable = ['name','first_name','last_name','gender','salary'];
    protected $dates = ['created_at','updated_at'];
}
