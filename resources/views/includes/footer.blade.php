<footer class="page-section bg-gray-lighter footer pb-60">
    <div class="container">
        <!-- Footer Widgets -->
        <div class="row align-left">
            <div class="col-sm-6 col-md-3">
                <div class="widget">
                    <h5 class="widget-title font-alt">{{ __('footer.about_block_title') }}</h5>
                    <div class="widget-body">
                        <div class="widget-text text-justify clearfix">
                            {{ __('footer.about_block_text') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget">
                    <h5 class="widget-title font-alt">{{ __('footer.links_block_title') }}</h5>
                    <div class="widget-body">
                        <ul class="clearlist widget-menu">
                            <li>
                                <a href="{{ route('platform') }}" title="">{{ __('footer.links_block_item1') }}<i class="fa fa-angle-right right"></i></a>
                            </li>
                            <li>
                                <a href="{{ route('solution') }}" title="">{{ __('footer.links_block_item2') }} <i class="fa fa-angle-right right"></i></a>
                            </li>
                            <li>
                                <a href="{{ route('training') }}" title="">{{ __('footer.links_block_item3') }} <i class="fa fa-angle-right right"></i></a>
                            </li>
                            <li>
                                <a href="{{ route('ia-solution') }}" title="">{{ __('footer.links_block_item4') }} <i class="fa fa-angle-right right"></i></a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget">
                    <h5 class="widget-title font-alt">{{ __('footer.new_block_title') }}</h5>
                    <div class="widget-body">
                        <ul class="clearlist widget-posts">
                            <li class="clearfix">
                                <div class="widget-posts-descr">
                                    <a href="#" title="">{{ __('footer.new_block_item1') }}</a>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="widget-posts-descr">
                                    <a href="#" title="">{{ __('footer.new_block_item2') }}</a>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="widget-posts-descr">
                                    <a href="#" title="">{{ __('footer.new_block_item3') }}</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget">
                    <h5 class="widget-title font-alt">{{ __('footer.newsletter_block_title') }}</h5>
                    <div class="widget-body">
                        <div class="widget-text clearfix">
                            <form class="form" id="mailchimp">
                                <div class="mb-20">{{ __('footer.newsletter_block_text') }}</div>
                                <div class="mb-20">
                                    <input placeholder="{{ __('footer.newsletter_block_email') }}" class="form-control input-md round mb-10" type="email" pattern=".{5,100}" required/>
                                    <button type="submit" class="btn btn-mod btn-gray btn-medium btn-round form-control mb-xs-10">{{ __('footer.newsletter_block_button') }}</button>
                                </div>
                                <div id="subscribe-result"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Widgets -->
        <hr class="mt-0 mb-80 mb-xs-40"/>
        <!-- Footer Logo -->
        <div class="local-scroll mb-30 wow fadeInUp" data-wow-duration="1.5s">
            <a href="#top">
                <img src="{{ asset('images/logo-footer.png') }}" width="78" height="36" alt="" />
            </a>
        </div>
        <!-- End Footer Logo -->
        <!-- Social Links -->
        <div class="footer-social-links mb-110 mb-xs-60">
            @foreach ($socialLinks as $socialLink)
                @if ($socialLink['link'])
                    <a href="{{ $socialLink['link'] }}" title="{{ ucfirst($socialLink['alias']) }}" target="_blank">
                        <i class="fa fa-{{ $socialLink['alias'] }}"></i>
                    </a>
                @endif
            @endforeach
        </div>
        <!-- End Social Links -->
    </div>
    <!-- Top Link -->
    <div class="local-scroll">
        <a href="#top" class="link-to-top"><i class="fa fa-caret-up"></i></a>
    </div>
    <!-- End Top Link -->
</footer>