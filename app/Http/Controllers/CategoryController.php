<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use Validator;
use Illuminate\Support\Str;
class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index', 'show']]);
    }
    public function index()
    {
        return CategoryResource::collection(Category::latest()->get());
    }

    public function store(Request $request)
    {
        $v1 = Validator::make($request->all(), [
            'name' => 'required|unique:categories',
        ]);
        if ($v1->fails()) {
            return response()->json([
                "error" => true,
                "errors" => $v1->errors()
            ], 422);
        }
        $category = Category::create([
            'name' => $request->name,
           'slug' => Str::slug($request->name, '-'),
        ]);
        
        return response()->json(new CategoryResource($category), 201);
       // 
    }


    public function show(Category $category)
    {
        return new CategoryResource($category);
    }
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return response()->json(new CategoryResource($category), 200);
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(["message" => "the category with id: $category->id deleted"], 200);
    }
}
