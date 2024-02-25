<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCat;
use App\Models\ProductItem;
use App\Models\ProductList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::paginate(10);
        return view('admin.product.index', compact('product'));
    }

    public function create()
    {
        $list = ProductList::all();
        $cat = ProductCat::all();
        $item = ProductItem::all();
        $brand = ProductBrand::all();
        return view('admin.product.add', compact('list', 'cat', 'item', 'brand'));
    }

    public function store(Request $request)
    {
        // Lưu thông tin sản phẩm
        $product = Product::create($request->except('image'));

        // Lưu hình ảnh chính của sản phẩm
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('images/products/', $filename);
            $product->image = $filename;
        }
        // Lưu thông tin gallery (nhiều hình ảnh con)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                if ($image->isValid()) {
                    $ext = $image->getClientOriginalExtension();
                    $filename = time() . '_' . $index . '.' . $ext;
                    $image->move('images/gallery/', $filename);

                    Gallery::create([
                        'id_product' => $product->id,
                        'image' => $filename,
                        'sort_order' => $index + 1,
                    ]);
                }
            }
        }
        $product->save();
        return redirect()->route('product.index')->with(['success' => 'Sản phẩm và hình ảnh đã được tạo thành công']);
    }

    // public function updateStatus(Request $request)
    // {
    //     try {
    //         $productId = $request->input('productId');
    //         $isChecked = $request->input('isChecked');
    //         $isVisible = $request->input('isVisible');

    //         $product = Product::find($productId);
    //         $product->highlight = $isChecked;
    //         $product->visible = $isVisible;
    //         $product->save();

    //         return response()->json(['success' => true]);
    //     } catch (\Exception $e) {
    //         \Log::error($e->getMessage());
    //         return response()->json(['success' => false, 'error' => 'Internal Server Error']);
    //     }
    // }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $list = ProductList::all();
        $cat = ProductCat::all();
        $item = ProductItem::all();
        $brand = ProductBrand::all();
        $images = Gallery::where('id_product', $id)->get();
        return view('admin.product.edit', compact('product', 'list', 'cat', 'item', 'brand', 'images'));
    }

    public function update(Request $request, $id)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'id_list' => 'exists:product_list,id',
            'id_cat' => 'exists:product_cat,id',
            'id_item' => 'exists:product_item,id',
            'id_brand' => 'exists:product_brand,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Thêm các rules validation cho các trường khác nếu cần
        ]);

        // Lấy sản phẩm cần sửa từ database
        $product = Product::findOrFail($id);

        // Cập nhật thông tin sản phẩm
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->id_list = $request->input('id_list');
        $product->id_cat = $request->input('id_cat');
        $product->id_item = $request->input('id_item');
        $product->id_brand = $request->input('id_brand');

        // Xử lý hình ảnh sản phẩm
        if ($request->hasFile('image')) {
            // Xóa hình cũ nếu tồn tại
            // (Optional, tùy thuộc vào yêu cầu của bạn)
            // unlink(public_path('images/products/' . $product->image));

            // Lưu hình mới và cập nhật tên hình vào database
            $imagePath = 'images/products/' . $request->file('image')->storeAs('', $product->image, 'public');
            $product->image = $imagePath;
        }

        // Xử lý album hình ảnh sản phẩm
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                if ($file->isValid()) {
                    // Xóa hình cũ nếu tồn tại
                    // (Optional, tùy thuộc vào yêu cầu của bạn)
                    // unlink(public_path('images/gallery/' . $galleryItem->image));

                    // Lưu hình mới và cập nhật tên hình vào database
                    $filename = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('images/gallery/', $filename, 'public');

                    // Cập nhật thông tin hình ảnh trong bảng Gallery
                    $galleryItem = Gallery::where('id_product', $product->id)
                        ->where('sort_order', $index + 1)
                        ->first();

                    $galleryItem->image = $filename;
                    $galleryItem->save();
                }
            }
        }

        // Cập nhật các trường thông tin khác nếu cần

        // Lưu thay đổi vào database
        $product->save();

        // Chuyển hướng về trang danh sách sản phẩm hoặc trang chi tiết sản phẩm
        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    public function destroy(string $id)
    {
        // Tìm sản phẩm theo ID
        $product = Product::findOrFail($id);

        // Lấy danh sách tất cả ảnh trong Gallery có id sản phẩm tương ứng
        $galleryImages = Gallery::where('id_product', $id)->get();

        // Xóa tất cả ảnh trong thư mục gallery
        foreach ($galleryImages as $galleryImage) {
            $imagePath = 'images/gallery/' . $galleryImage->image;

            // Kiểm tra xem ảnh tồn tại trước khi xóa
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }

        // Xóa tất cả ảnh trong Gallery
        Gallery::where('id_product', $id)->delete();

        // Xóa ảnh của sản phẩm
        if ($product->image) {
            $productImagePath = 'images/products/' . $product->image;

            // Kiểm tra xem ảnh tồn tại trước khi xóa
            if (Storage::exists($productImagePath)) {
                Storage::delete($productImagePath);
            }
        }

        // Xóa sản phẩm
        $product->delete();

        return redirect()->back()->with(['success' => 'Xóa sản phẩm thành công']);
    }
}
