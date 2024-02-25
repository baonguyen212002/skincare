@extends('index')
@section('content')
    <div class="d-flex">
        <aside class="dqdt-sidebar sidebar left-content col-lg-3 col-lg-3-fix">
            <div class="wrap_background_aside asidecollection">
                <aside class="aside-item sidebar-category collection-category">
                    <div class="aside-title">
                        <h2 class="title-head margin-top-0 margin-bottom-10"><span>Danh mục sản phẩm</span></h2>
                    </div>
                    <div class="aside-content">
                        <nav class="nav-category navbar-toggleable-md">
                            <ul class="nav navbar-pills">
                                <li><a href="{{ route('product') }}">Tất cả sản phẩm</a></li>
                                @foreach ($list as $item)
                                    <li>
                                        <a href="{{ route('product', ['product_list' => $item->name]) }}"
                                            @if ($selectedList && $selectedList->id == $item->id) class="selected" @endif>
                                            {{ $item->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </aside>
            </div>
        </aside>
        <div class="wrapper-product__content products w-100 pt-3">
            @if (count($products) > 0)
                <div class="products_views column-4 d-flex">
                    @foreach ($products as $value)
                        <div class="wrap-product__item">
                            <div class="image">
                                <a href="{{ route('product.detail', ['tenkhongdauvi' => $value->tenkhongdauvi]) }}">
                                    <img src="{{ generateThumbnail('images/products/' . $value['image'], 184, 184, true) }}"
                                        alt="{{ $value->name }}">
                                </a>
                            </div>
                            <div class="product_content">
                                <div class="name">
                                    <a href="{{ route('product.detail', ['tenkhongdauvi' => $value->tenkhongdauvi]) }}">
                                        {{ $value->name }}
                                    </a>
                                </div>
                                <div class="price">
                                    <span>{{ number_format($value['price']) }}</span>
                                </div>
                                <div class="cart">
                                    <a href="#" class="add-to-cart btn btn-default">
                                        <span>Thêm vào giỏ hàng</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-warning" role="alert">
                    <strong>Không tìm thấy kết quả</strong>
                </div>
            @endif
        </div>
    </div>


@endsection
