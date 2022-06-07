<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\ProductOption;
use Illuminate\Http\Request;
use Image;

class CategoryController extends Controller
{
    public function index()
    {
       $categories = Category::with('products')->orderBy('id', 'DESC')->get();

    
       $price_total = [];
       $price_total_once = 0; 
   foreach($categories as $index=>$category){
    foreach($category->products as $product){
        $option_amount_sum = ProductOption::where('product_id',$product->id)->sum('stock');
        $price_total_once = $price_total_once + ($product->price * $option_amount_sum);
        } 
        $price_total[$index] = $price_total_once;
        $price_total_once = 0;
   }       
    

        return view('admin/category/index',compact('categories','price_total'));
    }

    public function create()
    {
        return view('admin/category/create');
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:7000',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $image = $request->file('image');

        
        $destinationPath = public_path('/uploads');
        $img = Image::make($image->getRealPath());
        $img->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
   
        $img->resizeCanvas(300, 300, 'center', false, array(255, 255, 255, 0));
        $img->save($destinationPath.'/'.$imageName);
        //$request->image->move(public_path('/uploads'), $imageName);

        $category = new Category;
        $category->name = $request->name;
        $category->image = $imageName;
        $category->save();

        return back()->with('success', 'تم إضافة الفئة');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return back()->with('delete', 'تم مسح الفئة ومنتاجتها');
    }

    public function update(Request $request,$id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg|max:7000',
        ]);

        $category = Category::find($id);

        if($request->image != null){
            $imageName = time().'.'.$request->image->extension();
            $image = $request->file('image');

        
        $destinationPath = public_path('/uploads');
        $img = Image::make($image->getRealPath());
        $img->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
   
        $img->resizeCanvas(300, 300, 'center', false, array(255, 255, 255, 0));
        $img->save($destinationPath.'/'.$imageName);
         $request->image->move(public_path('/uploads'), $imageName);

            $category->name = $request->name;
            unlink("uploads/".$category->image);
            $category->image = $imageName;
            $category->save();
            return back()->with('edit', 'تم تعديل الفئة');
        }

        $category->name = $request->name;

        $category->save();
        return back()->with('edit', 'تم تعديل الفئة');
    }

}
