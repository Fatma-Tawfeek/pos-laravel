<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:categories.view')->only('index');
        $this->middleware('permission:categories.create')->only('create');
        $this->middleware('permission:categories.edit')->only('edit');
        $this->middleware('permission:categories.delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::when($request->search, function ($q) use ($request) {
            return $q->where('name', 'LIKE', '%'. $request->search. '%');
        })
        ->orderBy('id', 'desc')
        ->paginate();

        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        Alert::confirmDelete($title, $text);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create([
            'name' => [
               'ar' => $request->name_ar,
               'en' => $request->name_en
            ]
         ]);

        Alert::toast('Toast Message', 'success');

        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => [
                'ar' => $request->name_ar,
                'en' => $request->name_en
             ]
        ]);

        Alert::toast('Toast Message', 'info');

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        Alert::toast('Toast Message', 'success');

        return redirect()->route('categories.index');

    }
}
