<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DevEmp extends Model
{
    protected $table = "dev_emp";
    protected $fillable = ['department_id','employee_id'];
    protected $dates = ['created_at','updated_at'];
}
