<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $categories = $this->getCategoriesList();

        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     *   Request service.
     *
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());

        $this->handleProductImage($product, $request);

        $this->storeProductCategories($product, $request->get('category_id'));

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
    public function edit(Product $product)
    {
        $categories = $this->getCategoriesList();

        $category_id = NULL;

        foreach ($product->categories as $category) {
            $category_id = $category->id;

            if ($category->parent_id > 0) {
                break;
            }
        }

        return view('admin.product.edit', compact( 'product', 'categories', 'category_id'));
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
    public function update(StoreProductRequest $request, Product $product)
    {
        $product->fill($request->all())
            ->save();

        $this->handleProductImage($product, $request);

        $this->storeProductCategories($product, $request->get('category_id'));

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
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', TRUE);
    }

    /**
     * Builds list of categories.
     *
     * @return array
     */
    protected function getCategoriesList()
    {
        $result = [];

        foreach (Category::rootCategories()->get() as $category) {
            $result[$category->id] = $category;

            foreach (Category::where('parent_id', '=', $category->id)->get() as $child) {
                $result[$child->id] = $child;
            }
        }

        return $result;
    }

    /**
     * Stores categories for product.
     *
     * @param Product $product
     *   Product entity.
     * @param $category_id
     *   Category ID.
     */
    protected function storeProductCategories(Product $product, $category_id) {
        $product_categories = [$category_id];

        $category = Category::find($category_id);

        if ($category->parent_id > 0) {
            $product_categories[] = $category->parent_id;
        }

        $product->categories()->sync($product_categories);
    }

    /**
     * Handles products image.
     *
     * @param \App\Models\Product $product
     *   Product entity.
     * @param \App\Http\Requests\StoreProductRequest $request
     *   Request service.
     */
    protected function handleProductImage(Product $product, StoreProductRequest $request) {
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('image', 'public');

            $product->image = $image_path;
            $product->save();
        }

        if ($request->get('is_remove_image')) {
            Storage::disk('public')->delete($product->image);
            $product->image = '';
            $product->save();
        }
    }
}
