<?php

namespace App\Providers;

use App\Models\Photos;
use App\Models\Product;
use App\Models\ProductList;
use App\Models\Setting;
use App\Models\StaticModel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        $logo = Photos::where('type', 'logo')->first();
        $bg_footer = Photos::where('type', 'bgfooter')->first();
        $list = ProductList::all();
        $selectedList = null;
        $products = Product::query();
        $static_gt = StaticModel::where('type', 'gioi-thieu')->first();
        // Check if 'product_list' is in the request
        if (request()->has('product_list')) {
            $selectedList = ProductList::where('name', request()->input('product_list'))->firstOrFail();
            $selectedListId = $selectedList->id;
            $products->where('id_list', $selectedListId);
        }

        // Retrieve the filtered products
        $filteredProducts = $products->get();
        $setting = Setting::first();
        // Share data with all views
        View::share(['logo' => $logo, 'bg_footer' => $bg_footer, 'list' => $list, 'selectedList' => $selectedList, 'products' => $filteredProducts, 'setting' => $setting, 'static_gt' => $static_gt]);
    }

}
