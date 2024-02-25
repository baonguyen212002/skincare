<?php

namespace App\Http\Controllers;

use App\Models\Photos;
use App\Models\Product;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HomeController extends Controller
{
    public function index()
    {
        $products_new = Product::with('galleries', 'productCat', 'productItem', 'productList')
            ->where('visible', '>', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        $products_features = Product::with('galleries', 'productCat', 'productItem', 'productList')
            ->where('highlight', '>', 0)
            ->where('visible', '>', 0)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        $slides = Photos::where('type', 'slide')->get();
        return view('templates.index.index_tpl', compact('products_new', 'products_features', 'slides'));
    }

    public function show(string $id)
    {

    }

}
