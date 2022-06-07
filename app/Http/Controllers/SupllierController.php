<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supllier;
use App\Models\PaidSupllier;
use App\Models\money_sup;
use Illuminate\Support\Facades\View;

class SupllierController extends Controller
{
    public function index(){
        $sups = Supllier::paginate(10)->appends(request()->query());;
        
        $price_sup_total = 0;
        $money_paid_total = 0;
        $money_stay_total = 0;
        $paids_sup = array();
        $money = array();
        
        foreach($sups as $sup){
           $paids =  PaidSupllier::with('sups')->where($sup->sup_id)->get();
           $paids_money_to =  money_sup::where($sup->sup_id)->get();

           foreach($paids as $paid){
            $price_sup_total = $price_sup_total + $paid->price;
           }

           foreach($paids_money_to as $paid_money_to){
            $money_paid_total = $money_paid_total + $paid_money_to->money;
            array_push($money,array('id'=>$paid_money_to->id,'name'=>$sup->name,'phone'=>$sup->phone,'total_price'=>$price_sup_total,'money'=>$paid_money_to->money,'created_at'=>$paid_money_to->created_at));
           }

           $money_stay_total = $price_sup_total - $money_paid_total;
           array_push($paids_sup,array('name'=>$sup->name,'phone'=>$sup->phone,'total_price'=>$price_sup_total,'total_money'=>$money_paid_total,'stay'=>$money_stay_total));
            
        }
        $paids_sup = json_encode($paids_sup);
        $money = json_encode($money);

        $paids_sup = json_decode($paids_sup,true);
        $money = json_decode($money,true);

        return View::make('admin/supplier/index',compact('sups','paids_sup','money'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|numeric',
        ]);



        $emp = new Supllier();
        $emp->name = $request->name;
        $emp->phone = $request->phone;
        $emp->save();

        return back()->with('success', 'تم إضافة المورد');
    }

    public function update(Request $request,$id){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|numeric',
            
        ]);



        $emp = Supllier::find($id);
        $emp->name = $request->name;
        $emp->phone = $request->phone;
        $emp->save();

        return back()->with('edit', 'تم تعديل المورد');
    }

    public function destroy($id){
       
        $emp = Supllier::find($id);
        $emp->delete();

        return back()->with('delete', 'تم مسح المورد');
    }

    public function SupPaidstore(Request $request){
        $validated = $request->validate([
            'sup_id' => 'required',
            'money' => 'required|numeric',
        ]);



        $emp = new money_sup();
        $emp->sup_id = $request->sup_id;
        $emp->money = $request->money;
        $emp->save();

        return back()->with('success', 'تم دفع دفعة للمورد ');
    }

    public function SupPaidupdate(Request $request,$id){
        $validated = $request->validate([
            'sup_id' => 'required',
            'money' => 'required|numeric',
        ]);



        $emp = money_sup::find($id);
        $emp->sup_id = $request->sup_id;
        $emp->money = $request->money;
        $emp->save();

        return back()->with('edit', 'تم تعديل  الدفعة من هذا المورد  ');
    }

    public function SupPaiddestroy($id){
       
        $emp = money_sup::find($id);
        $emp->delete();

        return back()->with('delete', 'تم إسترجاع الدفعة من المورد');
    }

}
