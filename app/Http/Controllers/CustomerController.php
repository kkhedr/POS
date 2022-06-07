<?php

namespace App\Http\Controllers;

use App\Models\OrderCreate;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Netprofit;
use App\Models\Paidemp;
use App\Models\ProductOption;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\DB;
use Mpdf\Output\Destination;
use PDF;


class CustomerController extends Controller
{

   
    public function get_customer_name($phone){
        
     $customer = Customer::where('phone',$phone)->first();
     if($customer){
        return response()->json($customer->name);
     }
     return response()->json(0);
    
     
    }

    public function index(Request $request){
        global $orders;
        global $order_num_count;
        $noet_total = 0;
        $cutomers = Customer::all();

        $cutomers_data = null;

         if($request->start_date && $request->to_date && $request->cust_id)
         {
             $cust_orders = Order::where('cust_id',$request->cust_id)->pluck('id');

             $cutomers_data = Customer::find($request->cust_id);

             

             
             $orders = OrderCreate::with(['product','options','order'])->when($request->start_date,function($q) use ($request){
                 $q->whereDate('created_at','>=',$request->start_date);
             })->when($request->to_date,function($q) use ($request){
                 $q->whereDate('created_at','<=',$request->to_date);
             })->whereIn('order_id',$cust_orders)->orderBy('id', 'DESC')->get();


             

             $order_num_count = OrderCreate::select('order_id', \DB::raw('COUNT(id) as order_count'))->when($request->start_date,function($q) use ($request){
              $q->whereDate('created_at','>=',$request->start_date);
          })->when($request->to_date,function($q) use ($request){
              $q->whereDate('created_at','<=',$request->to_date);
          })->groupBy('order_id')
          ->whereIn('order_id',$cust_orders)->orderBy('id', 'DESC')->get();

          $net_out = Netprofit::whereDate('created_at','>=',$request->start_date)->whereDate('created_at','<=',$request->to_date)->sum('price');
         $paid_emp_out = Paidemp::whereDate('created_at','>=',$request->start_date)->whereDate('created_at','<=',$request->to_date)->sum('money');
          $noet_total = $noet_total + ($net_out + $paid_emp_out);

         }else{
             $orders = OrderCreate::with(['product','options','order'])->whereDate('created_at',Carbon::now()->format('Y-m-d'))->orderBy('id', 'DESC')->get();
             $order_num_count = OrderCreate::select('order_id', \DB::raw('COUNT(id) as order_count'))->whereDate('created_at',Carbon::now()->format('Y-m-d'))
             ->groupBy('order_id')
             ->orderBy('id', 'DESC')->get();

             $net_out = Netprofit::whereDate('created_at',Carbon::now()->format('Y-m-d'))->sum('price');
             $paid_emp_out = Paidemp::whereDate('created_at',Carbon::now()->format('Y-m-d'))->sum('money');
              $noet_total = $noet_total + ($net_out + $paid_emp_out);
          }

          $orders_profits = 0;

          if($cutomers_data != null){
            $order_content_html = "<tr>";
            $order_content_html .= "<td colspan='3'>إسم العميل : ".$cutomers_data->name."</td>";
  
            $order_content_html .= "<td colspan='2'>التليفون  : ".$cutomers_data->phone."</td>";
  
            $order_content_html .= "<td colspan='4'>العنوان  : ".$cutomers_data->address."</td>";
  
            $order_content_html .= "</tr>";
           
          }else{
            $order_content_html = "<tr>";
            $order_content_html .= "</tr>";
          }

          $order_content_html .= "<tr>";
          $amount = 0;
          $orders_profits_for_order = 0;
          $price_buy_total_for_order = 0;
          $price_total = 0;
          $discount_total = 0;
          $count = 0;
          $i = 0;
          $price_buy = 0;
          $price_total_for_order = 0;
          $order_type_title = '';
          

            foreach($orders as $order){
              $count = $count + 1;
              $order_content_html .="<td>#".$order->order_id."</td>";
              $order_content_html .="<td>".$order->product_id."</td>";
              $order_content_html .="<td>".$order->product[0]->name."</td>";
              $order_content_html .="<td>".$order->options[0]->color."</td>";
              $order_content_html .="<td>".$order->amount."</td>";
              $order_content_html .="<td>".$order->options[0]->stock."</td>";
              $order_content_html .="<td>".$order->price."</td>";

              if($order->order[0]->order_type == 0){
                  $order_type_title = 'كاش';
              }else{
                  $order_type_title = 'أونلاين';
              }

              $order_content_html .="<td>".$order_type_title."</td>";
              $order_content_html .="<td>".$order->created_at."</td>";


              $order_content_html .= "</tr>";

              $price_total = $price_total + ($order->amount * $order->price);

              $price_buy = $price_buy + ($order->product[0]->price_buy * $order->amount);

              $price_buy_total_for_order = $price_buy_total_for_order + ($order->product[0]->price_buy * $order->amount);

              $price_total_for_order = $price_total_for_order + ($order->price * $order->amount);
              if($order_num_count[$i]->order_id == $order->order_id && $count == $order_num_count[$i]->order_count)
              {
                  $price_total = $price_total - $order->order[0]->discount;
                  $discount_total = $discount_total + $order->order[0]->discount;

                  $price_total_for_order = $price_total_for_order - $order->order[0]->discount;
                  $orders_profits_for_order = $price_total_for_order - $price_buy_total_for_order ;

                  $order_content_html .= "<tr class='price_total_content' style='background-color:#8B0000;border-radius:0px 30px 30px 0px;'>";

               $order_content_html .= "<td colspan='3'><h2 style='fonta-size:25px;font-weight:bold;color:black'> السعر بعد الخصم:</h2></td>";

               $order_content_html .= "<td colspan='2'><h2 style='fonta-size:25px;color:black'> ".$price_total_for_order."جنيه</h2> </td>";


               $order_content_html .= " <td colspan='2'><h4 style='fonta-size:18px;font-weight:bold;color:black'> قيمة الخصم:</h4></td>";

               $order_content_html .= "<td colspan='2'><h4 style='fonta-size:25px;color:black'>".$order->order[0]->discount."جنيه</h4></td>";



               $order_content_html .= "</tr>";
               $price_total_for_order = 0;
               $orders_profits_for_order = 0;
               $price_buy_total_for_order = 0;
               $count = 0;
               $i = $i + 1;
              }




            }

            

              $orders_profits = $price_total - $price_buy;
              $orders_profits = $orders_profits - $noet_total;


          return view('admin/profile/index',compact('orders','price_total','order_content_html','orders_profits','discount_total','cutomers'));
      
     }

