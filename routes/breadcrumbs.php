<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\StaticModel;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Home > product
Breadcrumbs::for('product', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Product', route('product'));
});

// Home > product > [name]
Breadcrumbs::for('name', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('product');
    $trail->push($product->name, route('product.detail', $product));
});
//Home > Product > list > cat > item > name

Breadcrumbs::for('static.index', function ($trail, $slug) {
    $static = StaticModel::where('slug', $slug)->first();

    if ($static) {
        $trail->parent('home'); // Add a parent breadcrumb if needed
        $trail->push($static->title, route('static.index', $slug));
    }
});
