<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(string $id)
    {
        $images = Gallery::where('id_product', $id)->get();
        return response()->json(['data' => $images]);
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
    public function update(Request $request, $id)
    {
        // Validate request data if needed
        $request->validate([
            'id_product' => 'required|exists:products,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sort_order' => 'numeric',
            // ... Thêm các quy tắc kiểm tra hợp lệ nếu cần thiết
        ]);

        // Tìm gallery theo ID
        $gallery = Gallery::find($id);

        if (!$gallery) {
            // Trả về thông báo lỗi nếu không tìm thấy gallery
            return redirect()->back()->with('error', 'Gallery not found');
        }

        // Cập nhật thông tin gallery
        $gallery->id_product = $request->input('id_product');

        // Kiểm tra nếu có file hình ảnh được chọn
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('images/gallery/', $filename);
            $gallery->image = $filename;
        }

        $gallery->sort_order = $request->input('sort_order');

        // Lưu các trường khác nếu có

        // Lưu thay đổi vào cơ sở dữ liệu
        $gallery->save();

        // Trả về thông báo thành công
        return redirect()->back()->with('success', 'Gallery updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
