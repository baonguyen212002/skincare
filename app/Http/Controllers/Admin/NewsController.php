<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaticModel;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $type = request()->route()->getName(); // Lấy tên route

        $displayText = [
            'admin.policy.index' => 'Chính sách',
            'admin.news.index' => 'Tin tức',
        ];

        $data['type'] = $type;
        // dd($data);
        $data['displayText'] = $displayText[$type];
        $data['items'] = StaticModel::where('type', $type)->get();

        return view('admin.news.man.index_tpl', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create( $act, $type, $p)
    {
        $data = [];

        $displayText = [
            'chinh-sach' => 'Chính sách',
            'tin-tuc' => 'Tin tức',
        ];

        $data['type'] = $type;
        $data['displayText'] = isset($displayText[$type]) ? $displayText[$type] : ''; // Kiểm tra khóa tồn tại trước khi sử dụng
        $data['items'] = StaticModel::where('type', $type)->get();
        $data['isPolicyPage'] = $type === 'chinh-sach';
        return view('admin.news.man.add_tpl', $data);
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
        //
    }
}
