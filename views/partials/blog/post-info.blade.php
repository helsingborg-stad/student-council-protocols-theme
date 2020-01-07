<div class="post-info">
    <div class="post-details">
        <div class="top-details">
            <a href="https://testintranat.helsingborg.se/user/{{ get_the_author_meta('nicename') }}" class="author-profile-link">
                <span class="post-author-name">
                    {{ get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name') }}
                </span>
            </a>
            <time class="post-date">
                @if (is_single())
                    {{ in_array(get_field('archive_' . sanitize_title(get_post_type()) . '_post_date_published', 'option'), array('datetime', 'date')) ? the_time(get_option('date_format')) : '' }}
                    {{ in_array(get_field('archive_' . sanitize_title(get_post_type()) . '_post_date_published', 'option'), array('datetime', 'time')) ? the_time(get_option('time_format')) : '' }}
                @else
                    {{ in_array(get_field('archive_' . sanitize_title(get_post_type()) . '_feed_date_published', 'option'), array('datetime', 'date')) ? the_time(get_option('date_format')) : '' }}
                    {{ in_array(get_field('archive_' . sanitize_title(get_post_type()) . '_feed_date_published', 'option'), array('datetime', 'time')) ? the_time(get_option('time_format')) : '' }}
                @endif
            </time>
            @if (comments_open() && get_option('comment_registration') == 0 || comments_open() && is_user_logged_in())
                <a href="{{ comments_link() }}" class="post-comments">
                    <span class="hidden-md hidden-lg"><i class="fa fa-lg fa-comments"></i> {{ comments_number('0', '1', '%') }}</span>
                    <span class="hidden-xs hidden-sm"><?php _e('Comments'); ?> ({{ comments_number('0', '1', '%') }})</span>
                </a>
            @endif
        </div>
        <div class="bottom-details">
            <span>
                <b><?php _e('Subjects', 'elevroden'); ?>: </b>
            </span>

            @foreach($settingItems['subjects'] as $subject)
                <a href="{{$settingItems->site_url}}/protocol?subject={{$subject}}" class="subject-link">{{$subject}}</a>
            @endforeach
        </div>
    </div>

    <div class="post-ctas">
        @if (is_user_logged_in())
            @if ($settingItems['currentUserId'] == $post->post_author)
                <a href="#modal-edit-post" class="btn-oval btn-dark-border">
                    <i class="pricon pricon-pen pricon-dark-pen"></i>
                    <span><?php _e('Edit post', 'elevroden'); ?></span>
                </a>
            @endif
            <a href="{{$settingItems->site_url}}/create-protocol" class="btn-oval btn-dark-border">
                <i class="pricon pricon-plus"></i>
                <span><?php _e('Write a new post', 'elevroden'); ?></span>
            </a>
        @endif
    </div>

</div>