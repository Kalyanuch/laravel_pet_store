<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategory;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Implements categories management functionality.
 */
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     *   Return view.
     */
    public function index()
    {
        $child = [];

        $categories = Category::rootCategories()->paginate(25);

        foreach ($categories as $item) {
            $child[$item->id] = Category::where('parent_id', '=', $item->id)->get();
        }

        return view('admin.category.index', compact('child', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     *   Return view.
     */
    public function create()
    {
        $parent = Category::rootCategories()->get();

        return view('admin.category.create', compact('parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *   Request service.
     *
     * @return RedirectResponse
     *   Redirect response.
     */
    public function store(StoreCategory $request)
    {
        Category::create($request->all());

//        $request->session()->flash('success', TRUE);

        return redirect()->route('admin.categories.index')->with('success', TRUE);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        $parent = Category::rootCategories()->get();

        return view('admin.category.edit', compact('parent', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategory $request, string $id)
    {
        $category = Category::findOrFail($id);

        if ($category) {
            $category->title = $request->get('title');
            $category->status = $request->get('status');
            $category->parent_id = $request->get('parent_id');
            $category->sort_order = $request->get('sort_order');
            $category->save();
        }

        return redirect()->route('admin.categories.index')->with('success', TRUE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     *   Item ID.
     *
     * @return RedirectResponse
     *   Redirect response.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        $child = Category::where('parent_id', '=', $id)->get();

        if ($child) {
            return redirect()->route('admin.categories.index')->with('error_delete', TRUE);
        }

        Category::destroy($id);

        return redirect()->route('admin.categories.index')->with('success', TRUE);
    }
}
