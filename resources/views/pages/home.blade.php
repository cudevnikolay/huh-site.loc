@extends('layouts.app')

@section('title'){{__('meta.home_title')}}@endsection

@section('description'){{__('meta.home_description')}}@endsection

@section('content')
    <section class="home-section bg-gray parallax-2" data-background="{{ asset('images/full-width-images/section-bg-5.jpg') }}" id="home">
        <div class="js-height-full">
            <div class="home-content container">
                <div class="home-text">
                    <h1 class="hs-line-11 font-alt mb-50 mb-xs-30">
                        {{ __('home.h1_high_usage_hub') }}
                    </h1>
                    <h2 class="hs-line-11 font-alt mb-50 mb-xs-30">
                        {{ __('home.h2_transformation_made_inclusive') }}
                    </h2>
                    <div class="local-scroll">
                        <a href="{{ route('team') }}" class="btn btn-mod btn-medium btn-round hidden-xs">{{ __('home.button_our_teams') }}</a>
                        <span class="hidden-xs">&nbsp;</span>
                        <a href="{{ route('solution') }}" class="btn btn-mod btn-medium btn-round lightbox mfp-iframe">{{ __('home.button_our_solutions') }}</a>
                    </div>
                </div>
            </div>
            <div class="local-scroll">
                <a href="#platform" class="scroll-down"><i class="fa fa-angle-down scroll-down-icon"></i></a>
            </div>
        </div>
    </section>
    <!-- About Section -->
    <section class="page-section" id="platform">
        <div class="container relative">
            <h2 class="section-title font-alt align-left mb-70 mb-sm-40">
                {{ __('home.block_platform_title') }}
            </h2>
            <div class="section-text">
                <div class="row">
                    <div class="col-md-4 mb-sm-50 mb-xs-30">
                        <img src="images/mobile-app.png" />
                    </div>
                    <div class="col-md-4 col-sm-6 mb-sm-50 mb-xs-30">
                        {{ __('home.block_platform_sub_text1') }}
                    </div>
                    <div class="col-md-4 col-sm-6 mb-sm-50 mb-xs-30">
                        {{ __('home.block_platform_sub_text2') }}

                        <div class="hs-line-11 text-center pt-3">
                            <a href="{{ route('platform') }}" class="section-more">
                                {{ __('home.block_platform_learn_mere') }}
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Section -->
    <section class="page-section bg-dark-alfa-50 parallax-3" data-background="images/full-width-images/our-team.jpg">
        <div class="relative container align-left">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="hs-line-11 font-alt mb-20 mb-xs-0">{{ __('home.block_team_title') }}</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="page-section">
        <div class="container relative">
            <div class="row">
                <div class="col-md-12 section-title font-alt">
                    <a href="{{ route('team') }}" class="section-more section-team-more right">
                        {{ __('home.block_team_learn_mere') }}
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="container relative">
            <div class="section-text mb-50 mb-sm-20">
                <div class="row">
                    <div class="col-md-4 col-sm-6 mb-sm-50 mb-xs-30">
                        {{ __('home.block_team_sub_text1') }}
                    </div>

                    <div class="col-md-4 col-sm-6 mb-sm-50 mb-xs-30">
                        {{ __('home.block_team_sub_text2') }}
                    </div>

                    <div class="col-md-4 col-sm-6 mb-sm-50 mb-xs-30">
                        {{ __('home.block_team_sub_text3') }}
                    </div>

                </div>
            </div>
        </div>
    </section>

    <hr class="mt-0 mb-0 ">

    <!-- Section -->
    <section class="page-section" id="our-team">
        <div class="container relative">
            <h2 class="section-title font-alt mb-70 mb-sm-40">
                {{ __('home.block_our_solutions_title') }}
            </h2>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="section-text align-center mb-70 mb-xs-40">
                        {{ __('home.block_our_solutions_sub_text') }}
                    </div>
                </div>
            </div>
            @if ($team)
                <div class="row multi-columns-row">
                    @foreach ($team as $index => $member)
                        <div class="col-sm-6 col-md-3 col-lg-3 mb-md-30 wow fadeInUp" data-wow-delay="0.{{ $index }}s">
                            <div class="team-item">
                                <div class="team-item-image">
                                    <img src="{{ \App\Helpers\ImageHelper::getUrl($member->image, 'team') }}" alt="{{ $member->name }}" />
                                    {{--<div class="team-item-detail">
                                        <h4 class="font-alt normal">Nice to meet!</h4>
                                        <p>
                                            Curabitur augue, nec finibus mauris pretium eu. Duis placerat ex gravida nibh tristique porta.
                                        </p>
                                        <div class="team-social-links">
                                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                                            <a href="#" target="_blank"><i class="fa fa-pinterest"></i></a>
                                        </div>
                                    </div>--}}
                                </div>
                                <div class="team-item-descr font-alt">
                                    <div class="team-item-name">
                                        {{ $member->name }}
                                    </div>
                                    <div class="team-item-role">
                                        {{ $member->position }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="align-center pt-4">
                    <a href="{{ route('solution') }}" class="section-more font-alt link-more">
                        {{ __('home.block_our_solutions_learn_mere') }}
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>
    <!-- End Section -->
    <!-- Call Action Section -->
    <section class="page-section pt-0 pb-0 banner-section bg-dark" data-background="images/full-width-images/section-bg-2.jpg">
        <div class="container relative">
            <div class="row">
                <div class="col-sm-4">
                    <div class="mt-140 mt-lg-80 mb-140 mb-lg-80">
                        <div class="banner-content">
                            <h3 class="banner-heading font-alt">{{ __('home.block_awards_title') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 wow fadeInUp">
                    <div class="row">
                        <div class="col-sm-6">
                            <img src="{{ asset('static/image/awards/awards-1.png') }}">
                        </div>
                        <div class="col-sm-6">
                            <img src="{{ asset('static/image/awards/awards-2.png') }}">
                        </div>
                        <div class="col-sm-6">
                            <img src="{{ asset('static/image/awards/awards-3.png') }}">
                        </div>
                        <div class="col-sm-6">
                            <img src="{{ asset('static/image/awards/awards-4.png') }}">
                        </div>
                        <div class="col-sm-6">
                            <img src="{{ asset('static/image/awards/awards-5.png') }}">
                        </div>
                        <div class="col-sm-6">
                            <img src="{{ asset('static/image/awards/awards-6.png') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Call Action Section -->
    <!-- Section -->
    <section class="page-section">
        <div class="container relative">
            <div class="row">
                <div class="col-md-5 col-lg-4 mb-sm-40">
                    <!-- About Project -->
                    <div class="text">
                        <h3 class="font-alt mb-30 mb-xxs-10">{{ __('home.block_ia_solutions_title') }}</h3>
                        <p>
                            {{ __('home.block_ia_solutions_sub_text') }}
                        </p>
                        <div class="mt-40">
                            <a href="{{ route('ia-solution') }}" class="btn btn-mod btn-border btn-round btn-medium">
                                {{ __('home.block_ia_solutions_learn_more') }}
                            </a>
                        </div>
                    </div>
                    <!-- End About Project -->
                </div>
                <div class="col-md-7 offset-lg-1">
                    <!-- Work Gallery -->
                    <div class="work-full-media mt-0 white-shadow wow fadeInUp">
                        <img src="images/promo-4.png" alt="" />
                    </div>
                    <!-- End Work Gallery -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->

    <!-- Section -->
    <section class="page-section bg-gray-lighter">
        <div class="container relative">
            <div class="row">
                <div class="col-md-7 mb-sm-40">
                    <img src="images/promo-3.png" alt="" />
                </div>
                <div class="col-md-5 col-lg-4 offset-lg-1">
                    <!-- About Project -->
                    <div class="text">
                        <h3 class="font-alt mb-30 mb-xxs-10">{{ __('home.block_training_title') }}</h3>
                        <p>
                            {{ __('home.block_training_sub_text') }}
                        </p>
                        <div class="mt-40">
                            <a href="{{ route('training') }}" class="btn btn-mod btn-border btn-round btn-medium">
                                {{ __('home.block_training_learn_more') }}
                            </a>
                        </div>
                    </div>
                    <!-- End About Project -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->

    <!-- Testimonials Section -->
    @if ($quotes)
        <section class="page-section bg-dark bg-dark-alfa-90 fullwidth-slider" data-background="{{ asset('images/full-width-images/section-bg-2.jpg') }}">
            @foreach ($quotes as $quote)
                <!-- Slide Item -->
                <div>
                    <div class="container relative">
                        <div class="row">
                            <div class="col-md-8 offset-md-2 align-center">
                                <div class="section-icon">
                                    <span class="icon-quote"></span>
                                </div>
                                <h3 class="small-title font-alt">{{ $quote->title }}</h3>
                                <blockquote class="testimonial white">
                                    <p>
                                        {{ $quote->text }}
                                    </p>
                                    <footer class="testimonial-author">
                                        {{ $quote->author }}
                                    </footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Slide Item -->
            @endforeach
            {{--<div class="container relative">
                <div class="row">
                    <div class="col-md-8 offset-md-2 align-center">
                        <div class="section-icon">
                            <span class="icon-quote"></span>
                        </div>
                        <h3 class="small-title font-alt">{{ __('home.block_confiances_title') }}</h3>
                        <blockquote class="testimonial white">
                            <p>
                                {{ __('home.block_confiances_sub_text') }}
                            </p>
                        </blockquote>
                    </div>
                </div>
            </div>--}}
        </section>
    @endif
    <!-- End Testimonials Section -->

    <!-- Contact Section -->
    <section class="page-section" id="contact">
        <div class="container relative">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="section-text align-center mb-70 mb-xs-40">
                        {{ __('home.block_contact_description') }}
                    </div>
                </div>
            </div>
            <div class="row mb-60 mb-xs-40">
                <div class="col-md-8 offset-md-2">
                    <div class="row">
                        <div class="col-sm-6 col-lg-4 pt-20 pb-20 pb-xs-0">
                            <div class="contact-item">
                                <div class="ci-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="ci-title font-alt">
                                    {{ __('home.block_contact_phone') }}
                                </div>
                                <div class="ci-text">
                                    01 82 88 82 49
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 pt-20 pb-20 pb-xs-0">
                            <div class="contact-item">
                                <div class="ci-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="ci-title font-alt">
                                    {{ __('home.block_contact_address_french') }}
                                </div>
                                <div class="ci-text">
                                    36 rue de Cléry 75002 Paris
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 pt-20 pb-20 pb-xs-0">
                            <div class="contact-item">
                                <div class="ci-icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="ci-title font-alt">
                                    {{ __('home.block_contact_address_germany') }}
                                </div>
                                <div class="ci-text">
                                    33 avenue Pierre Brossolette 94000 Créteil
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Contact Form -->
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form class="form contact-form" id="contact_form">
                        <div class="clearfix">
                            <div class="cf-left-col">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="input-md round form-control" placeholder="{{ __('home.block_contact_name') }}" pattern=".{3,100}" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="input-md round form-control" placeholder="{{ __('home.block_contact_email') }}" pattern=".{5,100}" required>
                                </div>
                            </div>
                            <div class="cf-right-col">
                                <div class="form-group">
                                    <textarea name="message" id="message" class="input-md round form-control" style="height: 84px;" placeholder="{{ __('home.block_contact_message') }}"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="cf-left-col">
                                <div class="form-tip">
                                    <div class="g-recaptcha" data-sitekey="{{ config('app.google_reCaptcha_key') }}"></div>
                                </div>
                            </div>
                            <div class="cf-right-col">
                                <div class="align-right pt-20">
                                    <button class="submit_btn btn-mod btn-medium btn-round" id="submit_btn">{{ __('home.block_contact_button') }}</button>
                                </div>
                            </div>
                        </div>
                        <div id="result"></div>
                    </form>
                </div>
            </div>
            <!-- End Contact Form -->
        </div>
    </section>
    <!-- End Contact Section -->
@endsection

@section('js_includes')
    <script src="{{ asset('js/theme/contact-form.js') }}"></script>
    <script src="{{ asset('js/theme/jquery.ajaxchimp.min.js') }}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
