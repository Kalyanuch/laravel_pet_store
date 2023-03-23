<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Implements products management functionality.
 */
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $products = Product::paginate(25);

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     *   Request service.
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:250'],
            'description' => ['required', 'max:3000'],
            'status' => ['in:0,1', 'required'],
            'sort_order' => ['regex:/^[0-9]*$/', 'nullable'],
        ]);

        $data = $request->all();

        if (empty($data['sort_order'])) {
            $data['sort_order'] = 0;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', TRUE);
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
     *
     * @param string $id
     *   Entity ID.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        return view('admin.product.edit', compact( 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *   Request service.
     * @param string $id
     *   Entity ID.
     *
     * @return RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required', 'max:250'],
            'description' => ['required', 'max:3000'],
            'status' => ['in:0,1', 'required'],
            'sort_order' => ['regex:/^[0-9]*$/', 'nullable'],
        ]);

        $product = Product::findOrFail($id);

        $data = $request->all();

        $data['sort_order'] = $data['sort_order'] ?? 0;

        $product->fill($data);

        $product->save();

        return redirect()->route('admin.products.index')->with('success', TRUE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     *   Entity ID.
     *
     * @return RedirectResponse
     */
    public function destroy(string $id)
    {
        Product::findOrFail($id);

        Product::destroy($id);

        return redirect()->route('admin.products.index')->with('success', TRUE);
    }
}
