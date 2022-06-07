<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
      $categories =  Category::all();

        $data['category'] = CategoryResource::collection($categories)->response()->getData(true);

        return response()->api($data);

    }

    public function create()
    {
        return view('admin/category/create');
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('uploads'), $imageName);

        $category = new Category;
        $category->name = $request->name;
        $category->image = $imageName;
        $category->save();

        return back()->with('success', 'User created successfully.');
    }

}
