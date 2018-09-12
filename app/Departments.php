<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    protected $table = "departments";
    protected $fillable = ['name'];
    protected $dates = ['created_at','updated_at'];
}
