<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use  App\Models\Product;
use  App\Models\ActivitySector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('sector')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $sectors = ActivitySector::orderBy('name')->get();
        return view('admin.products.create', compact('sectors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sector_id' => 'required|exists:activity_sectors,id',
            'name'      => 'required',
            'slug'      => 'required|unique:products,slug',
            'image_file' => 'nullable|image|max:6144',
        ]);

        $payload = $request->except('image_file');

        if ($request->hasFile('image_file')) {
            $payload['image_path'] = $request->file('image_file')->store('products', 'public');
            $payload['image_url'] = Storage::disk('public')->url($payload['image_path']);
        }

        Product::create($payload);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $sectors = ActivitySector::orderBy('name')->get();

        return view('admin.products.edit', compact('product','sectors'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'sector_id' => 'required|exists:activity_sectors,id',
            'name'      => 'required',
            'slug'      => 'required|unique:products,slug,'.$product->id,
            'image_file' => 'nullable|image|max:6144',
        ]);

        $payload = $request->except('image_file');

        if ($request->hasFile('image_file')) {
            $payload['image_path'] = $request->file('image_file')->store('products', 'public');
            $payload['image_url'] = Storage::disk('public')->url($payload['image_path']);
        }

        $product->update($payload);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        return $this->delete($product);
    }

    public function delete(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    public function allPost()
    {
        $products = \App\Product::all();
        return view('admin.products.allpost', compact('products'));
    }
}
