<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:50',
        ]);

        $category = Category::create([
            'category_name' => $request->category_name,
        ]);

        return response()->json($category, 201);
    }

    public function show($id)
    {
        return Category::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'string|max:50',
        ]);

        $category = Category::findOrFail($id);

        if ($request->has('category_name')) {
            $category->category_name = $request->category_name;
        }

        $category->save();

        return response()->json($category, 200);
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
