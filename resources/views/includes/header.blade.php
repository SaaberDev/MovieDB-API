<header class="site-header">
    <div class="container">
        <a href="{{ route('guest.home') }}" id="branding">
            <img src="{{ asset('_assets/images/logo.png') }}" alt="" class="logo">
            <div class="logo-copy">
                <h1 class="site-title">MovieTalk</h1>
                <small class="site-description">{{ strtoupper('Your favourite movie dairy') }}</small>
            </div>
        </a> <!-- #branding -->

        <div class="main-navigation">
            <button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
            <ul class="menu">
                @include('includes.navbar')
            </ul> <!-- .menu -->

{{--            @include('includes.search')--}}
        </div> <!-- .main-navigation -->

        <div class="mobile-navigation"></div>
    </div>

    @include('includes.modals.movie_detail')
</header>
