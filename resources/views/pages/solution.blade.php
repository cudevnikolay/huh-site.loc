@extends('layouts.app')

@section('title'){{ __('meta.solution_title') }}@endsection

@section('description'){{ __('meta.solution_description') }}@endsection

@section('content')
    <!-- Head Section -->
    <section class="page-section bg-light-alfa-30 pt-140" data-background="{{ asset('images/full-width-images/section-bg-5.jpg') }}">
        <div class="relative container align-left">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="hs-line-11 font-alt mb-20 mb-xs-0">{{ __('solution.title') }}</h1>
                    <div class="hs-line-4 font-alt black">
                        {{ __('solution.description') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Head Section -->
    <!-- Section -->
    @if (!empty($solutions['global']) && count($solutions['global']))
        <section class="page-section">
            <div class="container relative">
                <h2 class="section-title font-alt mb-70 mb-sm-40">
                    {{ __('solution.global_solutions_title') }}
                </h2>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="section-text align-center mb-70 mb-xs-40">
                            {{ __('solution.global_solutions_description') }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($solutions['global'] as $index => $solution)
                        <!-- Team item -->
                        <div class="col-sm-4 mb-xs-30 wow fadeInUp" data-wow-delay="0.{{ $index }}s">
                            <div class="team-item">
                                <div class="team-item-image">
                                    <img src="{{ \App\Helpers\ImageHelper::getUrl($solution->image, 'solution') }}" alt="{{ $solution->title }}" />

                                    <div class="team-item-detail">
                                        <p>
                                            {{ $solution->text }}
                                        </p>
                                    </div>
                                </div>
                                <div class="team-item-descr font-alt pb-20">
                                    <div class="team-item-name">
                                        {{ $solution->title }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Team item -->
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- End Section -->
    <!-- Section -->
    @if (!empty($solutions['industries']) && count($solutions['industries']))
        <section class="page-section">
            <div class="container relative">
                <h2 class="section-title font-alt mb-70 mb-sm-40">
                    {{ __('solution.industries_solutions_title') }}
                </h2>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="section-text align-center mb-70 mb-xs-40">
                            {{ __('solution.industries_solutions_description') }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($solutions['industries'] as $index => $solution)
                        <!-- Team item -->
                        <div class="col-sm-4 mb-xs-30 wow fadeInUp" data-wow-delay="0.{{ $index }}s">
                            <div class="team-item">
                                <div class="team-item-image">
                                    <img src="{{ \App\Helpers\ImageHelper::getUrl($solution->image, 'solution') }}" alt="{{ $solution->title }}" />

                                    <div class="team-item-detail">
                                        <p>
                                            {{ $solution->text }}
                                        </p>
                                    </div>
                                </div>
                                <div class="team-item-descr font-alt">
                                    <div class="team-item-name">
                                        {{ $solution->title }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Team item -->
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- End Section -->
    <!-- Section -->
    @if (!empty($solutions['languages']) && count($solutions['languages']))
        <section class="page-section">
            <div class="container relative">
                <h2 class="section-title font-alt mb-70 mb-sm-40">
                    {{ __('solution.languages_solutions_title') }}
                </h2>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="section-text align-center mb-70 mb-xs-40">
                            {{ __('solution.languages_solutions_description') }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($solutions['languages'] as $index => $solution)
                        <!-- Team item -->
                        <div class="col-sm-4 mb-xs-30 wow fadeInUp" data-wow-delay="0.{{ $index }}s">
                            <div class="team-item">
                                <div class="team-item-image">
                                    <img src="{{ \App\Helpers\ImageHelper::getUrl($solution->image, 'solution') }}" alt="{{ $solution->title }}" />

                                    <div class="team-item-detail">
                                        <p>
                                            {{ $solution->text }}
                                        </p>
                                    </div>
                                </div>
                                <div class="team-item-descr font-alt">
                                    <div class="team-item-name">
                                        {{ $solution->title }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Team item -->
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- End Section -->
    <!-- Call Action Section -->
    <section class="small-section bg-dark">
        <div class="container relative">
            <div class="align-center">
                <h3 class="banner-heading font-alt">{{ __('solution.contact_block_title') }}</h3>
                <div>
                    <a href="{{ route('contact') }}" class="btn btn-mod btn-w btn-medium btn-round">
                        {{ __('solution.contact_block_button') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End Call Action Section -->
@endsection