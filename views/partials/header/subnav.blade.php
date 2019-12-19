<nav class="subnav clearfix">
    <ul class="nav nav-horizontal">
        @if (is_user_logged_in())
            <li>
                <a href="#" data-dropdown=".login-dropdown">
                    @if (get_the_author_meta('user_profile_picture', get_current_user_id()))
                    <?php
                        $croppedProfileImage = \Municipio\Helper\Image::resize(get_the_author_meta('user_profile_picture', get_current_user_id()), 50, 50);
                    ?>
                    <span class="profile-image profile-image-icon inline-block" style="background-image:url('{{ $croppedProfileImage }}');"></span>
                    @else
                    <i class="pricon pricon-user-o pricon-lg hidden-md hidden-lg"></i>
                    @endif
                    <span class="hidden-sm hidden-xs">{{ get_the_author_meta('first_name', get_current_user_id()) }}</span> <i class="pricon pricon-caret-down pricon-xs"></i></span>
                </a>
                <ul class="dropdown-menu login-dropdown dropdown-menu-arrow dropdown-menu-arrow-right">

                    @if (is_object($unit) && !empty($unit) && isset($unit->path))
                        <li><a href="{{ home_url($unit->path) }}" class="pricon pricon-space-right pricon-home"><?php _e('Go to my intranet', 'municipio-intranet'); ?>
                            @if (isset($unit->short_name))
                                &#40;{{$unit->short_name}}&#41;
                            @endif
                        </a></li>
                    @endif

                    <li><a href="{{ wp_logout_url() }}" class="pricon pricon-space-right pricon-standby"><?php _e('Log out'); ?></a></li>
                </ul>
            </li>
        @else
            <li>
                <a href="#" data-dropdown=".login-dropdown" {!! isset($_GET['login']) && $_GET['login'] == 'failed' ? 'class="dropdown-open"' : '' !!}>
                    <?php _e('Log in'); ?> <i class="fa fa-caret-down"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-arrow-right login-dropdown" {!! isset($_GET['login']) && $_GET['login'] == 'failed' ? 'style="display: block;"' : '' !!}>
                    <div class="gutter">
                        @if (isset($_GET['login']) && $_GET['login'] == 'failed')
                        <div class="gutter gutter-bottom"><div class="notice notice-sm danger"><?php _e('Login failed. Please try again.', 'municipio-intranet'); ?></div></div>
                        @endif
                        @include('partials.user.loginform')
                    </div>
                </div>
            </li>
        @endif

        
    </ul>
</nav>
