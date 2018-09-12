<?php

namespace App\Http\Controllers;

use App\Departments;
use App\DevEmp;
use App\Employees;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{
    public function index(){
        $employees = DB::select('select group_concat(distinct d.name) as department, 
e.id, e.name, e.first_name, e.last_name, e.gender, e.salary
 from employees e INNER JOIN dev_emp de on e.id = de.employee_id INNER JOIN departments d on 
 de.department_id = d.id GROUP BY e.id', array(1));
        return view('employees.index',[
            'employees'=>$employees,
        ]);
    }
    /**
     * @param  Request  $request
     * @return Response
     */
    public function create(){
        $departments=Departments::all();
        return view('employees.create',[
            'departments'=>$departments
        ]);
    }

    public function createRequest(Request $request){
        try{
            $this->validate($request, [
                'name'=>'required|string|max:255',
                'first_name'=>'required|string|max:255',
                'last_name'=>'required|string|max:255',
                'gender'=>'required|string|max:255',
                'salary'=>'required|integer',
            ]);
            $employee = new Employees();
            $employee = $employee->create([
                'name'=>$request->name,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'gender'=>$request->gender,
                'salary'=>$request->salary,
            ]);

            $employee->save();

            if($employee){
                foreach ($request->department as $department_id){
                    $devEmp = new DevEmp();
                    $devEmp->create([
                        'department_id'=>$department_id,
                        'employee_id'=>$employee->id,
                    ]);
                }
               return redirect('/employees');
            }
            return back();
        }catch(ValidationException $e){
            Log::error($e->getMessage());
            return back()->with('error',$e->getMessage());
        }

    }

    public function edit($id){
        $employee = DB::select('select group_concat(distinct d.name) as department, 
e.id, e.name, e.first_name, e.last_name, e.gender, e.salary
 from employees e INNER JOIN dev_emp de on e.id = de.employee_id INNER JOIN departments d on 
 de.department_id = d.id  WHERE e.id = ? GROUP BY e.id', array($id));
        $employee =$employee[0];
        $employee->department = explode(',',$employee->department);
        $departments=Departments::all();
        if (!$employee){
            return abort(404);
        }
        return view('employees.edit',[
            'employee'=>$employee,
            'departments'=>$departments,
        ]);
    }

    public function editRequest(Request $request,$id){
        try{
            $this->validate($request, [
                'name'=>'required|string|max:255',
                'first_name'=>'required|string|max:255',
                'last_name'=>'required|string|max:255',
                'gender'=>'required|string|max:255',
                'salary'=>'required|integer',

            ]);

            $employee = Employees::find($id);


            if (!$employee){
                return abort(404);
            }

             $employee->name=$request->name;
             $employee->first_name=$request->first_name;
             $employee->last_name=$request->last_name;
             $employee->gender=$request->gender;
              $employee->salary=$request->salary;

            $employee->save();



            if($employee){
                $depEmp = DevEmp::where('employee_id',$employee->id)->delete();
                foreach ($request->department as $department_id) {
                    $depEmp = new DevEmp();
                    $depEmp->create([
                        'employee_id' => $employee->id,
                        'department_id' => $department_id,
                    ]);
                }
                return redirect('/employees');
            }
            return back();
        }catch(ValidationException $e){
            Log::error($e->getMessage());
            return back()->with('error',$e->getMessage());
        }

    }

    public function delete($id){
        $depEmp = new DevEmp();
        $depEmp->where('employee_id',$id)->delete();
        $employee = Employees::find($id);
        $employee->delete();
        return back();
    }
}
