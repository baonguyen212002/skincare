@extends('index')
@section('content')
    @php
        $showSlide = true; // Giá trị mặc định
    @endphp
    <div class="row">
        <section class="wrapper-product">
            <h1 class="wrapper-product__text">Sản phẩm mới nhất</h1>
            <div class="wrapper-product__content products">
                <div class="products_views column-4 d-flex">
                    @foreach ($products_new as $value)
                        <div class="wrap-product__item">
                            <div class="image">
                                <a href="{{ route('product.detail',['tenkhongdauvi'=> $value->tenkhongdauvi]) }}"><img src="{{ generateThumbnail('images/products/' . $value['image'], 184, 184, true) }}"
                                        alt="{{ $value->name }}"></a>
                            </div>
                            <div class="product_content">
                                <div class="name"><a
                                        href="{{ route('product.detail', ['tenkhongdauvi' => $value->tenkhongdauvi]) }}">
                                        {{ $value->name }}
                                    </a></div>
                                <div class="price"><span>{{ number_format($value['price']) }}</span></div>
                                <div class="cart"><a href="#" class="add-to-cart btn btn-default"><span>Thêm vào giỏ
                                            hàng</span></a></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section class="wrapper-product">
            <h1 class="wrapper-product__text">Sản phẩm nổi bật</h1>
            <div class="wrapper-product__content flexslider">
                <div class="products_views column-4 d-flex">
                    @foreach ($products_features as $value)
                        <div class="wrap-product__item">
                            <div class="image">
                                <a href="{{ route('product.detail',['tenkhongdauvi'=> $value->tenkhongdauvi]) }}"><img src="{{ generateThumbnail('images/products/' . $value['image'], 184, 184, true) }}"
                                        alt="{{ $value->name }}"></a>
                            </div>
                            <div class="product_content">
                                <div class="title"><a href="{{ route('product.detail', ['tenkhongdauvi' => $value->tenkhongdauvi]) }}">{{ $value['name'] }}</a></div>
                                <div class="price"><span>{{ number_format($value['price']) }}</span></div>
                                <div class="cart"><a href="#" class="add-to-cart btn btn-default"><span>Thêm vào giỏ
                                            hàng</span></a></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
