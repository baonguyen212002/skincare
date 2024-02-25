<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductList;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $lists = ProductList::all();
        $selectedList = null;
        $products = Product::query();

        if ($request->has('product_list')) {
            $selectedList = ProductList::where('name', $request->input('product_list'))->firstOrFail();
            $selectedListId = $selectedList->id;
            $products->where('id_list', $selectedListId);
        }

        $products = $products->get();

        return view('templates.product.product_tpl', compact('products', 'lists', 'selectedList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $tenkhongdauvi, $name_list = null)
    {
        try {
            $product_detail = Product::where('tenkhongdauvi', $tenkhongdauvi)
                ->with('galleries', 'productCat', 'productItem', 'productList', 'productBrand')
                ->firstOrFail();

            $relatedProducts = Product::where(function ($query) use ($product_detail) {
                $query->whereIn('id_list', [$product_detail->id_list, $product_detail->id_cat, $product_detail->id_item, $product_detail->id_brand])
                    ->orWhereIn('id_cat', [$product_detail->id_list, $product_detail->id_cat, $product_detail->id_item, $product_detail->id_brand])
                    ->orWhereIn('id_item', [$product_detail->id_list, $product_detail->id_cat, $product_detail->id_item, $product_detail->id_brand])
                    ->orWhereIn('id_brand', [$product_detail->id_list, $product_detail->id_cat, $product_detail->id_item, $product_detail->id_brand]);
            })
                ->where('id', '!=', $product_detail->id)
                ->take(4)
                ->get();

            Breadcrumbs::for('product.detail', function ($trail) use ($product_detail, $name_list) {
                $trail->parent('product');

                if ($name_list) {
                    $trail->push($name_list, route('product.detail', ['tenkhongdauvi' => $product_detail->tenkhongdauvi, 'name_list' => $name_list]));
                }

                $trail->push($product_detail->name, route('product.detail', $product_detail->tenkhongdauvi));
            });

            return view('templates.product.product_detail', compact('product_detail', 'relatedProducts'));
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
