@extends('index')
@section('content')
    <div class="row">
        <div class="section wrap-padding-15 wp_product_detail">
            <div class="details-product section">
                <div class="product-detail-left product-images col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="large-image vol_large_default">
                        <a class="MagicZoom" href="{{ asset('images/products/' . $product_detail->image) }}" id="mainImage"
                            data-options="zoomMode: 'zoom'">
                            <img onerror="{{ asset('images/noimage.png') }}"
                                src="{{ generateThumbnail('images/products/' . $product_detail->image, 358, 358, true) }}"
                                alt="{{ $product_detail->name }}">
                        </a>
                    </div>
                    <div class="section owlthumb_relative_product_1">
                        <div class="owl-carousel owl-theme owl-thumb-pro">
                            @foreach ($product_detail->galleries as $gallery)
                                <div class="item">
                                    <a href="{{ asset('images/gallery/' . $gallery->image) }}" class="gallery-image"
                                        data-zoom-id="mainImage">
                                        <img onerror="{{ asset('images/noimage.png') }}"
                                            src="{{ generateThumbnail('images/gallery/' . $gallery->image, 358, 358, true) }}"
                                            alt="{{ $product_detail->name }} - Gallery Image" />
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 details-pro">
                    <div class="product-details__top">
                        <h1 class="title-product">
                            {{ $product_detail->name }}
                        </h1>
                        <div class="group-status">
                            @php
                                $brand = optional($product_detail->productBrand);
                            @endphp

                            @if ($brand->id)
                                <span class="status_first">Thương hiệu: <span
                                        class="status_name ">{{ $brand->name }}</span></span>
                            @else
                                <span class="status_first">Thương hiệu: <span class="status_name ">Đang cập
                                        nhật</span></span>
                            @endif
                        </div>

                    </div>
                    <div class="product-details__price">
                        {{ number_format($product_detail->price) }}đ
                    </div>
                    <div class="product-details__middle">
                        <div class="rte">
                            {!! $product_detail->description !!}
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <aside class="aside-item aside_product">
                        <div class="aside-title">
                            <h2 class="title_head mt-0 mb-10"><a href="#">Sản phẩm cùng loại</a></h2>
                        </div>
                        <div class="list_product">
                            @if (!empty($relatedProducts) && $relatedProducts->count() > 0)
                                @foreach ($relatedProducts as $relatedProduct)
                                    <div class="wrap_mm">
                                        <div class="item_product_main itemcustome">
                                            <div class="product-box product-item-main product-main-list-mini">
                                                <div class="product-thumbnail">
                                                    <a class="image_thumb p_img"
                                                        href="{{ route('product.detail', ['tenkhongdauvi' => $relatedProduct->tenkhongdauvi]) }}"
                                                        title="{{ $relatedProduct->name }}">
                                                        <img src="{{ asset('images/products/' . $relatedProduct->image) }}"
                                                            data-lazyload="{{ asset('images/products/' . $relatedProduct->image) }}"
                                                            alt="{{ $relatedProduct->name }}">
                                                    </a>
                                                </div>
                                                <div class="product-info product-bottom">
                                                    <h3 class="product-name"><a
                                                            href="{{ route('product.detail', ['tenkhongdauvi' => $relatedProduct->tenkhongdauvi]) }}"
                                                            title="{{ $relatedProduct->name }}">{{ $relatedProduct->name }}</a>
                                                    </h3>
                                                    <div class="price-box">
                                                        <span
                                                            class="special-price">{{ number_format($relatedProduct->price) }}đ</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-warning" role="alert">
                                    <strong>Đang cập nhật sản phẩm</strong>
                                </div>
                            @endif


                        </div>
                    </aside>
                </div>
            </div>
        </div>
        <div class="wrap_tab_ed">
            <div class="tab_h col-xs-12 col-lg-12 col-sm-12 col-md-12">
                <div class="bg-white">
                    <div class="product-tab e-tabs not-dqtab">
                        <ul class="tabs tabs-title clearfix">

                            <li class="tab-link current" data-tab="tab-1">
                                <h3><span>Thông tin</span></h3>
                            </li>


                            <li class="tab-link" data-tab="tab-2">
                                <h3><span>Hướng dẫn mua hàng</span></h3>
                            </li>


                            <li class="tab-link" data-tab="tab-3">
                                <h3><span>Đánh giá</span></h3>
                            </li>
                        </ul>
                        <div id="tab-1" class="tab-content content_extab current">
                            <div class="rte">
                                {!! $product_detail->content !!}
                            </div>
                        </div>
                        <div id="tab-2"class="tab-content content_extab">ád</div>
                        <div id="tab-3"class="tab-content content_extab">Comment</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const galleryImages = document.querySelectorAll('.gallery-image');

            galleryImages.forEach(function(galleryImage) {
                galleryImage.addEventListener('click', function() {
                    // Trigger MagicZoom update on image change
                    if (typeof MagicZoom !== 'undefined') {
                        MagicZoom.update(galleryImage);
                    }
                });
            });

            // Initialize MagicZoom for the main image
            if (typeof MagicZoom !== 'undefined') {
                MagicZoom.refresh();
            }
        });
    </script>
@endsection
