@if (get_field('nav_primary_enable', 'option') === true)
    <nav class="navbar navbar-mainmenu hidden-xs hidden-sm hidden-print {{ get_field('header_sticky', 'option') ? 'sticky-scroll' : '' }} {{ is_front_page() && get_field('header_transparent', 'option') ? 'navbar-transparent' : '' }}">
        <div class="container">
            <div class="grid">
                <div class="grid-sm-12 nav-flex">
                
                     {!! municipio_get_logotype('standard') !!}
                    <a href="{{ get_home_url() }}" class="logotype-text">
                        HELSINGBORG ELEVRÅD
                    </a>

                    {!! $navigation['mainMenu'] !!}

                    @include('partials.header.subnav')

                </div>
            </div>
        </div>
    </nav>

    <nav class="mobile-nav hidden-md hidden-lg">
        <div class="container">
            <div class="grid">
                <div class="grid-sm-12 nav-flex">
                    <div>
                        {!! municipio_get_logotype('standard') !!}
                        <a href="{{ get_home_url() }}" class="logotype-text">
                            HELSINGBORG
                            <br>
                            ELEVRÅD
                        </a>
                    </div>


                    @if (strlen($navigation['mobileMenu']) > 0)
                        <div class="grid-xs-6 grid-sm-6 text-right-sm text-right-xs {!! apply_filters('Municipio/mobile_menu_breakpoint','hidden-md hidden-lg'); !!}  u-hidden@xl">
                            @include('partials.header.subnav')
                            <a href="#mobile-menu" class="menu-trigger" data-target="#mobile-menu">
                                <span class="menu-icon"></span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    @if (strlen($navigation['mobileMenu']) > 0)
        <nav id="mobile-menu" class="nav-mobile-menu nav-toggle nav-toggle-expand {!! apply_filters('Municipio/mobile_menu_breakpoint','hidden-md hidden-lg'); !!} hidden-print">
            <div class="container">
                @include('partials.mobile-menu')
            </div>
        </nav>
    @endif
@endif
