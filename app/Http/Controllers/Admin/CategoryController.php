<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
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
    public function store(StoreCategoryRequest $request)
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
    public function edit(Category $category)
    {
        $parent = Category::rootCategories()->get();

        return view('admin.category.edit', compact('parent', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, Category $category)
    {
        $category->fill($request->all())
            ->save();

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
    public function destroy(Category $category)
    {
        $child = Category::where('parent_id', '=', $category->id)->get();

        if (count($child)) {
            return redirect()->route('admin.categories.index')
                ->with('error_delete', TRUE);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', TRUE);
    }
}
