<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('id', 'DESC')->get();

        return view('product.index', compact('products'));
    }
    public function productJson()
    {
        $products = Product::with('category')
            ->orderBy('id', 'DESC')->get();
            return response()->json(['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:10',
            'stock' => 'required|integer|min:2',
            'weight' => 'required',
            'unit' => 'required',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $file = $request->file('thumbnail');
        $extention = $file->extension();
        $filename = Str::random(2) . '_' . time() . '.' . $extention;
        // Handle file upload
        $thumbnailPath = $file->storeAs('thumbnails', $filename, 'public');
        // Create product
        $product = Product::create(array_merge($validatedData, ['thumbnail' => $thumbnailPath]));

        // Redirect or do anything else after creating the product
        if ($product) {
            return redirect()->route('product.index')->with('success', 'Product added successfully.');
        } else {
            return redirect()->route('product.create')->with('error', 'Product added Failed, Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('users.single',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::pluck('name', 'id');
        return  view('product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, Product $product)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'weight' => 'required',
                'unit' => 'required',
                'category_id' => 'required|exists:categories,id',
                'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Update the product attributes
            $product->update([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'stock' => $validatedData['stock'],
                'weight' => $validatedData['weight'],
                'unit' => $validatedData['unit'],
                'category_id' => $validatedData['category_id'],
            ]);

            // Handle thumbnail update if a new thumbnail is provided
            if ($request->hasFile('thumbnail')) {
                // Store the new thumbnail and update the product's thumbnail attribute
                $file = $request->file('thumbnail');
                $extension = $file->extension();
                $filename = Str::random(2) . '_' . time() . '.' . $extension;

                // Handle file upload
                $thumbnailPath = $file->storeAs('thumbnails', $filename, 'public');
                $product->update(['thumbnail' => $thumbnailPath]);
            }

            return redirect()->back()->with('success', 'Product updated successfully');
        } catch (ValidationException $e) {
            // If validation fails, redirect back with errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if(Product::destroy($product->id)){
            return back()->with('success', 'Product deleted successfully');
        }
    }
}
