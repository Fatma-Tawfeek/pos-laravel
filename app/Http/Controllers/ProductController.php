<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Warehouse;
use App\Traits\UploadFile;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{

    use UploadFile;

    public function __construct()
    {
        $this->middleware('permission:products.view')->only('index');
        $this->middleware('permission:products.create')->only('create');
        $this->middleware('permission:products.edit')->only('edit');
        $this->middleware('permission:products.delete')->only('destroy');
    }
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
        })->when($request->warehouse_id, function ($q) use ($request) {
            return $q->where('warehouse_id', $request->warehouse_id);
        })
        ->with('category')
        ->orderBy('id', 'desc')
        ->paginate();

        // confirm delete
        $title = trans('products.delete_msg_title');
        $text = trans('products.delete_msg_desc');
        Alert::confirmDelete($title, $text);

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        $warehouses = Warehouse::get();

        return view('products.create', compact('categories', 'warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
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
            'warehouse_id' => $request->warehouse_id,
            'category_id' => $request->category_id,
            'image' => $imageName ?? 'default.png',
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock
        ]);

        Alert::toast(trans('users.success_msg'), 'success');

        return redirect()->route('products.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        $warehouses = Warehouse::get();

        return view('products.edit', compact('product', 'categories', 'warehouses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {

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
            'warehouse_id' => $request->warehouse_id,
            'category_id' => $request->category_id,
            'image' => $imageName ?? $product->image,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock
        ]);

        Alert::toast(trans('users.success_msg'), 'success');

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

        Alert::toast(trans('users.success_msg'), 'success');

        return redirect()->route('products.index');
    }
}
