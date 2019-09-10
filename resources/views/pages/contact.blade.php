@extends('layouts.app')

@section('title'){{ __('meta.contact_title') }}@endsection

@section('description'){{ __('meta.contact_description') }}@endsection

@section('content')
    <!-- Section -->
    <div class="container mt-140 mt-lg-60 mt-xs-40">
        <section class="page-section bg-scroll bg-dark-alfa-70" data-background="{{ asset('images/full-width-images/section-bg-5.jpg') }}">
            <div class="relative align-center">
                <h1 class="hs-line-11 font-alt mb-0">{{ __('contact.title') }}</h1>
            </div>
        </section>
    </div>
    <!-- End Section -->

    <!-- Contact Section -->
    <section class="page-section pt-70 pt-xs-40">
        <div class="container relative">
            <div class="row mb-60 mb-xs-40">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6 col-lg-3 pt-20 pb-20 pb-xs-0">
                            <div class="contact-item">
                                <div class="ci-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="ci-title font-alt">
                                    {{ __('contact.phone') }}
                                </div>
                                <div class="ci-text">
                                    {{ Setting::get('phone') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3 pt-20 pb-20 pb-xs-0">
                            <div class="contact-item">
                                <div class="ci-icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="ci-title font-alt">
                                    {{ __('contact.email') }}
                                </div>
                                <div class="ci-text">
                                    <svg class="notcopy" width="210px" height="22px"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <text x="0" y="14" font-size="16">{{ Setting::get('email') }}</text>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3 pt-20 pb-20 pb-xs-0">
                            <div class="contact-item">
                                <div class="ci-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="ci-title font-alt">
                                    {{ __('contact.address') }}
                                </div>
                                <div class="ci-text">
                                    {{ Setting::get('address_french') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3 pt-20 pb-20 pb-xs-0">
                            <div class="contact-item">
                                <div class="ci-icon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <div class="ci-title font-alt">
                                    {{ __('contact.worked_time') }}
                                </div>
                                <div class="ci-text">
                                    {{ Setting::get('worked_time') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 mb-xs-40">
                    <img src="{{ asset('images/contact.jpg') }}" width="100%" alt="" />
                </div>
                <div class="col-sm-6">
                    <form class="form contact-form" id="contact_form">
                        <div class="clearfix">
                            <div class="form-group">
                                <input type="text" name="name" id="name" class="input-md round form-control" placeholder="{{ __('contact.form_name') }}" pattern=".{3,100}" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" id="email" class="input-md round form-control" placeholder="{{ __('contact.form_email') }}" pattern=".{5,100}" required>
                            </div>
                            <div class="form-group">
                                <textarea name="message" id="message" class="input-md round form-control" style="height: 250px;" placeholder="{{ __('contact.form_message') }}"></textarea>
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
                                    <button class="submit_btn btn-mod btn-medium btn-round" id="submit_btn">{{ __('contact.form_button') }}</button>
                                </div>
                            </div>
                        </div>
                        <div id="result"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact Section -->
@endsection

@section('js_includes')
    <script src="{{ asset('js/theme/contact-form.js') }}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection