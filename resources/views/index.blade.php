<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
    @include('layouts.css')

</head>

<body>
    @include('layouts.menu', ['list' => $list, 'selectedList' => $selectedList])

    @if (isset($showSlide) && $showSlide)
        @include('layouts.slide')
    @endif

    @if (!Request::is('/'))
        <!-- Kiểm tra nếu không ở trang home -->
        <section class="breadCrumbs">
            <div class="container">{{ Breadcrumbs::render() }}</div>
        </section>
    @endif
    <section class="w-100">
        <div class="container">
            @yield('content')

        </div>
    </section>

    @include('layouts.footer')
    @include('layouts.js')
</body>

</html>
