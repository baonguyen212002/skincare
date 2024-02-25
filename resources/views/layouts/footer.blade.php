<section class="footer">
    <section class="section_newletter">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <h2>
                        Đăng ký nhận tin
                    </h2>
                    <p>
                        Bạn có thể đăng ký nhận tin khuyến mãi bất cứ lúc nào, những thông tin sẽ được gửi tới bạn nhanh
                        nhất.
                    </p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="mail_footer">



                        <form class="margin-bottom-0" action="#" method="post" id="mc-embedded-subscribe-form"
                            name="mc-embedded-subscribe-form" target="_blank">
                            <input type="email" value="" placeholder="Nhập email của bạn" name="EMAIL"
                                id="mail">
                            <button class="btn btn-primary subscribe" name="subscribe" id="subscribe"><i
                                    class="fa fa-paper-plane"></i>Đăng ký</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="site-footer">
            <div class="mid-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                            <div class="widget-ft">
                                <h4 class="title-menu">
                                    <span>Liên hệ</span>
                                </h4>
                                <div class="time_work">
                                    <div class="itemfooter">
                                        <div class="left_f">
                                            <i class="fa fa-map-marker"></i>
                                        </div>
                                        <div class="r"><span>{{ $setting->options['diachi'] ?? '' }}</span></div>
                                    </div>
                                    <div class="itemfooter">
                                        <div class="left_f">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <div class="r">
                                            <a class="fone" href="tel:{{ $setting->options['dienthoai'] ?? '' }}">
                                                @if (isset($setting->options['dienthoai']))
                                                    <?php
                                                    $soDienThoai = $setting->options['dienthoai'] ?? '';
                                                    $formattedSoDienThoai = substr_replace($soDienThoai, '.', 2, 0);
                                                    $formattedSoDienThoai = substr_replace($formattedSoDienThoai, '.', 6, 0);
                                                    ?>
                                                    {{ $formattedSoDienThoai }}
                                                @endif
                                            </a>
                                        </div>
                                    </div>

                                    <div class="itemfooter">
                                        <div class="left_f">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <div class="r"><a
                                                href="mailto:{{ $setting->options['email'] ?? '' }}">{{ $setting->options['email'] ?? '' }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">
                            <div class="widget-ft">
                                <h4 class="title-menu">
                                    <span>Về OganiShop</span>
                                </h4>
                                <ul>
                                    <li><a href="{{ route('static.index',$static_gt->slug) }}">{{ $static_gt->title }}</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                            <div class="widget-ft">
                                <h4 class="title-menu">
                                    <span>Chính sách</span>
                                </h4>

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-4">
                            <div class="widget-ft">
                                <h4 class="title-menu">
                                    <span>Hướng dẫn</span>
                                </h4>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-footer-bottom copyright clearfix">
                <div class="container">
                    <div class="inner clearfix">
                        <div class="row tablet">
                            <div id="copyright" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 a-left fot_copyright">
                                <span class="wsp">
                                    <span class="mobile">{{ $setting->options['copyright'] ?? '' }}
                                        <span class="hidden-xs"> | </span>
                                    </span>
                                    <span class="opacity1">Design by</span>
                                    <a href="http://facebook.com/nguyenchibao212002" rel="nofollow" title="Sapo"
                                        target="_blank">Shino</a>
                                </span>

                                <a href="#" class="backtop pc hidden-xs show" title="Lên đầu trang">Lên đầu trang
                                    <i class="fa fa-arrow-circle-up" aria-hidden="true"></i></a>

                            </div>

                        </div>
                    </div>

                    <a href="#" class="backtop hidden-lg hidden-md hidden-sm show" title="Lên đầu trang"><i
                            class="fa fa-angle-up" aria-hidden="true"></i></a>

                </div>
            </div>
        </div>
    </footer>
</section>
