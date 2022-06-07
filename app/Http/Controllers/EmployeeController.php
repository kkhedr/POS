<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class EmployeeController extends Controller
{
    public function index(){
        $emps = Employee::all();
        return View::make('admin/employee/index',compact('emps'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'salary' => 'required|numeric',
        ]);



        $emp = new Employee();
        $emp->name = $request->name;
        $emp->salary = $request->salary;
        $emp->save();

        return back()->with('success', 'تم إضافة الموظف');
    }

    public function update(Request $request,$id){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'salary' => 'required|numeric',
        ]);



        $emp = Employee::find($id);
        $emp->name = $request->name;
        $emp->salary = $request->salary;
        $emp->save();

        return back()->with('edit', 'تم تعديل الموظف');
    }

    public function destroy($id){
       
        $emp = Employee::find($id);
        $emp->delete();

        return back()->with('delete', 'تم مسح الموظف');
    }
}
