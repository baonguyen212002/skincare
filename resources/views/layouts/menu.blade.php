    <section class="top-nav hidden-xs">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 col-xs-6">
                    <div id="menu">
                        <nav id="menu-links" class="menulinks">
                            <ul>
                                <li><a href="/" class="menu" target="_self">Home</a></li>
                                <li><a href="About-Us_ep_7.html" class="menu" target="_self">About Us</a></li>
                                <li><a href="giftregistry_home.asp" class="menu" target="_self">Gift Registry</a></li>
                                <li><a href="myaccount.asp" class="menu" target="_self">My Account</a></li>
                                <li><a href="crm.asp?action=contactus" class="menu" target="_self">Contact Us</a></li>
                                <li><a href="blog.asp" class="menu" target="_self">Blog</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-sm-2 search-form-col"></div>
                <div class="col-sm-5 clearfix hidden-xs cart-account">
                    <div class="minicart">
                        <a href="#" class="minicart-inner clearfix">
                            <span>
                                <span class="cart-title">Shopping Cart</span></span>
                            <span class="icon-basket cart-icon"></span>
                        </a>
                    </div>
                    <div class="floating-cart"></div>
                    <div class="useraccount clearfix">
                        <ul class="clearfix">
                            <li>
                                <span class="icon-user">
                                    @auth
                                        <a href="{{ url('/dashboard') }}"
                                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ Auth::user()->name }}</a>
                                    @else
                                        <span>
                                            <a href="{{ route('login') }}"
                                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                                                in</a>

                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}"
                                                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                                            @endif
                                        </span>

                                    @endauth
                                </span>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="sticky-header navbar-wrapper" id="sticky-header">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white">
                <div class="menu_mobi flex-inline-center-left">
                    <div class="align-self-center">
                        <p class="icon_menu_mobi"><i class="fa fa-bars" aria-hidden="true"></i></p>
                    </div>
                </div>
                <div class="menu_mobi_add"></div>
                @if ($logo)
                    <a class="navbar-brand" href="{{ route('home') }}"><img
                            src="{{ asset('storage/' . $logo->first()->image) }}" alt="" srcset=""></a>
                @endif

                <div class="right-button flex-inline-center-right">
                    <div class="cart-button">
                        <a class="quick-button-inner" href="#">
                            <div class="quick-icon">
                                <img src="{{ asset('/images/cart.png') }}" width="24" height="24" alt="">
                                <span class="count-cart count">0</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="collapse navbar-collapse menu" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 menu_cap_cha">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item menulicha">
                            <a class="nav-link" href="{{ route('product') }}">
                                Sản phẩm
                            </a>
                            <ul class="menu_cap_con item_small hidden-sm hidden-xs">
                                @foreach ($list as $item)
                                    <li><a href="{{ route('product', ['product_list' => $item->name]) }}"
                                            @if ($selectedList && $selectedList->id == $item->id) class="selected" @endif>
                                            {{ $item->name }}
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <div class="search-form">
                            <input class="search-text form-control" type="search" placeholder="Search"
                                aria-label="Search">
                            <button class="search-submit btn btn-default btn-inverse" type="submit"><span
                                    class="icon-search"></span></button>
                        </div>

                    </form>
                </div>
            </nav>
        </div>
    </div>
