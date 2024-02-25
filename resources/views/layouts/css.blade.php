<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/styles_detail.css') }}">
<link rel="stylesheet" href="{{ asset('css/fontello.css') }}">
<link rel="stylesheet" href="{{ asset('css/fontello-user.css') }}">
<link rel="stylesheet" href="{{ asset('css/fontello-search.css') }}">
<link rel="stylesheet" href="{{ asset('owlcarousel2/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('owlcarousel2/owl.theme.default.css') }}">
<link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('magiczoomplus/magiczoomplus.css') }}">
<script src="{{ asset('magiczoomplus/magiczoomplus.js') }}"></script>
<link rel="stylesheet" href="{{ asset('flexslider/flexslider.css') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
<style type="text/css">
    .section_newletter {
        padding: 60px 0;
        background-color: #7F8A90;

        @if ($bg_footer)
            background-image: url('{{ asset('storage/' . $bg_footer->image) }}');
        @endif
        /* Thay đổi 'photo' thành tên cột chứa tên hình ảnh trong bảng của bạn */
    }
</style>
