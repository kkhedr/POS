<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderCreate;
use App\Models\OrderOperation;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\ProductOption;
use Carbon\Carbon;
use App\Models\selling;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SellingController extends Controller
{
    public function index(Request $request){

        $categories = Category::all();
        $category_ids = [];

        $products = Product::with('options')->when($request->key_search == '1',function($q) use ($request){

            $q->where('name','LIKE','%'.$request->value_search.'%');

        })->when($request->key_search == '2',function($q) use ($request,$categories){
            foreach($categories as $index => $catg){
                if(str_contains($catg->name,$request->value_search)){
                 $category_ids[$index]  = $catg->id;
                }
             }
              $q->whereIn('category_id', $category_ids);
        })->when($request->key_search == '3',function($q) use ($request){

              $q->where('price', $request->value_search);
        })->latest()->paginate(20)->appends(request()->query());


        return view('orders/layouts/app_test',compact('products','categories'));
    }

    public function get_orders_today(){

        $orders = OrderCreate::with(['product','options'])->whereDate('created_at',Carbon::now()->format('Y-m-d'))->orderBy('id', 'DESC')->get();
        $orders_profits = 0;
           $order_num_count = OrderCreate::select('order_id', \DB::raw('COUNT(id) as order_count'))->whereDate('created_at',Carbon::now()->format('Y-m-d'))
           ->groupBy('order_id')
           ->orderBy('id', 'DESC')->get();

           $order_content_html = " ";
    $amount = 0;
    $price_total = 0;
    $count = 0;
    $i = 0;
    $price_buy = 0;
    $discount_total = 0;
    $price_total_for_order = 0;
      foreach($orders as $order){
        $order_content_html .= "<tr>";
        $count = $count + 1;
        $order_content_html .="<td style='color:white'>#".$order->order_id."</td>";
        $order_content_html .="<td style='color:white'>".$order->product_id."</td>";
        $order_content_html .="<td style='color:white'>".$order->product[0]->name."</td>";
        $order_content_html .="<td style='color:white'>".$order->options[0]->color."</td>";
        $order_content_html .="<td style='color:white'>".$order->amount."</td>";
        $order_content_html .="<td style='color:white'>".$order->options[0]->stock."</td>";
        $order_content_html .="<td style='color:white'>".$order->price."</td>";
        $order_content_html .="<td style='color:white'>".$order->price * $order->amount."</td>";
        $order_content_html .="<td style='color:white'>".$order->created_at."</td>";

        $order_content_html .="<td style='color:white'>". "<a class='return_product return_product".$order->id." btn btn-primary' data-transaction_id =".$order->id." >إسترجاع</a></td>";


        $order_content_html .= "</tr>";

        $price_total = $price_total + ($order->amount * $order->price);

        $price_buy = $price_buy + ($order->product[0]->price_buy * $order->amount);

        $price_total_for_order = $price_total_for_order + ($order->price * $order->amount);
        if($order_num_count[$i]->order_id == $order->order_id && $count == $order_num_count[$i]->order_count)
        {
            $price_total = $price_total - $order->order[0]->discount;
            $discount_total = $discount_total + $order->order[0]->discount;
            $order_content_html .= "<tr class='price_total_content' style='background-color:#8B0000;border-radius:0px 30px 30px 0px;'>";

            $order_content_html .= "<td colspan='3'><h2 style='font-size:15px;font-weight:bold;color:black'> السعر بعد الخصم:</h2></td>";

            $order_content_html .= "<td colspan='3'><h2 style='font-size:15px;color:black'> ".$price_total_for_order - $order->order[0]->discount."جنيه</h2> </td>";


            $order_content_html .= " <td colspan='1'><h4 style='font-size:15px;font-weight:bold;color:black'> قيمة الخصم:</h4></td>";

            $order_content_html .= "<td colspan='2'><h4 style='font-size:15px;color:black'>".$order->order[0]->discount."جنيه</h4></td>";


            $order_content_html .= "</tr>";
            $price_total_for_order = 0;
            $count = 0;
            $i = $i + 1;
        }
      }


        $orders_profits = $price_total - $price_buy;

        return response()->json([$price_total,$order_content_html,$discount_total,$orders_profits]);

    }

    function product_options($product_id,$color){
       $options = ProductOption::where('product_id',$product_id)->where('color',$color)->get();
       return response()->json($options);
    }

    public function create_order(Request $request){
       $product = Product::find($request->product_id);
       $order_status = OrderStatus::latest()->first();
       if(empty($order_status) || $order_status->status != 0){
           $order = Order::create([
            'discount' => 0,
            'cust_id' => null,
           ]);
           OrderStatus::create([
              'order_id' =>  $order->id,
               'status' => 0
           ]);
       }
       $order = Order::latest()->first();
        //return response()->json($order->id);

        $product_count = OrderOperation::where('product_id',$product->id)->where('order_id',$order->id)->get()->count();

        if($product_count == 0)
        {
            foreach ($request->options_id as $index => $option)
            {
                OrderCreate::create([
                    'order_id'=>$order->id,
                    'product_id'=>$request->product_id,
                    'option_id'=>$option,
                    'amount' => $request->amounts[$index],
                    'price' => $request->product_price
                ]);
            }

            $sell = OrderOperation::create([
                'price' => 0,
                'amount' => 1,
                'product_id' => $product->id,
                'order_id' => $order->id
            ]);
            $orders_count = Order::get()->count();

            $products = OrderCreate::where('order_id',$order->id)->where('product_id',$request->product_id)->get();
            $sup_order = [];
            $options=[];
            $option_aux=[];
            $product_content = Product::where('id',$request->product_id)->first();
            foreach ($products as $index => $suporder){
                $option_content =  ProductOption::where('id',$suporder->option_id)->first();
                array_push($option_aux,$option_content->color);
                array_push($option_aux,$suporder->amount);
                array_push($option_aux,$suporder->price);
                array_push($options,$option_aux);
                $option_aux = [];
            }
            $sup_order = array('product'=>$product_content,'options'=>$options);
            $order_id = $order->id;
            return response()->json([$sup_order,$order_id,$orders_count,$request->product_id]);
        }

    }

    public function setPriceProduct(Request $request){
     $order = Order::latest()->first();
     $option = ProductOption::where('product_id',$request->product_id)->where('color',$request->color_name)->first();
     $product = OrderCreate::where('order_id',$order->id)->where('product_id',$request->product_id)->where('option_id',$option->id)->first();
     $product->amount = $request->new_price;
     $product->save();

     $order = OrderCreate::where('order_id',$order->id)->get();
     $price_total = 0 ;
     foreach($order as $details){
        $price_total = $price_total + ($details->amount * $details->price);
     }

     return response()->json($price_total);

    }

    public function check_order(){
        $order_status = OrderStatus::latest()->first();
        $order = array();
        $order_aux = array();
        $options = array();
        if($order_status->status == 0)
        {
            $order_operation = OrderOperation::with('product')->where('order_id',$order_status->order_id)->get();
            foreach ($order_operation as $order_details) {
                array_push($order_aux, array('order_id' => $order_details->order_id));
                array_push($order_aux, array('product_id' => $order_details->product_id));
                array_push($order_aux, array('product_content' => $order_details->product));
                $options = ProductOption::where('product_id', $order_details->product_id)->get();
                $order_content = OrderCreate::with('options')->where('product_id',$order_details->product_id)->where('order_id',$order_status->order_id)->get();

                $options_id = [];
                $amounts = [];
                $prices = [];

                foreach ($order_content as $order_con){
                    array_push($options_id,$order_con->id);
                    $amounts[$order_con->id] = $order_con->amount;
                    $prices[$order_con->id] = $order_con->price;
                }
                foreach ($order_content as $index => $order_con) {
                    if(in_array($order_con->id, $options_id))
                    {
                        $option_id = $order_con->id;
                        $options_value[$index] = array($order_con->options[0]->color,$amounts[$option_id],$prices[$option_id]);
                    }
                }
                $amounts = array();
                $prices = array();

                array_push($order_aux, array('option' => $options_value));
                $options_value = array();
                array_push($order, $order_aux);
                unset($order_aux);
                $order_aux = array();
            }


            return response()->json([$order,$order_status->order_id]);
        }

        return response()->json(0);
    }

    public function check_order_open(){
        $order_status = OrderStatus::latest()->first();
        if(!empty($order_status) && $order_status->status == 0){
            return response()->json(1);
        }
    }

    public function delete_product($product_id){

      $order = Order::latest()->first();
      
      $product_result = null;
      $product_will_delete = null;
      $price_total = 0;
      $result = OrderOperation::where('order_id',$order->id)->where('product_id',$product_id)->first();
      
      $products_count =  OrderOperation::where('order_id',$order->id)->count();
      $product_result = $result;
      $result->delete();
      
      
        $product_will_delete = OrderCreate::where('order_id',$order->id)->where('product_id',$product_id)->get();

        foreach($product_will_delete as $product){
            $price_total = $price_total + ($product->price * $product->amount );
        }
        
        OrderCreate::where('order_id',$order->id)->where('product_id',$product_id)->delete();
        $closed_order = 0;
        if($products_count == 1){
            OrderStatus::where('order_id',$order->id)->delete();
            Order::where('id',$order->id)->delete();
            $closed_order = 1;
        }

      return response()->json([$product_result,$closed_order,$price_total]);
    }
}
