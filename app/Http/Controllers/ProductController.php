<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Traits\UploadFile;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{

    use UploadFile;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::get();

        $products = Product::when($request->search, function ($q) use ($request) {
            return $q->where('name', 'LIKE', '%' . $request->search . '%');
        })->when($request->category_id, function ($q) use ($request) {
            return $q->where('category_id', $request->category_id);
        })
        ->orderBy('id', 'desc')
        ->paginate();

        // confirm delete
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        Alert::confirmDelete($title, $text);

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => ['required', 'string', 'max:255', 'unique_translation:products,name'],
            'name_en' => ['required', 'string', 'max:255', 'unique_translation:products,name'],
            'desc_ar' => ['required', 'string'],
            'desc_en' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'purchase_price' => ['required'],
            'sale_price' => ['required'],
            'stock' => ['required']
        ]);

        if($request->hasFile('image')) {
            $imageName = $this->uploadImage($request->image, Product::IMAGE_PATH);
        }

        Product::create([
            'name' => [
                'ar' => $request->name_ar,
                'en' => $request->name_en
            ],
            'description' => [
                'ar' => $request->desc_ar,
                'en' => $request->desc_en
            ],
            'category_id' => $request->category_id,
            'image' => $imageName ?? 'default.png',
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock
        ]);

        Alert::toast('Toast Message', 'success');

        return redirect()->route('products.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::get();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name_ar' => ['required', 'string', 'max:255', 'unique_translation:products,name,' . $product->id],
            'name_en' => ['required', 'string', 'max:255', 'unique_translation:products,name,' . $product->id],
            'desc_ar' => ['required', 'string'],
            'desc_en' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'purchase_price' => ['required'],
            'sale_price' => ['required'],
            'stock' => ['required']
        ]);

        if($request->hasFile('image')) {
            $imageName = $this->uploadImage($request->image, Product::IMAGE_PATH, $product->image);
        }

        $product->update([
            'name' => [
                'ar' => $request->name_ar,
                'en' => $request->name_en
            ],
            'description' => [
                'ar' => $request->desc_ar,
                'en' => $request->desc_en
            ],
            'category_id' => $request->category_id,
            'image' => $imageName ?? $product->image,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock
        ]);

        Alert::toast('Toast Message', 'success');

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete old image
        if($product->image != 'default.png') {
            $this->deleteImage($product->image, Product::IMAGE_PATH);
        }

        $product->delete();

        Alert::toast('Toast Message', 'success');

        return redirect()->route('products.index');
    }
}