     public function getorderonly(Request $request){

        $cutomers = Customer::all();
        $orders = OrderCreate::with(['product','options','order'=>function($q){
            $q->with('customers');
        }])->where('order_id',$request->order_num)->orderBy('id', 'DESC')->get();

        $order_num_count = OrderCreate::select('order_id', \DB::raw('COUNT(id) as order_count'))->where('order_id',$request->order_num)
        ->groupBy('order_id')
        ->orderBy('id', 'DESC')->get();
        
    $amount = 0;
    $price_total = 0;
    $count = 0;
    $i = 0;
    $price_total_for_order = 0;
    $order_type_title = '';

    if($orders[0]->order[0]->customers[0]->name != null){
        $order_content_html = "<tr>";
        $order_content_html .= "<td colspan='3'>إسم العميل : ".$orders[0]->order[0]->customers[0]->name."</td>";

        $order_content_html .= "<td colspan='2'>التليفون  : ".$orders[0]->order[0]->customers[0]->phone."</td>";

        $order_content_html .= "<td colspan='4'>العنوان  : ".$orders[0]->order[0]->customers[0]->address."</td>";

        $order_content_html .= "</tr>";
       
      }else{
        $order_content_html = "<tr>";
        $order_content_html .= "</tr>";
      }

      $order_content_html .= "<tr>";



      foreach($orders as $order){
        $count = $count + 1;
        $order_content_html .="<td>#".$order->order_id."</td>";
        $order_content_html .="<td>".$order->product_id."</td>";
        $order_content_html .="<td>".$order->product[0]->name."</td>";
        $order_content_html .="<td>".$order->options[0]->color."</td>";
        $order_content_html .="<td>".$order->amount."</td>";
        $order_content_html .="<td>".$order->options[0]->stock."</td>";
        $order_content_html .="<td>".$order->price."</td>";

        if($order->order[0]->order_type == 0){
            $order_type_title = 'كاش';
        }else{
            $order_type_title = 'أونلاين';
        }

        $order_content_html .="<td>".$order_type_title."</td>";
        $order_content_html .="<td>".$order->created_at."</td>";

        $order_content_html .= "</tr>";

        $price_total = $price_total + ($order->amount * $order->price);

      }

      $price_total = $price_total - $order->order[0]->discount;

      $discount_value = $order->order[0]->discount;

      $status = 1;

        return view('admin/profile/index',compact('orders','price_total','order_content_html','status','discount_value','cutomers'));

    }

