<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCat;
use App\Models\ProductItem;
use App\Models\ProductList;
use Illuminate\Http\Request;

class ProductItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pro_item = ProductItem::paginate(10);
        return view('admin.product.item.index',compact('pro_item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pro_list = ProductList::all();
        $pro_cat = ProductCat::all();
        return view('admin.product.item.add',compact('pro_list','pro_cat'));
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
    $existingProductItem = ProductItem::where('name', $request->input('name'))->first();

    if ($existingProductItem) {
        // Nếu tồn tại, chuyển hướng về trang thêm mới và hiển thị thông báo lỗi
        return redirect()->route('product.item.create')->with('unsuccess', 'Product list with the same name already exists.');
    }
    // Create a new ProductCat instance
    $productItem = new ProductItem();

    // Assign values from the request
    $productItem->id_list = $request->input('id_list');
    $productItem->id_cat = $request->input('id_cat');
    $productItem->name = $request->input('name');
    $productItem->highlight = $request->input('highlight', false); // default to false if not provided
    $productItem->visible = $request->input('visible', true); // default to true if not provided

    // Save the new product category
    $productItem->save();

    // You can return a response, redirect, or perform any other action here
    return redirect()->route('product.item.index')->with('success', 'Product cat added successfully.');
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
        $pro_item = ProductItem::findOrFail($id);
        $pro_item->delete();
        return redirect()->route('product.item.index')->with('success', 'Đã xóa sản phẩm thành công.');
    }

    public function destroyAll(Request $request)
    {
        try {
            $selectedProductItemIds = $request->input('productIds', []);

            // Kiểm tra xem có sản phẩm nào được chọn hay không
            if (empty($selectedProductCatIds)) {
                return response()->json(['success' => false, 'message' => 'Không có sản phẩm được chọn.']);
            }

            // Thực hiện xóa sản phẩm theo ID đã chọn
            ProductItem::whereIn('id', $selectedProductItemIds)->delete();

            return response()->json(['success' => true, 'message' => 'Đã xóa sản phẩm thành công.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Đã xảy ra lỗi khi xóa sản phẩm.']);
        }
    }
}
