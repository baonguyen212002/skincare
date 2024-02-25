<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function updateStatus(Request $request,$table)
    {
        try {
            $primaryKey = 'id';
            $id = $request->input('id');
            $isChecked = $request->input('isChecked');
            $isVisible = $request->input('isVisible');

            DB::table($table)->where($primaryKey, $id)->update(['highlight' => $isChecked,'visible' => $isVisible]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Internal Server Error']);
        }
    }
}
