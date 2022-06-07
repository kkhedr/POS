<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OrderCreate;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

   
    public function main_page(){
       
        $orders = OrderCreate::with(['product','options'])->whereDate('created_at',Carbon::now()->format('Y-m-d'))->orderBy('id', 'DESC')->get();
        $categories_count = Category::get()->count();
        $products_count = Product::get()->count();
        $orders_profits = 0;
       
           $orders = OrderCreate::with(['product','options','order'])->whereDate('created_at',Carbon::now()->format('Y-m-d'))->orderBy('id', 'DESC')->get();
           $order_num_count = OrderCreate::select('order_id', \DB::raw('COUNT(id) as order_count'))->whereDate('created_at',Carbon::now()->format('Y-m-d'))
           ->groupBy('order_id')
           ->orderBy('id', 'DESC')->get();
               
        $order_content_html = "";
    $amount = 0;
    $price_total = 0;
    $count = 0;
    $i = 0;
    $price_buy = 0;
    $discount_total= 0;
    $price_total_for_order = 0;
    $order_type_title = 0;
      foreach($orders as $order){
        $order_content_html .= "<tr>";
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
        
        $price_total_for_order = $price_total_for_order + ($order->price * $order->amount);
        if($order_num_count[$i]->order_id == $order->order_id && $count == $order_num_count[$i]->order_count)
        {
            $price_total = $price_total - $order->order[0]->discount;
            $discount_total = $discount_total + $order->order[0]->discount;
            $order_content_html .= "<tr class='price_total_content' style='background-color:#8B0000;border-radius:0px 30px 30px 0px;'>";

            $order_content_html .= "<td colspan='3'><h2 style='fonta-size:25px;font-weight:bold;color:black'> السعر بعد الخصم:</h2></td>";

            $order_content_html .= "<td colspan='3'><h2 style='fonta-size:25px;color:black'> ".$price_total_for_order - $order->order[0]->discount."جنيه</h2> </td>"; 
            

            $order_content_html .= " <td colspan='1'><h4 style='fonta-size:18px;font-weight:bold;color:black'> قيمة الخصم:</h4></td>";

            $order_content_html .= "<td colspan='2'><h4 style='fonta-size:25px;color:black'>".$order->order[0]->discount."جنيه</h4></td>"; 
            

            $order_content_html .= "</tr>";
            $price_total_for_order = 0;
            $count = 0;
            $i = $i + 1;
        }
        
        

        
      }
        
        $categories_count = Category::get()->count();
        $products_count = Product::get()->count();
        $orders_profits = $price_total - $price_buy;
        
        return view('admin/index',compact('orders','price_total','order_content_html','categories_count','products_count','orders_profits','discount_total'));

    }
}
