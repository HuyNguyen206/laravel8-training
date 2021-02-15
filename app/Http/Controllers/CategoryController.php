<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['verified', 'auth']);
    }

    public function index()
    {
        $categories = Category::latest()->with('user')->paginate(5);
        $currentPage = $categories->currentPage();
        $trashCategories = Category::onlyTrashed()->latest()->paginate(5);
        return view('admin.category.index', compact('categories', 'currentPage', 'trashCategories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => 'required'
        ]);
        $category = Category::make($data);
        $category->user_id = Auth::id();
        $category->save();
        return redirect()->back()->with('success', 'Category was added successfully!');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'category' => 'required'
        ]);
        $category->category = $request->category;
        $category->save();
        return redirect()->back()->with('success', 'Category was updated successfully!');
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->back()->with('success', 'Category was restore successfully!');
    }

    public function forceDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->forceDelete();
        return redirect()->back()->with('success', 'Category was delete permantely successfully!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Category was delete successfully!');
    }
}
