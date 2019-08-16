@extends('layouts.app')

@section('title'){{__('meta.training_title')}}@endsection

@section('description'){{__('meta.training_description')}}@endsection

@section('content')
    <!-- Alternative Services Section -->
    <section class="page-section pt-140">
        <div class="container relative">
            <div class="row">
                <div class="col-md-8 offset-md-2 col-lg-8 offset-lg-2 align-center">
                    <h1 class="font-alt mb-70 mb-sm-40 blog-item-title">{{ __('training.title') }}</h1>
                    <div class="section-text mb-80 mb-xs-40">
                        {{ __('training.description') }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="alt-service-wrap">
                        <div class="alt-service-item">
                            <div class="alt-service-icon">
                                <i class="icon-cloud"></i>
                            </div>
                            <h3 class="alt-services-title font-alt">{{ __('training.item1_title') }}</h3>
                            {{ __('training.item1_text') }}
                        </div>
                    </div>
                    <div class="alt-service-wrap">
                        <div class="alt-service-item">
                            <div class="alt-service-icon">
                                <i class="icon-linegraph"></i>
                            </div>
                            <h3 class="alt-services-title font-alt">{{ __('training.item2_title') }}</h3>
                            {{ __('training.item2_text') }}
                        </div>
                    </div>
                    <div class="alt-service-wrap">
                        <div class="alt-service-item">
                            <div class="alt-service-icon">
                                <i class="icon-genius"></i>
                            </div>
                            <h3 class="alt-services-title font-alt">{{ __('training.item3_title') }}</h3>
                            {{ __('training.item3_text') }}
                        </div>
                    </div>
                    <div class="alt-service-wrap">
                        <div class="alt-service-item">
                            <div class="alt-service-icon">
                                <i class="icon-shield"></i>
                            </div>
                            <h3 class="alt-services-title font-alt">{{ __('training.item4_title') }}</h3>
                            {{ __('training.item4_text') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 hidden-xs hidden-sm">
                    <div class="alt-services-image">
                        <img src="{{ asset('images/promo-2.png') }}" alt="" />
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="alt-service-wrap">
                        <div class="alt-service-item">
                            <div class="alt-service-icon">
                                <i class="icon-hotairballoon"></i>
                            </div>
                            <h3 class="alt-services-title font-alt">{{ __('training.item5_title') }}</h3>
                            {{ __('training.item5_text') }}
                        </div>
                    </div>
                    <div class="alt-service-wrap">
                        <div class="alt-service-item">
                            <div class="alt-service-icon">
                                <i class="icon-search"></i>
                            </div>
                            <h3 class="alt-services-title font-alt">{{ __('training.item6_title') }}</h3>
                            {{ __('training.item6_text') }}
                        </div>
                    </div>
                    <div class="alt-service-wrap">
                        <div class="alt-service-item">
                            <div class="alt-service-icon">
                                <i class="icon-streetsign"></i>
                            </div>
                            <h3 class="alt-services-title font-alt">{{ __('training.item7_title') }}</h3>
                            {{ __('training.item7_text') }}
                        </div>
                    </div>
                    <div class="alt-service-wrap">
                        <div class="alt-service-item">
                            <div class="alt-service-icon">
                                <i class="icon-tools-2"></i>
                            </div>
                            <h3 class="alt-services-title font-alt">{{ __('training.item8_title') }}</h3>
                            {{ __('training.item8_text') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Alternative Services Section -->
@endsection