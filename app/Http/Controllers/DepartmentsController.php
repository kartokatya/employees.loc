<?php

namespace App\Http\Controllers;

use App\Departments;
use App\DevEmp;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DepartmentsController extends Controller
{
    public function index(){

        $departments = DB::select('select  
d.id, d.name,  COUNT(de.employee_id) count_emp, MAX(e.salary) max_salary from employees e INNER JOIN dev_emp de on e.id = de.employee_id RIGHT JOIN departments d on 
 de.department_id = d.id GROUP BY d.name, d.id');
        return view('departments.index',[
            'departments'=>$departments,
        ]);
    }
    /**
     * @param  Request  $request
     * @return Response
     */
    public function create(){
        $department=Departments::all();
        return view('departments.create',[
            'department'=>$department
        ]);
    }

    public function createRequest(Request $request){
        try{
            $this->validate($request, [
                'name'=>'required|string|max:255',
            ]);
            $department = new Departments();
            $department = $department->create([
                'name'=>$request->name,
            ]);

            $department->save();

            if($department){
                return redirect('/departments');
            }
            return back();
        }catch(ValidationException $e){
            Log::error($e->getMessage());
            return back()->with('error',$e->getMessage());
        }

    }

    public function edit($id){
        $department = Departments::find($id);
        if (!$department){
            return abort(404);
        }
        return view('departments.edit',[
            'department'=>$department,
        ]);
    }

    public function editRequest(Request $request,$id){
        try{
            $this->validate($request, [
                'name'=>'required|string|max:255',
            ]);
            $department = Departments::find($id);

            if (!$department){
                return abort(404);
            }

            $department->name = $request->name;

            $department->save();

            if($department){
                return redirect('/departments');
            }
            return back();
        }catch(ValidationException $e){
            Log::error($e->getMessage());
            return back()->with('error',$e->getMessage());
        }

    }

    public function delete($id){
        $depEmp = DB::select('select * from dev_emp WHERE dev_emp.department_id = ?', array($id));


        if($depEmp == NULL){
            $department = Departments::find($id);
            $department->delete();
            return back();
        }else{
            echo "В этом отделе есть сотрудники";
        }

    }
}
