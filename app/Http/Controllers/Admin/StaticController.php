<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaticModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StaticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staticModel = new StaticModel; // Tạo một thể hiện mới của model
        $staticTableName = $staticModel->getTable(); // Lấy tên bảng từ model

        $static = StaticModel::where('type', 'gioi-thieu')->first();

        return view('admin.static.index_tpl', [
            'static' => $static,
            'staticTableName' => $staticTableName,
        ]);
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
        $validatedData = $request->validate([
            'title' => 'required|string',
            'mota' => 'required|string',
            'content' => 'required|string',
            'type' => 'string|nullable',
        ]);

        $data = $validatedData;

        $data['title'] = $request->title;
        $data['slug'] = Str::slug($request->title); // Tạo slug từ tiêu đề

        // Tạo một thể hiện mới của model StaticModel và lưu vào cơ sở dữ liệu
        StaticModel::create($data);

        if ($request->type == 'gioi-thieu') {
            return redirect()->route('admin.static.index');
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
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'mota' => 'required|string',
            'content' => 'required|string',
            'type' => 'string|nullable',
        ]);

        $data = $validatedData;
        $data['title'] = $request->title;
        $data['slug'] = Str::slug($request->title);

        // Find the StaticModel instance by ID
        $static = StaticModel::findOrFail($id);

        // Update the attributes with the new data
        $static->update($data);

        if ($request->type == 'gioi-thieu') {
            return redirect()->route('admin.static.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
