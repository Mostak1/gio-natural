<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
       

        $categoryData = [
            'name' => $request->name,
            'active' => $request->active,
        ];

        $cat = Category::create($categoryData);

        if ($cat) {
            return back()->with('success', 'Category created successfully!');
        } else {
            return back()->with('error', 'Category creation failed!');
        }
    }

    public function show(Category $category)
    {
        return view('category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        

        $categoryData = [
            'name' => $request->name,
            
            'active' => $request->active,
        ];

        $catup = $category->update($categoryData);

        if ($catup) {
            return back()->with('success', "Update Successfully!");
        } else {
            return back()->with('error', "Update Failed!");
        }
    }

    public function destroy(Category $category)
    {
        if(Category::destroy($category->id)){
            return back()->with('success', 'Category deleted successfully');
        }
    }


}
