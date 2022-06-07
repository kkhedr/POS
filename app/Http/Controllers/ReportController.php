<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderCreate;
use App\Models\Product;
use App\Models\ProductOption;
use Carbon\Carbon;

class ReportController extends Controller
{

    public function index(Request $request){

             $options = null;
             $product_count = 0;
             $product_name = '';
             $options_count = [];
             $product_count_all = [];
             $options_color = [];
             $option_counter = 0;
             $options_amount = [];
             $option_amount = 0;
  
         if($request->start_date && $request->to_date)
         {
             $products = OrderCreate::with(['product'])->when($request->start_date,function($q) use ($request){
                
                $q->whereDate('created_at','>=',$request->start_date);
             })->when($request->to_date,function($q) use ($request){
                
                 $q->whereDate('created_at','<=',$request->to_date);
             })->select('product_id',\DB::raw('COUNT(product_id) as product_count'))->groupBy('product_id')->orderBy('product_count', 'DESC')->get();
             

             foreach($products as $product){
                $options =  ProductOption::where('product_id',$product->product_id)->get();

                foreach($options as $option){

                    $option_count = OrderCreate::whereDate('created_at','>=',$request->start_date)->whereDate('created_at','<=',$request->to_date)->where('product_id',$product->product_id)->where('option_id',$option->id)->get()->count();
                    $option_amount = OrderCreate::whereDate('created_at','>=',$request->start_date)->whereDate('created_at','<=',$request->to_date)->where('product_id',$product->product_id)->where('option_id',$option->id)->sum('amount');

                    array_push($options_amount,$option_amount);
                    array_push($options_count,$option_count);
                    array_push($options_color,$option->color);
    
                 }
                 

                 array_push($product_count_all,array("title"=>$product->product[0]->name,'options_count'=>$options_count,'colors'=>$options_color,'amounts'=>$options_amount));
                 $options_count = [];
                 $options_color = [];
                 $options_amount = [];
             }

             
             
            }else{
                $product_max_count = OrderCreate::whereMonth('created_at', Carbon::now()->month)->select('product_id',\DB::raw('COUNT(product_id) as product_count'))->groupBy('product_id')->orderBy('product_count', 'DESC')->get();
             
                $product_min_count = OrderCreate::whereMonth('created_at', Carbon::now()->month)->select('product_id',\DB::raw('COUNT(product_id) as product_count'))->groupBy('product_id')->orderBy('product_count', 'ASC')->get();
 
                if(count($product_max_count) > 0)
                {
                    
 $products_id = [$product_max_count[0]->product_id,$product_min_count[0]->product_id];
                
                foreach($products_id as $product_id )
                {
                    $product =  Product::find($product_id);

                    $options =  ProductOption::with('product')->where('product_id',$product_id)->get();
            
                    $product_name = $product->name;
                    foreach($options as $option){
                        $option_count = OrderCreate::whereMonth('created_at', Carbon::now()->month)->where('product_id',$product_id)->where('option_id',$option->id)->get()->count();
                        $option_amount = OrderCreate::whereMonth('created_at', Carbon::now()->month)->where('product_id',$product_id)->where('option_id',$option->id)->sum('amount');
                        
                        
                        array_push($options_amount,$option_amount);
                       

                        array_push($options_count,$option_count);
                        array_push($options_color,$option->color);
                    }

                array_push($product_count_all,array('title'=>$product->name,'options_count'=>$options_count,'colors'=>$options_color,'amounts'=>$options_amount));
                 $options_count = [];
                 $options_color = [];
                 $options_amount = [];
    
                }
                }else{
                    array_push($product_count_all,array('title'=>'','options_count'=>[],'colors'=>[]));

                }
               
        
            }

            
         
        
          

        return view('admin/report/report',compact('product_count_all'));
        
    }

    
}
