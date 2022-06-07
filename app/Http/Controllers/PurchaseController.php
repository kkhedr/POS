<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Category;
use App\Models\PaidSupllier;
use App\Models\Product;
use App\Models\ProductOption;

class PurchaseController extends Controller
{
    public function index(Request $request){
        global $product_ids;
        if(is_numeric($request->search))
        {
           $product_ids = Product::where('price',$request->search)->pluck('id');
         
        }else{
           $product_ids = Product::where('name','LIKE','%'.$request->search.'%')->pluck('id');
        }

        if($request->category_search){
            $product_ids = Product::where('category_id',$request->category_search)->pluck('id');

        }

        $purchases = Purchase::with(['product'=>function($q){
            $q->with('category');
        },'supplier'])->when($request->search,function($q) use ($request,$product_ids){
            
             $q->whereIn('product_id',$product_ids);
            
     
         })->when($request->category_search,function($q) use ($request,$product_ids){
            $q->whereIn('product_id',$product_ids);
          })->when($request->start_date,function($q) use ($request){
             $q->whereDate('updated_at','>=',$request->start_date);
         })->when($request->to_date,function($q) use ($request){
             $q->whereDate('updated_at','<=',$request->to_date);
         })->orderBy('id', 'DESC')->paginate(50)->appends(request()->query());
     
            $catgeories = Category::all();
     
        return view('admin/purchase/index',compact('purchases','catgeories'));
    }

    public function editStock(Request $request){
        $return_price = 0;
        $plus_price = 0;
        $stock_return = 0;
       $purshase =  Purchase::with(['product','supplier'])->find($request->id);
       $stock_return = $purshase->stock - $request->stock_edit;

       if($stock_return != 0)
       {
        if($stock_return > 0){
            $purshase->stock = $request->stock_edit;
            $purshase->save();

            if(isset($purshase->size)){
               $option =  ProductOption::where('color',$purshase->color)->where('size',$purshase->size)->where('product_id',$purshase->product_id)->first();
               $option->stock = $request->stock_edit;
               $option->save();
            }else{
                $option =  ProductOption::where('color',$purshase->color)->where('product_id',$purshase->product_id)->first();
               $option->stock = $request->stock_edit;
               $option->save();
            }

            $return_price = $stock_return * $purshase->product[0]->price_buy;
            $price_tot = PaidSupllier::where('product_id',$purshase->product_id)->where('sup_id',$purshase->sup_id)->first();
            $price_tot->price = $price_tot->price - $return_price;
            $price_tot->save();
            
           }elseif($stock_return < 0){
            $purshase->stock = $request->stock_edit;
            $purshase->save();
            if(isset($purshase->size)){
                $option =  ProductOption::where('color',$purshase->color)->where('size',$purshase->size)->where('product_id',$purshase->product_id)->first();
                $option->stock = $request->stock_edit;
                $option->save();
             }else{
                 $option =  ProductOption::where('color',$purshase->color)->where('product_id',$purshase->product_id)->first();
                $option->stock = $request->stock_edit;
                $option->save();
             }
            $return_price = ($stock_return * -1) * $purshase->product[0]->price_buy;
            $price_tot = PaidSupllier::where('product_id',$purshase->product_id)->where('sup_id',$purshase->sup_id)->first();
            $price_tot->price = $price_tot->price + $return_price;
            $price_tot->save();
           }
       }elseif($stock_return == $purshase->stock){
        $purshase->stock = $request->stock_edit;
        $purshase->save();
        if(isset($purshase->size)){
            $option =  ProductOption::where('color',$purshase->color)->where('size',$purshase->size)->where('product_id',$purshase->product_id)->first();
            $option->stock = $request->stock_edit;
            $option->save();
         }else{
             $option =  ProductOption::where('color',$purshase->color)->where('product_id',$purshase->product_id)->first();
            $option->stock = $request->stock_edit;
            $option->save();
         }
        $return_price = $stock_return * $purshase->product[0]->price_buy;
        $price_tot = PaidSupllier::where('product_id',$purshase->product_id)->where('sup_id',$purshase->sup_id)->first();
        $price_tot->price = $price_tot->price - $return_price;
        $price_tot->save();
       }
        return back()->with('edit', 'تم تعديل الكمية');

       
    }

    public function destroy($id){
        $purshase =  Purchase::with(['product','supplier'])->find($id);   

        $product = Purchase::find($id);
        $product->delete();
       $price_tot = PaidSupllier::where('product_id',$purshase->product_id)->where('sup_id',$purshase->sup_id)->delete();
        
        return back()->with('delete', '  تم مسح المنتج وتم خصم التكلفة ');
    }
}
