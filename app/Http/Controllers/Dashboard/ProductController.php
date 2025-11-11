<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(15);
        return view('dashboard.pages.products.index', compact('products'));
    }

    public function create()
    {
        return view('dashboard.pages.products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $product = new Product();
        $product->setTranslations('name', $data['name']);
        $product->setTranslations('description', $data['description'] ?? []);
        $product->slug = !empty($data['slug']) ? $data['slug'] : Product::generateUniqueSlug($data['name']['en']);
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'uploads');
        }
        $product->save();
        return redirect()->route('dashboard.products.index')->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        return view('dashboard.pages.products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $product->setTranslations('name', $data['name']);
        $product->setTranslations('description', $data['description'] ?? []);
        if (empty($data['slug']) || ($data['name']['en'] ?? '') !== ($product->getTranslation('name', 'en') ?? '')) {
            $product->slug = Product::generateUniqueSlug($data['name']['en']);
        } else {
            $product->slug = $data['slug'];
        }
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('uploads')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'uploads');
        }
        $product->save();
        return redirect()->route('dashboard.products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('uploads')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('dashboard.products.index')->with('success', 'Product deleted successfully');
    }
}
