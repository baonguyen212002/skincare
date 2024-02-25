<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photo = Photos::where('type', 'slide')->paginate(10);
        return view('admin.photo.index', compact('photo'));
    }
    public function logo()
    {
        $logo = Photos::where('type', 'logo')->get();
        return view('admin.logo.index', compact('logo'));
    }
    public function background_footer()
    {
        $bg_footer = Photos::where('type', 'bgfooter')->get();
        return view('admin.background-footer.index', compact('bg_footer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.photo.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'nullable',
            'description' => 'nullable',
            'link' => 'nullable|url',
            'type' => 'required',
        ]);

        // Tạo một tên mới cho ảnh để tránh trùng lặp
        $imageName = uniqid() . '_' . $request->file('image')->getClientOriginalName();

        // Đường dẫn thư mục lưu ảnh
        $imageFolder = 'images/photos/' . $request->type;

        // Lưu ảnh với tên mới vào thư mục cụ thể
        $imagePath = $request->file('image')->storeAs($imageFolder, $imageName, 'public');

        Photos::create([
            'image' => $imagePath,
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'stt' => 1,
            'type' => $request->type,
        ]);
        if ($request->type == 'slide') {
            return redirect()->route('photo.index')->with('success', 'Photo added successfully!');
        } elseif ($request->type == 'logo') {
            return redirect()->route('logo.index')->with('success', 'Logo added successfully!');
        } else if ($request->type == 'bgfooter') {
            return redirect()->route('bg_footer.index')->with('success', 'Background added successfully!');
        }
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
    // public function updateLogo(Request $request, $id)
    // {
    //     $request->validate([
    //         'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     $logo = Photos::find($id);

    //     if (!$logo) {
    //         // Xử lý trường hợp không tìm thấy logo
    //         return redirect()->back()->with('error', 'Logo not found');
    //     }

    //     if ($request->hasFile('image')) {
    //         // Kiểm tra nếu có ảnh cũ
    //         $oldImagePath = $logo->image;
    //         $imageName = uniqid() . '_' . $request->file('image')->getClientOriginalName();

    //         // Đường dẫn thư mục lưu ảnh
    //         $imageFolder = 'images/photos/' . $request->type;

    //         // Lưu ảnh mới
    //         $newImagePath = $request->file('image')->storeAs($imageFolder, $imageName, 'public');
    //         // Xóa ảnh cũ nếu tồn tại
    //         if ($oldImagePath) {
    //             Storage::delete($oldImagePath);
    //         }

    //         // Cập nhật thông tin của logo trong cơ sở dữ liệu
    //         $logo->update(['image' => $newImagePath]);
    //     }

    //     return redirect()->back()->with('success', 'Logo updated successfully');
    // }
    public function updatePhoto(Request $request, $id, $type)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $photo = Photos::find($id);

        if (!$photo) {
            return redirect()->back()->with('error', 'Photo not found');
        }

        if ($request->hasFile('image')) {
            $oldImagePath = $photo->image;
            $imageName = uniqid() . '_' . $request->file('image')->getClientOriginalName();

            $imageFolder = 'images/photos/' . $type;

            $newImagePath = $request->file('image')->storeAs($imageFolder, $imageName, 'public');

            if ($oldImagePath) {
                Storage::delete($oldImagePath);
            }

            $photo->update(['image' => $newImagePath]);
        }

        // Nếu có thêm logic cập nhật thông tin khác cho background footer ở đây
        // ...

        return redirect()->back()->with('success', 'Photo updated successfully');
    }
    public function updateLogo(Request $request, $id)
    {
        return $this->updatePhoto($request, $id, 'logo');
    }

    public function updateBackgroundFooter(Request $request, $id)
    {
        return $this->updatePhoto($request, $id, 'background-footer');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
