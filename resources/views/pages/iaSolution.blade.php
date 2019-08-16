@extends('layouts.app')

@section('title'){{ __('meta.ia_solution_title') }}@endsection

@section('description'){{ __('meta.ia_solution_description') }}@endsection

@section('content')
    <!-- Split Section -->
    <section class="split-section bg-gray-lighter pt-120">
        <div class="clearfix container relative">
            <div class="split-section-headings right">
                <div class="ssh-table">
                    <div class="ssh-cell page-section bg-scroll" data-background="{{ asset('images/full-width-images/section-bg-2.jpg') }}"></div>
                </div>
            </div>
            <div class="split-section-content">
                <div class="pr-4 left">
                    <div class="text">
                        <h1 class="font-alt mt-0 mb-50 mb-xxs-20 blog-item-title">{{ __('ia_solution.title') }}</h1>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="alt-service-item mt-0 mb-20">
                                    <div class="alt-service-icon">
                                        <i class="icon-globe"></i>
                                    </div>
                                    <h3 class="alt-services-title font-alt">{{ __('ia_solution.top_block_item1_title') }}</h3>
                                    {{ __('ia_solution.top_block_item1_text') }}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="alt-service-item mt-0 mb-20">
                                    <div class="alt-service-icon">
                                        <i class="icon-strategy"></i>
                                    </div>
                                    <h3 class="alt-services-title font-alt">{{ __('ia_solution.top_block_item2_title') }}</h3>
                                    {{ __('ia_solution.top_block_item2_text') }}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="alt-service-item mt-0 mb-20">
                                    <div class="alt-service-icon">
                                        <i class="icon-adjustments"></i>
                                    </div>
                                    <h3 class="alt-services-title font-alt">{{ __('ia_solution.top_block_item3_title') }}</h3>
                                    {{ __('ia_solution.top_block_item3_text') }}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="alt-service-item mt-0 mb-20">
                                    <div class="alt-service-icon">
                                        <i class="icon-target"></i>
                                    </div>
                                    <h3 class="alt-services-title font-alt">{{ __('ia_solution.top_block_item4_title') }}</h3>
                                    {{ __('ia_solution.top_block_item4_text') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Split Section -->
    <!-- Section -->
    <section class="page-section pt-80">
        <div class="container relative">
            <div class="section-text mb-60 mb-sm-40">
                <div class="row">
                    <div class="col-sm-6 mb-sm-50 mb-xs-30">
                        <h4 class="mt-0 alt-features-title font-alt">{{ __('ia_solution.choose_block_sub1_title') }}</h4>
                        <p>
                            {{ __('ia_solution.choose_block_sub1_text') }}
                        </p>
                    </div>
                    <div class="col-sm-6 mb-sm-50 mb-xs-30">
                        <h4 class="mt-0 alt-features-title font-alt">{{ __('ia_solution.choose_block_sub1_title') }}</h4>
                        <p>
                            {{ __('ia_solution.choose_block_sub2_text') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->
@endsection