<?php

namespace App\Http\Controllers;
use App\Models\Netprofit;
use App\Models\Employee;
use App\Models\Paidemp;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;

class NetprofitController extends Controller
{
    public function index(Request $request){
        $nets = Netprofit::paginate(10);
        $emps = Employee::all();

        $salary_details = array();
        $money = 0;
        $stay = 0;
        if($request->date_month){
            $emps = Employee::all();
        $orderdate = explode('-', $request->date_month);
       
            $month = $orderdate[1];
            $day   = $orderdate[2];
            $year  = $orderdate[0];
            
            foreach($emps as $emp){
                $paid_emps = Paidemp::with('emps')->whereMonth('created_at',$month)->whereYear('created_at',$year)->where('emp_id',$emp->id)->paginate(10);

                foreach($paid_emps as $paid_emp){
                    $money = $money + $paid_emp->money;
                }

                if($paid_emps[0] != null){
                    $stay = $paid_emps[0]->emps[0]->salary - $money;
                    array_push($salary_details,array('name'=>$paid_emps[0]->emps[0]->name,'salary'=>$paid_emps[0]->emps[0]->salary,'money'=>$money,'stay'=>$stay));
                }
            }
            
        }else{
            $paid_emps = Paidemp::with('emps')->paginate(10);
            foreach($paid_emps as $paid_emp){
                array_push($salary_details,array('id'=>$paid_emp->id,'name'=>$paid_emp->emps[0]->name,'salary'=>$paid_emp->emps[0]->salary,'money'=>$paid_emp->money,'created_at'=>$paid_emp->created_at));

            }

        }

        $salary_details = json_encode($salary_details);
        $salary_details = json_decode($salary_details,true);

       
        return View::make('admin/out_profit/index',compact('nets','emps','salary_details'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'desc' => 'required',
            'price' => 'required|numeric',
        ]);



        $emp = new Netprofit();
        $emp->desc = $request->desc;
        $emp->price = $request->price;
        $emp->save();

        return back()->with('success', 'تم إضافة هذا المصروف');
    }

    public function update(Request $request,$id){
        $validated = $request->validate([
            'desc' => 'required',
            'price' => 'required|numeric',
        ]);



        $emp = Netprofit::find($id);
        $emp->desc = $request->desc;
        $emp->price = $request->price;
        $emp->save();

        return back()->with('edit', 'تم تعديل المصروف');
    }

    public function destroy($id){
       
        $emp = Netprofit::find($id);
        $emp->delete();

        return back()->with('delete', 'تم مسح المصروف');
    }

    public function EmpPaidstore(Request $request){
        $validated = $request->validate([
            'emp_id' => 'required',
            'money' => 'required|numeric',
        ]);



        $emp = new Paidemp();
        $emp->emp_id = $request->emp_id;
        $emp->money = $request->money;
        $emp->save();

        return back()->with('success', 'تم دفع دفعة من الراتب للموظف ');
    }

    public function EmpPaidupdate(Request $request,$id){
        $validated = $request->validate([
            'emp_id' => 'required',
            'money' => 'required|numeric',
        ]);



        $emp = Paidemp::find($id);
        $emp->emp_id = $request->emp_id;
        $emp->money = $request->money;
        $emp->save();

        return back()->with('edit', 'تم تعديل  الدفعة من راتب للموظف  ');
    }

    public function EmpPaiddestroy($id){
       
        $emp = Paidemp::find($id);
        $emp->delete();

        return back()->with('delete', 'تم إسترجاع الدفعة المصروفة للموظف');
    }


}
