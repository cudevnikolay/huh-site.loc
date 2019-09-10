<!-- Navigation panel -->
<nav class="main-nav transparent stick-fixed">
    <div class="full-wrapper relative clearfix">
        <div class="nav-logo-wrap local-scroll">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="" />
            </a>
        </div>
        <div class="mobile-nav">
            <i class="fa fa-bars"></i>
        </div>

        <!-- Main Menu -->
        <div class="inner-nav desktop-nav">
            <ul class="clearlist">
                <li>
                    <a href="{{ route('platform') }}">{{ __('menu.item_platform') }}</a>
                </li>
                <li>
                    <a href="{{ route('solution') }}">{{ __('menu.item_our_solutions') }}</a>
                </li>
                {{--<li>
                    <a href="{{ route('team') }}">{{ __('menu.item_teams') }}</a>
                </li>--}}
                <li>
                    <a href="{{ route('training') }}">{{ __('menu.item_training') }}</a>
                </li>
                <li>
                    <a href="{{ route('ia-solution') }}">{{ __('menu.item_ia_solution') }}</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}">{{ __('menu.item_contact') }}</a>
                </li>
                <li><a>&nbsp;</a></li>
                <li>
                    <a href="#" class="mn-has-sub">
                        {{ $currentLanguage['name'] }}
                        @if(count($altLocalizedUrls) > 1)
                            <i class="fa fa-angle-down"></i>
                        @endif
                    </a>
                    @if(count($altLocalizedUrls) > 1)
                        <ul class="mn-sub">
                            @foreach($altLocalizedUrls as $locale)
                            <li><a href="{{ $locale['url'] }}">{{$locale['name']}}</a></li>
                            @endforeach
                        </ul>
                    @endif

                </li>
                <!-- End Languages -->
            </ul>
        </div>
        <!-- End Main Menu -->
    </div>
</nav>
<!-- End Navigation panel -->