<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderCreate;
use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

          Category::create([
            'name'=>'شنطة ظهر',
            'image' => '1643159227.jpg'
        ]);

        Category::create([
            'name'=>'شنطة حريمى',
            'image' => '1643159227.jpg'
        ]);

        Category::create([
            'name'=>'شنطة رجالى',
            'image' => '1643159227.jpg'
        ]);

        Category::create([
            'name'=>'شنطة هاند باك',
            'image' => '1643159227.jpg'
        ]);


        Category::create([
            'name'=>'شنطة اى حاجة',
            'image' => '1643159227.jpg'
        ]);


        Category::create([
            'name'=>'شنطة اى حاجة برده',
            'image' => '1643159227.jpg'
        ]);

        $index = [1,2,3,4,5,6];
        $product_name = ['سوستة','سلسة','هندى','فيونكة','جمل','حصان'];
        $j=0;
        $i = 0;
        $x = 0;
        $price = 150;
        for($i=0 ;$i<100;$i++)
        {
            $product = Product::create([
                'name'=>$product_name[$x],
                'price' => $price,
                'price_buy' => $price,
                'category_id'=>$index[$j],
                'image' => '1643236178.jpg',
                'product_type' => 0
            ]);

            ProductOption::create([
                'color' => 'أسود',
                'stock' => 5,
                'product_id' => $product->id,
               
            ]);
            ProductOption::create([
                'color' => 'أحمر',
                'stock' => 5,
                'product_id' => $product->id
            ]);
            $price = $price + 5 ;
            $j++;
            $x++;

            if($j >= 6)
            {
                $j = 0;
            }
            if($x >= 6)
            {
             $x = 0;
            }
        }
        $dt = Carbon::now();

        $month = 3;
        $days = 1;

        for($j=0;$j<20;$j++){
            for($x=1;$x<=20;$x++){
            //    $order = Order::create();
            // OrderCreate::create([
            //     'option_id' =>$x
            //     ,'product_id'=>$x
            //     ,'price'=>200
            //     ,'amount'=>2
            //     ,'order_id' =>$order->id
            //     ,'created_at' =>$dt->setDate(2022, $month, $days)->toDateTimeString()
            // ]);
            // $temp = $x;
            // OrderCreate::create([
            //     'option_id' =>$temp + 1
            //     ,'product_id'=>$x
            //     ,'price'=>200
            //     ,'amount'=>2
            //     ,'order_id' =>$order->id
            //     ,'created_at' =>$dt->setDate(2022, $month, $days)->toDateTimeString()
            // ]);
           
            $days++;
            if($days == 31){
                $days = 1;
            }
            
            
            }
            $month++;
            if($month == 6){
                $month = 3;
            }
            
            
            

        }

    }
}
