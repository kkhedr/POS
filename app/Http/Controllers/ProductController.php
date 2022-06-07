<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\Supllier;
use App\Models\money_sup;
use App\Models\PaidSupllier;

use App\Models\Purchase;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class ProductController extends Controller
{
    public function index(Request $request)
    {
       $products = Product::with(['category','options','supplier'])->when($request->search,function($q) use ($request){
       if(is_numeric($request->search))
       {
        $q->where('price',$request->search);
       }else{
        $q->where('name','LIKE','%'.$request->search.'%');
       }

    })->when($request->category_search,function($q) use ($request){
        $q->where('category_id',$request->category_search);
     })->when($request->start_date,function($q) use ($request){
        $q->whereDate('updated_at','>=',$request->start_date);
    })->when($request->to_date,function($q) use ($request){
        $q->whereDate('updated_at','<=',$request->to_date);
    })->orderBy('id', 'DESC')->paginate(50)->appends(request()->query());

       $catgeories = Category::all();

        return view('admin/product/index',compact('products','catgeories'));

    }

    public function create()
    {
       $catgeories = Category::all();
       $sups = Supllier::all();
        return view('admin/product/create',compact('catgeories','sups'));
    }

    public function store(Request $request)
    {

        if($request->color == null){
            return back()->with('edit_wrong',"إلغاء عملية إنشاء المنتج لإنه يجب ان يحصل على ألوان");
        }


        $imageName = time().'.'.$request->image->extension();

        $image = $request->file('image');


        $destinationPath = public_path('/uploads/products');
        $img = Image::make($image->getRealPath());
        $img->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $img->resizeCanvas(300, 300, 'center', false, array(255, 255, 255, 0));
        $img->save($destinationPath.'/'.$imageName);

        $request->image->move(public_path('uploads/products'), $imageName);

$price_buy_sup = 0;

        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->price_buy = $request->price_buy;
        $product->category_id = $request->category_id;
        $product->image = $imageName;
        if($request->sup_id !=null){
            $product->sup_id = $request->sup_id;
        }
        if(isset($request->size[0])){
            $product->product_type = 1;
        }else{
            $product->product_type = 0;
        }
        $product->save();

        


        $i = 0;
        if(isset($request->size[0])){
            foreach ($request->color as $color)
            {
                $price_buy_sup = $price_buy_sup + ($request->price_buy * $request->stock[$i]);
      
               $option =  ProductOption::create([
                    'color' => $request->color[$i],
                    'stock' => $request->stock[$i],
                    'size' =>  $request->size[$i],
                    'product_id' => $product->id
                ]);

                Purchase::create([
                    'color' => $request->color[$i],
                    'stock' => $request->stock[$i],
                    'size' =>  $request->size[$i],
                    'product_id' => $product->id,
                    'sup_id' => $request->sup_id
                ]);
      
                $i++;
            }
        }else{
            foreach ($request->color as $color)
      {
        $price_buy_sup = $price_buy_sup + ($request->price_buy * $request->stock[$i]);


         $option =  ProductOption::create([
              'color' => $request->color[$i],
              'stock' => $request->stock[$i],
              'product_id' => $product->id
          ]);

          Purchase::create([
            'color' => $request->color[$i],
            'stock' => $request->stock[$i],
            'product_id' => $product->id,
            'sup_id' => $request->sup_id
        ]);

          $i++;
      }
        }

        $emp_sup = new PaidSupllier();
        $emp_sup->sup_id = $request->sup_id;
        $emp_sup->price = $price_buy_sup;
        $emp_sup->product_id = $product->id;
        $emp_sup->save();
        
        $emp = new money_sup();
        $emp->sup_id = $request->sup_id;
        $emp->money = $request->price_sup_paid;
        $emp->save();
        
        return response()->json(1);
    }


    public function update(Request $request,$id)
    {
       
        if($request->color_old == null && $request->color == null){
          return back()->with('edit_wrong',"إلغاء عملية التعديل المنتج يجب ان يحصل على ألوان");
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'price_buy' => 'required|numeric',
            'stock.*' => 'required|numeric|min:1',
            'color.*' => 'required|min:1',
            'image' => 'image|mimes:jpeg,png,jpg|max:7000',
            'category_id' => 'required'
        ]);

$options_id_old = array();

if($request->stock_option_ids != null){
    foreach($request->stock_option_ids as $index => $stock_option_id){
            
        array_push($options_id_old,(int)$stock_option_id);
    } 
}

       

        

        $product = Product::find($id);
        if($request->image != null){
            $imageName = time().'.'.$request->image->extension();

            $image = $request->file('image');


            $destinationPath = public_path('/uploads/products');
            $img = Image::make($image->getRealPath());
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->resizeCanvas(300, 300, 'center', false, array(255, 255, 255, 0));
            $img->save($destinationPath.'/'.$imageName);

            $request->image->move(public_path('uploads/products'), $imageName);
            $product->name = $request->name;
            $product->price = $request->price;
            $product->price_buy = $request->price_buy;
            $product->category_id = $request->category_id;
            unlink("uploads/products/".$product->image);
            $product->image = $imageName;
            $product->updated_at = \Carbon\Carbon::now()->toDateTimeString();
            $product->save();

            

            $options =  ProductOption::where('product_id',$product->id)->whereNotIn('id',$options_id_old)->delete();

            if($request->stock_option_ids != null){
                foreach ($request->stock_option_ids as $index => $option_id){
                    
                    $option =  ProductOption::where('id',$option_id)->first();
                    $option->stock = $request->stock_old[$index] ;
                    $option->color = $request->color_old[$index] ;
                    if(isset($request->size_old[0])){
                        $option->size = $request->size_old[$index];
                    }
                    $option->save();
                }

            }else{
                
                ProductOption::where('product_id',$product->id)->delete();
            }

            

            if($request->stock_add_option_ids != null){
                foreach ($request->stock_add_option_ids as $index => $option_id){
                    $option =  ProductOption::where('id',$option_id)->first();
                    $option->stock = $request->stock_add[$index] + $option->stock;
                    $option->save();
                }

            }

            if($request->color != null){
                if(isset($request->size[0])){
                    foreach ($request->color as $index => $option_id){
                        ProductOption::create([
                            'color' => $request->color[$index],
                            'stock' => $request->stock[$index],
                            'size' =>  $request->size[$index],
                            'product_id' => $product->id
                        ]);
                    }
                }else{
                    foreach ($request->color as $index => $option_id){
                        ProductOption::create([
                            'color' => $request->color[$index],
                            'stock' => $request->stock[$index],
                            'product_id' => $product->id
                        ]);
                    }
                }
               

            }

            return back()->with('edit', 'تم تعديل المنتج');
        }else{
            $product->name = $request->name;
            $product->price = $request->price;
            $product->price_buy = $request->price_buy;
            $product->category_id = $request->category_id;
            $product->updated_at = \Carbon\Carbon::now()->toDateTimeString();
            $product->save();

            
            $options =  ProductOption::where('product_id',$product->id)->whereNotIn('id',$options_id_old)->delete();
          
        //     return $options; 

        //     foreach($options as $option){
        //     $option =  ProductOption::where('id',$option->id)->delete();
        //    }


            if($request->stock_option_ids != null){
                foreach ($request->stock_option_ids as $index => $option_id){
                    $option =  ProductOption::where('id',$option_id)->first();
                    $option->stock = $request->stock_old[$index];
                    $option->color = $request->color_old[$index] ;
                    if(isset($request->size_old[0])){
                        $option->size = $request->size_old[$index];
                    }
                    $option->save();
                }

            }else{
                ProductOption::where('product_id',$product->id)->delete();
            }

            if($request->stock_add_option_ids != null){
                foreach ($request->stock_add_option_ids as $index => $option_id){
                    $option =  ProductOption::where('id',$option_id)->first();
                    $option->stock = $request->stock_add[$index] + $option->stock;
                    $option->save();
                }

            }

           
            if($request->color != null){
                if(isset($request->size[0])){
                    foreach ($request->color as $index => $option_id){
                        ProductOption::create([
                            'color' => $request->color[$index],
                            'stock' => $request->stock[$index],
                            'size' =>  $request->size[$index],
                            'product_id' => $product->id
                        ]);
                    }
                }else{
                    foreach ($request->color as $index => $option_id){
                        ProductOption::create([
                            'color' => $request->color[$index],
                            'stock' => $request->stock[$index],
                            'product_id' => $product->id
                        ]);
                    }
                }
               

            }

            return back()->with('edit', 'تم تعديل المنتج');
        }


    }


    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return back()->with('delete', 'تم مسح المنتج ');
    }
}