    public function generate_pdf_file(Request $request){

      global $order_num_count;

      if($request->cust_pdf == null){
        $cust_orders = array(1);
      }else{
        $cust_orders = Order::where('cust_id',$request->cust_pdf)->pluck('id');
        $cutomers_data = Customer::find($request->cust_pdf);
      }

      $orders = OrderCreate::with(['product','options','order'])->when($request->start_date,function($q) use ($request){
          $q->whereDate('created_at','>=',$request->start_date);
      })->when($request->to_date,function($q) use ($request){
          $q->whereDate('created_at','<=',$request->to_date);
      })->whereIn('order_id',$cust_orders)->orderBy('id', 'DESC')->get();

      $order_num_count = OrderCreate::select('order_id', \DB::raw('COUNT(id) as order_count'))->when($request->start_date,function($q) use ($request){
       $q->whereDate('created_at','>=',$request->start_date);
   })->when($request->to_date,function($q) use ($request){
       $q->whereDate('created_at','<=',$request->to_date);
   })->groupBy('order_id')
   ->whereIn('order_id',$cust_orders)->orderBy('id', 'DESC')->get();



   $orders_profits = 0;
   $order_content_html = " ";
   $amount = 0;
   $price_total = 0;
   $orders_profits_for_order = 0;
   $price_buy_total_for_order = 0;
   $count = 0;
   $i = 0;
   $price_buy = 0;
   $price_total_for_order = 0;
     foreach($orders as $order){
       $count = $count + 1;
       $order_content_html .= "<tr>";
       $order_content_html .="<td style='border:1px solid #000'>#".$order->order_id."</td>";
       $order_content_html .="<td style='border:1px solid #000'>".$order->product_id."</td>";
       $order_content_html .="<td style='border:1px solid #000'>".$order->product[0]->name."</td>";
       $order_content_html .="<td style='border:1px solid #000'>".$order->options[0]->color."</td>";
       $order_content_html .="<td style='border:1px solid #000'>".$order->amount."</td>";
       $order_content_html .="<td style='border:1px solid #000'>".$order->options[0]->stock."</td>";
       $order_content_html .="<td style='border:1px solid #000'>".$order->price."</td>";
       $order_content_html .="<td style='border:1px solid #000'>".$order->price * $order->amount."</td>";
       $order_content_html .="<td style='border:1px solid #000'>".$order->created_at."</td>";

       $order_content_html .= "</tr>";

       $price_total = $price_total + ($order->amount * $order->price);

       $price_buy = $price_buy + ($order->product[0]->price_buy * $order->amount);

       $price_buy_total_for_order = $price_buy_total_for_order + ($order->product[0]->price_buy * $order->amount);

       $price_total_for_order = $price_total_for_order + ($order->price * $order->amount);
       if($order_num_count[$i]->order_id == $order->order_id && $count == $order_num_count[$i]->order_count)
       {
           $price_total = $price_total - $order->order[0]->discount;
           $price_total_for_order = $price_total_for_order - $order->order[0]->discount;
           $orders_profits_for_order = $price_total_for_order - $price_buy_total_for_order ;
           $order_content_html .= "<tr class='price_total_content' style='background-color:#8B0000;border-radius:0px 30px 30px 0px;'>";

           $order_content_html .= "<td colspan='2'><h2 style='fonta-size:25px;font-weight:bold;color:black'> السعر بعد الخصم:</h2></td>";

           $order_content_html .= "<td colspan='2'><h2 style='fonta-size:25px;color:black'> ".$price_total_for_order."جنيه</h2> </td>";


           $order_content_html .= " <td colspan='3'><h4 style='fonta-size:18px;font-weight:bold;color:black'> قيمة الخصم:</h4></td>";

           $order_content_html .= "<td colspan='2'><h4 style='fonta-size:25px;color:black'>".$order->order[0]->discount."جنيه</h4></td>";



           $order_content_html .= "</tr>";
           $price_total_for_order = 0;
           $orders_profits_for_order = 0;
           $price_buy_total_for_order = 0;
           $count = 0;
           $i = $i + 1;
       }


     }

       $orders_profits = $price_total - $price_buy;

      $pdf = PDF::loadView('pdf.document', ['orders'=>$orders,'price_total'=>$price_total,'order_content_html'=>$order_content_html,'orders_profits'=>$orders_profits]);
      return $pdf->stream('document.pdf');
//        global $orders;
//        if($request->start_date_pdf && $request->to_date_pdf)
//        {
//            $orders = OrderCreate::with(['product','options'])->when($request->start_date_pdf,function($q) use ($request){
//                $q->whereDate('created_at','>=',$request->start_date_pdf);
//            })->when($request->to_date_pdf,function($q) use ($request){
//                $q->whereDate('created_at','<=',$request->to_date_pdf);
//            })->latest()->get();
//        }else{
//            $orders = OrderCreate::with(['product','options'])->whereDate('created_at',Carbon::now()->format('Y-m-d'))->latest()->get();
//        }
//
//        $pdf = PDF::chunkLoadView('<html-separator/>','admin/order/index', ['orders' => $orders]);
//        return $pdf->Output($request->start_date_pdf.'To'.$request->to_date_pdf.'.pdf',Destination::DOWNLOAD);
  }

}
