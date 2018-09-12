<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        $departments= DB::select('select name from departments');
        $employees= DB::select('select group_concat(distinct d.name) as department, e.name 
 from employees e INNER JOIN dev_emp de on e.id = de.employee_id INNER JOIN departments d on 
 de.department_id = d.id GROUP BY e.name');
        return view('index',[
            'departments'=>$departments,
            'employees'=>$employees
            ] );
    }
}
