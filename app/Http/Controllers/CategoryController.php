<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $categories = Category::where('name', 'LIKE', '%'. $request->search. '%')
            ->orderBy('id', 'desc')
            ->paginate(); 
        } else {
        $categories = Category::orderBy('id', 'desc')
        ->paginate();
        }

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
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string', 'unique:categories,name','max:255'],
        ]);

        Category::create($request->all());

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
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required','string','max:255', 'unique:categories,name,' . $category->id],
        ]);

        $category->update([
            'name' => $request->name
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
