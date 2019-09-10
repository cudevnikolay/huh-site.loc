@extends('layouts.app')

@section('title'){{ __('meta.platform_title') }}@endsection

@section('description'){{ __('meta.platform_description') }}@endsection

@section('content')
    <!-- Head Section -->
    <section class="small-section bg-gray-lighter pt-140">
        <div class="relative container align-left">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="hs-line-11 font-alt mb-20 mb-xs-0">
                        {{ __('platform.title') }}
                    </h1>
                    <div class="hs-line-4 font-alt black">
                        {{ __('platform.description') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Head Section -->

    <!-- Features Section -->
    <section class="page-section">
        <div class="container relative">
            <div class="row alt-features-grid mb-70 mb-xs-40">
                <div class="col-sm-3">
                    <div class="alt-features-item align-center">
                        <div class="alt-features-descr align-left">
                            <h4 class="mt-0 font-alt">{{ __('platform.description_block_title') }}</h4>
                            {{ __('platform.description_block_sub_text') }}
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="alt-features-item align-center">
                        <div class="alt-features-icon">
                            <span class="icon-phone"></span>
                        </div>
                        <h3 class="alt-features-title font-alt">{{ __('platform.description_block_mobile') }}</h3>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="alt-features-item align-center">
                        <div class="alt-features-icon">
                            <span class="icon-heart"></span>
                        </div>
                        <h3 class="alt-features-title font-alt">{{ __('platform.description_block_design') }}</h3>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="alt-features-item align-center">
                        <div class="alt-features-icon">
                            <span class="icon-chat"></span>
                        </div>
                        <h3 class="alt-features-title font-alt">{{ __('platform.description_block_chat') }}</h3>
                    </div>
                </div>
            </div>

            <hr class="mb-70 mb-xs-30"/>

            <div class="row multi-columns-row">
                <div class="col-sm-6 col-md-4 col-lg-4 mb-md-50 wow fadeIn" data-wow-delay="0.1s" data-wow-duration="2s">
                    <div class="post-prev-img">
                        <img src="{{ asset('images/high.png') }}" alt="" />
                    </div>
                    <div class="post-prev-title font-alt">
                        {{ __('platform.huh_block_high_title') }}
                    </div>
                    <div class="post-prev-text">
                        {{ __('platform.huh_block_high_text') }}
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4 mb-md-50 wow fadeIn" data-wow-delay="0.2s" data-wow-duration="2s">
                    <div class="post-prev-img">
                        <img src="{{ asset('images/usage.png') }}" alt="" />
                    </div>
                    <div class="post-prev-title font-alt">
                        {{ __('platform.huh_block_usage_title') }}
                    </div>
                    <div class="post-prev-text">
                        {{ __('platform.huh_block_usage_text') }}
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4 mb-md-50 wow fadeIn" data-wow-delay="0.3s" data-wow-duration="2s">
                    <div class="post-prev-img">
                        <img src="{{ asset('images/hub.png') }}" alt="" />
                    </div>
                    <div class="post-prev-title font-alt">
                        {{ __('platform.huh_block_hub_title') }}
                    </div>
                    <div class="post-prev-text">
                        {{ __('platform.huh_block_hub_text') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Features Section -->
    <!-- Call Action Section -->
    <section class="page-section pt-0 pb-0 banner-section bg-dark" data-background="#">
        <div class="container relative">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mt-140 mt-lg-80 mb-140 mb-lg-80">
                        <div class="banner-content">
                            <h3 class="banner-heading font-alt">
                                {{ __('platform.banner_block_title') }}
                            </h3>
                            <div class="banner-decription">
                                {{ __('platform.banner_block_text') }}
                            </div>
                            <div class="local-scroll">
                                <a href="#" class="btn btn-mod btn-w btn-medium btn-round">{{ __('platform.banner_block_button') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 banner-image wow fadeInUp">
                    <img src="{{ asset('images/platform-banner.png') }}" alt="" />
                </div>
            </div>
        </div>
    </section>
    <!-- End Call Action Section -->

    <!-- Section -->
    <section class="page-section">
        <div class="container relative">
            <div class="section-text mb-60 mb-sm-40">
                <div class="row">
                    <div class="col-sm-6 mb-sm-50 mb-xs-30">
                        <h4 class="mt-0 font-alt">{{ __('platform.choose_block_sub1_title') }}</h4>
                        <p>
                            {{ __('platform.choose_block_sub1_text') }}
                        </p>
                    </div>
                    <div class="col-sm-6 mb-sm-50 mb-xs-30">
                        <h4 class="mt-0 font-alt">{{ __('platform.choose_block_sub2_title') }}</h4>
                        <p>
                            {{ __('platform.choose_block_sub2_text') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->
@endsection