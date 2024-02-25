<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductList;
use Illuminate\Http\Request;

class ProductListController extends Controller
{
    // Validation rules for the product list
    protected $rules = [
        'name' => 'required|max:255|unique:product_list',
        'highlight' => 'boolean',
        'visible' => 'boolean',
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productLists = ProductList::paginate(10);

        return view('admin.product.list.index', compact('productLists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.list.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->rules);

        // Kiểm tra xem sản phẩm có tồn tại trong cơ sở dữ liệu hay không
        $existingProductList = ProductList::where('name', $request->input('name'))->first();

        if ($existingProductList) {
            // Nếu tồn tại, chuyển hướng về trang thêm mới và hiển thị thông báo lỗi
            return redirect()->route('product.list.create')->with('unsuccess', 'Product list with the same name already exists.');
        }

        // Nếu không có sản phẩm nào trùng tên, lưu vào cơ sở dữ liệu
        $productList = new ProductList([
            'name' => $request->input('name'),
            'highlight' => $request->input('highlight', false),
            'visible' => $request->input('visible', true),
        ]);

        $productList->save();

        return redirect()->route('product.list.index')->with('success', 'Product list added successfully.');
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
            // Xác định sản phẩm cần xóa
            $pro_list = ProductList::findOrFail($id);

            if ($pro_list->cats()->exists()) {
                // Nếu sản phẩm có danh mục, chuyển hướng với thông báo lỗi
                return redirect()->route('product.list.index')->with('unsuccess', 'Không thể xóa sản phẩm đã được gán vào danh mục.');
            }

            // Nếu không có danh mục, thực hiện xóa sản phẩm
            $pro_list->delete();
            return redirect()->route('product.list.index')->with('success', 'Đã xóa sản phẩm thành công.');
        } catch (\Exception $e) {
            return redirect()->route('product.list.index')->with('error', 'Đã xảy ra lỗi khi xóa sản phẩm.');
        }
    }

    public function destroyAll(Request $request)
    {
        try {
            $selectedProductListIds = $request->input('productIds', []);

            // Kiểm tra xem có sản phẩm nào được chọn hay không
            if (empty($selectedProductListIds)) {
                return response()->json(['success' => false, 'message' => 'Không có sản phẩm được chọn.']);
            }

            // Thực hiện xóa sản phẩm theo ID đã chọn
            $pro_list = ProductList::whereIn('id', $selectedProductListIds)->get();

            foreach ($pro_list as $productList) {
                // Kiểm tra xem có sản phẩm nào đã được gán vào danh mục hay không
                $pro_cat_count = $productList->cats()->count();

                if ($pro_cat_count > 0) {
                    return response()->json(['success' => false, 'message' => 'Không thể xóa sản phẩm đã được gán vào danh mục.']);
                }
            }

            // Xóa sản phẩm
            ProductList::whereIn('id', $selectedProductListIds)->delete();

            return response()->json(['success' => true, 'message' => 'Đã xóa sản phẩm thành công.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Đã xảy ra lỗi khi xóa sản phẩm.']);
        }
    }

}
