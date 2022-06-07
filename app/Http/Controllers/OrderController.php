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
use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;

use Mpdf\Output\Destination;
use PDF;
class OrderController extends Controller
{
    function CreateOrder(Request $request){
     $order_content = [];
     $products_index = 0;
     $total_price = 0;
     $items = array();
        foreach ($request->product_color_amount_price as $index=>$option_content){
            $content = explode(',',$option_content);
            $option_content_index = [];
            for($i = 0 ; $i < count($content) - 1; $i++){
                $option_content_index =  explode(':',$content[$i]);
                if(strpos($option_content_index[0], ',') !== false){
                    $option_content_index[0] = substr($option_content_index[0], 0, -1);
                }

                    $option_product_index = ProductOption::where('product_id',$request->product_ids[$products_index])->where('color',$option_content_index[0])->first();
                    $option_product_index->stock =  $option_product_index->stock - $option_content_index[1];
                    $option_product_index->save();

                    $total_price = $total_price + 1;
                    array_push($items,array("product"=>"ppp","option"=>$option_content_index[0],"qty"=> $option_content_index[1],"price"=>1));

            }
            $products_index++;
        }




        if($request->discount_value != null || $request->discount_value != ''){
            $discount_value_old = Order::where('id',$request->order_id)->first();
            $discount_value_old->discount = $request->discount_value;
            $discount_value_old->save();

            array_push($items,array("discount"=>$request->discount_value,'total_price'=>$total_price));

        }else{
            array_push($items,array("discount"=>"الخصم = 0",'total_price'=>$total_price));
        }
        $customer = null;

        
    $customer = Customer::where('phone',$request->phone)->first();

    if(!$customer)
    {
        if(isset($request->address) && $request->address != null && $request->address != ''){
            $customer = Customer::create([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'address'=>$request->address,
               ]);
        }else{
            $customer = Customer::create([
                'name'=>$request->name,
                'phone'=>$request->phone,
               ]);
        }
    }
        

        $order_value_old = Order::where('id',$request->order_id)->first();
        $order_value_old->order_type = $request->order_type;
        $order_value_old->cust_id = $customer->id;
        $order_value_old->save();

        $order_num =  OrderStatus::where('order_id',$request->order_id)->first();
        $order_num->status = 1;
        $order_num->save();

        $printer = 0;

        if($printer == 1){
            // Set params
            $mid = '123123456';
            $store_name = 'Ladies System';
            $store_address = '278البوابة الثانية القديمة - حدائق الأهرام ';
            $store_phone = '01003742949            01141887316';
            $store_email = 'yourmart@email.com';
            $store_website = 'jjjjjjjjjjjjjj';
            $tax_percentage = $item['discount'];
            $transaction_id = '1';
            $currency = 'جنيه';
            $image_path = public_path('/logo/logo.jpeg');

            // Set items
            
        $items = json_encode($items);
        $items = json_decode($items,true);
            

            // $items_print = [
            //     [
            //         'name' => 'French Fries (tera)',
            //         'qty' => 2,
            //         'price' => 65000,
            //     ],
            //     [
            //         'name' => 'Roasted Milk Tea (large)',
            //         'qty' => 1,
            //         'price' => 24000,
            //     ],
            //     [
            //         'name' => 'Honey Lime (large)',
            //         'qty' => 3,
            //         'price' => 10000,
            //     ],
            //     [
            //         'name' => 'Jasmine Tea (grande)',
            //         'qty' => 3,
            //         'price' => 8000,
            //     ],
            // ];

            // Init printer
            $printer = new ReceiptPrinter;
            $printer->init(
                config('receiptprinter.connector_type'),
                config('receiptprinter.connector_descriptor')
            );

            // Set store info
            $printer->setStore($mid, $store_name, $store_address, $store_phone, $store_email, $store_website);

            // Set currency
            $printer->setCurrency($currency);

            // Add items
            foreach ($items as $item) {
                $printer->addItem(
                    $item['produt'],
                    $item['option'],
                    $item['qty'],
                    $item['price']
                );
            }
             
            $printer->addItem(
                $item['discount'],
                $item['total_price'],
            );
            // Set tax
            $printer->setTax($tax_percentage);

            // Calculate total
            $printer->calculateSubTotal();
            $printer->calculateGrandTotal();

            // Set transaction ID
            $printer->setTransactionID($transaction_id);

            // Set logo
            // Uncomment the line below if $image_path is defined
            //$printer->setLogo($image_path);

            // // Set QR code
            // $printer->setQRcode([
            //     'tid' => $transaction_id,
            // ]);

            // Print receipt
            $printer->printReceipt();
        }

        return response()->json(1);
    }




