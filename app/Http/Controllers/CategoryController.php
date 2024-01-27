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
        return view('category.create')->with('user', Auth::user());
    }

    public function store(Request $request)
    {
        $filename = '';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->extension();
            $filename = $request->name . '.' . $extention;
            $request->image->move(public_path('/assets/img/category/'), $filename);
        }

        $categoryData = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $filename,
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
        return view('category.show', compact('category'))->with('user', Auth::user());
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'))->with('user', Auth::user());
    }

    public function update(Request $request, Category $category)
    {
        $filename = $category->image;

        if ($request->hasFile('image')) {
            if ($category->image) {
                $exfile = $category->image;
                $filePath = public_path('/assets/img/category/') . $exfile;

                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
                Storage::delete($category->image);
            }

            $file = $request->file('image');
            $extention = $file->extension();
            $filename = $category->name . '.' . $extention;
            $request->image->move(public_path('/assets/img/category/'), $filename);
        }

        $categoryData = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $filename,
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
        if ($category->delete()) {
            if ($category->image) {
                $filePath = public_path('/assets/img/category/') . $category->image;

                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
                Storage::delete($category->image);
            }

            return back()->with('success', $category->id . ' has been deleted!');
        } else {
            return back()->with('error', 'Delete Failed!');
        }
    }

    public function catapi()
    {
        $cat = Category::all();
        return response()->json($cat);
    }
}
