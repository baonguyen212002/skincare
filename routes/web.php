<?php

use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\ProductBrandController as AdminProductBrandController;
use App\Http\Controllers\Admin\ProductCatController as AdminProductCatControler;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProductItemController as AdminProductItemController;
use App\Http\Controllers\Admin\ProductListController as AdminProductListController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StaticController as AdminStaticController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaticController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Đây là nơi bạn có thể đăng ký các route web cho ứng dụng của mình.
| Những route này được tải bởi RouteServiceProvider và tất cả chúng sẽ được gán cho nhóm middleware "web".
| Hãy tạo điều gì đó tuyệt vời!
|
 */

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('product/{tenkhongdauvi}', [ProductController::class, 'show'])->name('product.detail');
Route::get('product', [ProductController::class, 'index'])->name('product');

Route::get('/{slug}', [StaticController::class, 'show'])->name('static.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'filemanager', 'middleware'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::post('/update-status/{table}', [Controller::class, 'updateStatus']);
Route::middleware('admin', 'isAdmin')->group(function () {
    Route::get('/soft', [AdminHomeController::class, 'index'])->name('admin.dashboard');
    Route::prefix('/soft')->group(function () {
//product
        Route::get('/products', [AdminProductController::class, 'index'])->name('product.index');
        Route::get('/product/add', [AdminProductController::class, 'create'])->name('product.create');
        Route::post('/product/store', [AdminProductController::class, 'store'])->name('product.store');
        Route::get('/product/{id}/edit', [AdminProductController::class, 'edit'])->name('product.edit');
        Route::put('/product/product_update/{id}', [AdminProductController::class, 'update'])->name('product.update');
        Route::delete('/product/delete={id}', [AdminProductController::class, 'destroy'])->name('product.destroy');

        Route::put('/gallery/{id}', [GalleryController::class, 'update'])->name('gallery.update');
        Route::get('/gallery/{id}', [GalleryController::class, 'show'])->name('product.gallery.show');

        Route::get('/product/list', [AdminProductListController::class, 'index'])->name('product.list.index');
        Route::get('/products/add_list', [AdminProductListController::class, 'create'])->name('product.list.create');
        Route::post('/product-list/store', [AdminProductListController::class, 'store'])->name('product.list.store');
        Route::post('/product/list/delete-selected', [AdminProductListController::class, 'destroyAll'])->name('product.list.destroyAll');
        Route::delete('/product/list={id}', [AdminProductListController::class, 'destroy'])->name('product.list.destroy');

        Route::get('/product/cat', [AdminProductCatControler::class, 'index'])->name('product.cat.index');
        Route::get('/products/add_cat', [AdminProductCatControler::class, 'create'])->name('product.cat.create');
        Route::post('/product-cat/store', [AdminProductCatControler::class, 'store'])->name('product.cat.store');
        Route::delete('/product/cat={id}', [AdminProductCatControler::class, 'destroy'])->name('product.cat.destroy');
        Route::post('/product/cat/delete-selected', [AdminProductCatControler::class, 'destroyAll'])->name('product.cat.destroyAll');

        Route::get('/product/brand', [AdminProductBrandController::class, 'index'])->name('product.brand.index');
        Route::get('/products/add_brand', [AdminProductBrandController::class, 'create'])->name('product.brand.create');

        Route::get('/product/item', [AdminProductItemController::class, 'index'])->name('product.item.index');
        Route::get('/products/add_item', [AdminProductItemController::class, 'create'])->name('product.item.create');
        Route::post('/product-item/store', [AdminProductItemController::class, 'store'])->name('product.item.store');
        Route::delete('/product/item={id}', [AdminProductItemController::class, 'destroy'])->name('product.item.destroy');
        Route::post('/product/item/delete-selected', [AdminProductItemController::class, 'destroyAll'])->name('product.item.destroyAll');

        Route::get('static/introduce', [AdminStaticController::class, 'index'])->name('admin.static.index');
        Route::post('static/introduce', [AdminStaticController::class, 'store'])->name('static.store');
        Route::put('/static/{id}', [AdminStaticController::class, 'update'])->name('admin.static.update');
        Route::get('/admin/policy', [AdminNewsController::class, 'index'])->name('admin.policy.index');
        Route::get('/admin/news', [AdminNewsController::class, 'index'])->name('admin.news.index');
        Route::get('/admin/news/{act}/{type}/p/{p}', [AdminNewsController::class, 'create'])->name('admin.news.create');
        Route::get('/admin/policy/{act}/{type}/p/{p}', [AdminNewsController::class, 'create'])->name('admin.policy.create');
        Route::get('/photo', [PhotoController::class, 'index'])->name('photo.index');
        Route::get('/logo', [PhotoController::class, 'logo'])->name('logo.index');
        Route::put('/logo/{id}', [PhotoController::class, 'updateLogo'])->name('logo.update');
        Route::get('/background-footer', [PhotoController::class, 'background_footer'])->name('bg_footer.index');
        Route::put('/background-footer/{id}', [PhotoController::class, 'updateBackgroundFooter'])->name('bg_footer.update');

        Route::get('/photo/create', [PhotoController::class, 'create'])->name('photo.create');
        Route::match(['post', 'put'], '/photos', [PhotoController::class, 'store'])->name('photo.store');
        Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
        Route::match(['post', 'put'], '/settings/{setting}', [SettingController::class, 'update'])->name('settings.update');
        Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');

    });
});

require __DIR__ . '/auth.php';