    public function show_orders(Request $request){
        global $orders;
        global $order_num_count;
        $noet_total = 0;
         if($request->start_date && $request->to_date)
         {
             $orders = OrderCreate::with(['product','options','order'])->when($request->start_date,function($q) use ($request){
                 $q->whereDate('created_at','>=',$request->start_date);
             })->when($request->to_date,function($q) use ($request){
                 $q->whereDate('created_at','<=',$request->to_date);
             })->orderBy('id', 'DESC')->get();

             $order_num_count = OrderCreate::select('order_id', \DB::raw('COUNT(id) as order_count'))->when($request->start_date,function($q) use ($request){
              $q->whereDate('created_at','>=',$request->start_date);
          })->when($request->to_date,function($q) use ($request){
              $q->whereDate('created_at','<=',$request->to_date);
          })->groupBy('order_id')
          ->orderBy('id', 'DESC')->get();

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
          $order_content_html = "<tr>";
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
              $order_content_html .="<td>".$order->product[0]->price_buy."</td>";

              if($order->order[0]->order_type == 0){
                  $order_type_title = 'كاش';
              }else{
                  $order_type_title = 'أونلاين';
              }

              $order_content_html .="<td>".$order_type_title."</td>";
              $order_content_html .="<td>".$order->created_at."</td>";
              $order_content_html .="<td style='color:white'>". "<a class='return_product return_product".$order->id." btn btn-primary' data-transaction_id =".$order->id." >إسترجاع</a></td>";


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


          return view('admin/order/index',compact('orders','price_total','order_content_html','orders_profits','discount_total'));
      
        }

    

      public function getorderonly(Request $request){

          $orders = OrderCreate::with(['product','options','order'])->where('order_id',$request->order_num)->orderBy('id', 'DESC')->get();

          $order_num_count = OrderCreate::select('order_id', \DB::raw('COUNT(id) as order_count'))->where('order_id',$request->order_num)
          ->groupBy('order_id')
          ->orderBy('id', 'DESC')->get();
          $order_content_html = "<tr>";
      $amount = 0;
      $price_total = 0;
      $count = 0;
      $i = 0;
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
          $order_content_html .="<td>".$order->product[0]->price_buy."</td>";

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

          return view('admin/order/index',compact('orders','price_total','order_content_html','status','discount_value'));

      }

    public function generate_pdf_file(Request $request){
        global $order_num_count;
        $orders = OrderCreate::with(['product','options','order'])->when($request->start_date,function($q) use ($request){
            $q->whereDate('created_at','>=',$request->start_date);
        })->when($request->to_date,function($q) use ($request){
            $q->whereDate('created_at','<=',$request->to_date);
        })->orderBy('id', 'DESC')->get();

        $order_num_count = OrderCreate::select('order_id', \DB::raw('COUNT(id) as order_count'))->when($request->start_date,function($q) use ($request){
         $q->whereDate('created_at','>=',$request->start_date);
     })->when($request->to_date,function($q) use ($request){
         $q->whereDate('created_at','<=',$request->to_date);
     })->groupBy('order_id')
     ->orderBy('id', 'DESC')->get();



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
         $order_content_html .="<td style='border:1px solid #000'>".$order->product[0]->price_buy."</td>";
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

    public function return_order($id){
     $order = OrderCreate::find($id);
     $option =  ProductOption::find($order->option_id);
     $option->stock = $option->stock + $order->amount;
     $option->save();

     $order->delete();

     return response()->json(1);
    }
}
