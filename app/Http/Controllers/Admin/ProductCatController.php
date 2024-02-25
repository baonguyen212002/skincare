<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCat;
use App\Models\ProductList;
use Illuminate\Http\Request;

class ProductCatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pro_cat = ProductCat::paginate(10);
        return view('admin.product.cat.index', compact('pro_cat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pro_list = ProductList::all();
        return view('admin.product.cat.add', compact('pro_list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|max:255',
            'highlight' => 'boolean',
            'visible' => 'boolean',
        ]);
        $existingProductCat = ProductCat::where('name', $request->input('name'))->first();

        if ($existingProductCat) {
            // Nếu tồn tại, chuyển hướng về trang thêm mới và hiển thị thông báo lỗi
            return redirect()->route('product.cat.create')->with('unsuccess', 'Product list with the same name already exists.');
        }
        // Create a new ProductCat instance
        $productCat = new ProductCat();

        // Assign values from the request
        $productCat->id_list = $request->input('id_list');
        $productCat->name = $request->input('name');
        $productCat->highlight = $request->input('highlight', false); // default to false if not provided
        $productCat->visible = $request->input('visible', true); // default to true if not provided

        // Save the new product category
        $productCat->save();

        // You can return a response, redirect, or perform any other action here
        return redirect()->route('product.cat.index')->with('success', 'Product cat added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        try {
            $pro_cat = ProductCat::findOrFail($id);
            $productItemCount = $pro_cat->productItems()->count();

            if ($productItemCount > 0) {
                return redirect()->route('product.cat.index')->with('unsuccess', 'Không thể xóa sản phẩm đã được gán vào danh mục.');
            }

            // Thực hiện xóa sản phẩm
            $pro_cat->delete();

            return redirect()->route('product.cat.index')->with('success', 'Đã xóa sản phẩm thành công.');
        } catch (\Exception $e) {
            return redirect()->route('product.cat.index')->with('unsuccess', 'Đã xảy ra lỗi khi xóa sản phẩm.');
        }
    }

    public function destroyAll(Request $request)
    {
        try {
            $selectedProductCatIds = $request->input('productIds', []);

            // Kiểm tra xem có sản phẩm nào được chọn hay không
            if (empty($selectedProductCatIds)) {
                return response()->json(['success' => false, 'message' => 'Không có sản phẩm được chọn.']);
            }

            // Thực hiện xóa sản phẩm theo ID đã chọn
            $pro_cat = ProductCat::whereIn('id', $selectedProductCatIds);

            if ($pro_cat->has('productItems')->exists()) {
                return response()->json(['success' => false, 'message' => 'Không thể xóa sản phẩm đã được gán vào danh mục.']);
            }

            $pro_cat->delete();
            return response()->json(['success' => true, 'message' => 'Đã xóa sản phẩm thành công.']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Đã xảy ra lỗi khi xóa sản phẩm.']);
        }
    }
}
