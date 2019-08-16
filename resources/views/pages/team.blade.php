@extends('layouts.app')

@section('title'){{ __('meta.team_title') }}@endsection

@section('description'){{ __('meta.team_description') }}@endsection

@section('content')
    <!-- Head Section -->
    <section class="small-section bg-gray-lighter">
        <div class="relative container align-left">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="hs-line-11 font-alt mb-20 mb-xs-0">{{ __('team.title') }}</h1>
                    <div class="hs-line-4 font-alt black">
                        {{ __('team.description') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Head Section -->
    <!-- Section -->
    <section class="page-section" id="about">
        <div class="container relative">
            <h2 class="section-title font-alt mb-70 mb-sm-40">
                {{ __('team.sub_title') }}
            </h2>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="section-text align-center mb-70 mb-xs-40">
                        {{ __('team.sub_description') }}
                    </div>
                </div>
            </div>
            <div class="row multi-columns-row">
                <div class="col-sm-6 col-md-3 col-lg-3 mb-md-30 wow fadeInUp" data-wow-delay="0">
                    <div class="team-item">
                        <div class="team-item-image">
                            <img src="{{ asset('images/stub-2.jpg') }}" alt="" />
                            <div class="team-item-detail">
                                <h4 class="font-alt normal">Nice to meet!</h4>
                                <p>
                                    Curabitur augue, nec finibus mauris pretium eu. Duis placerat ex gravida nibh tristique porta.
                                </p>
                                <div class="team-social-links">
                                    <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                                    <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                                    <a href="#" target="_blank"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="team-item-descr font-alt">
                            <div class="team-item-name">
                                Marta Laning
                            </div>
                            <div class="team-item-role">
                                Web engineer
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 mb-md-30 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="team-item-image">
                            <img src="{{ asset('images/stub-2.jpg') }}" alt="" />
                            <div class="team-item-detail">
                                <h4 class="font-alt normal">Nice to meet!</h4>
                                <p>
                                    Curabitur augue, nec finibus mauris pretium eu. Duis placerat ex gravida nibh tristique porta.
                                </p>
                                <div class="team-social-links">
                                    <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                                    <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                                    <a href="#" target="_blank"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="team-item-descr font-alt">
                            <div class="team-item-name">
                                Marta Laning
                            </div>
                            <div class="team-item-role">
                                Web engineer
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 mb-md-30 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="team-item">
                        <div class="team-item-image">
                            <img src="{{ asset('images/stub-2.jpg') }}" alt="" />
                            <div class="team-item-detail">
                                <h4 class="font-alt normal">Whats Up!</h4>
                                <p>
                                    Adipiscing elit curabitur eu&nbsp;adipiscing lacus eu&nbsp;adipiscing lacus, a&nbsp;iaculis diam.
                                </p>
                                <div class="team-social-links">
                                    <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                                    <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                                    <a href="#" target="_blank"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="team-item-descr font-alt">
                            <div class="team-item-name">
                                Steve ANDERS
                            </div>
                            <div class="team-item-role">
                                Developer
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 mb-md-30 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item">
                        <div class="team-item-image">
                            <img src="{{ asset('images/stub-2.jpg') }}" alt="" />
                            <div class="team-item-detail">
                                <h4 class="font-alt normal">Hi to all!</h4>
                                <p>
                                    Adipiscing elit curabitur eu&nbsp;adipiscing lacus eu&nbsp;adipiscing lacus, a&nbsp;iaculis diam.
                                </p>
                                <div class="team-social-links">
                                    <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                                    <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                                    <a href="#" target="_blank"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="team-item-descr font-alt">
                            <div class="team-item-name">
                                Emma Connor
                            </div>
                            <div class="team-item-role">
                                Creative Director
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->
@endsection