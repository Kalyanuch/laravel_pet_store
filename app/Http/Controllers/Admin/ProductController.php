<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
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
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:250'],
            'description' => ['required', 'max:3000'],
            'status' => ['in:0,1', 'required'],
            'sort_order' => ['regex:/^[0-9]*$/', 'nullable'],
            'category_id' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
        ]);

        $product = Product::create($request->all());

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
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

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
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required', 'max:250'],
            'description' => ['required', 'max:3000'],
            'status' => ['in:0,1', 'required'],
            'sort_order' => ['regex:/^[0-9]*$/', 'nullable'],
            'category_id' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
        ]);

        $product = Product::findOrFail($id);

        $product->fill($request->all());

        $product->save();

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
    public function destroy(string $id)
    {
        Product::findOrFail($id);

        Product::destroy($id);

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
}
