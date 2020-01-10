@include('partials.post-filters')

@if (!$hideTitle && !empty($post_title))
<h4 class="box-title">{!! apply_filters('the_title', $post_title) !!}</h4>
@endif
<section class="protocols start-page-protocols">
    <div class="container">
        <div class="grid grid--columns" data-equal-container>
            <div class="start-page-ctas">
                    <a href="{{ home_url() }}/protocol" class="btn-oval btn-full">
                        <span><?php _e('View all posts', 'elevroden'); ?></span>
                    </a>
                    @if (is_user_logged_in())
                        <a href="{{ home_url() }}/create-protocol" class="btn-oval btn-full">
                            <i class="pricon pricon-plus"></i>
                            <span><?php _e('Write a new post', 'elevroden'); ?></span>
                        </a>
                    @endif
            </div>

            @if (count($posts) > 0)
                @foreach ($posts as $post)
                    {{-- <div class="{{ $posts_columns }}"> --}}
                    <div class="u-flex grid-xs-12 grid-sm-12 grid-md-4 grid-lg-3">
                        <a href="{{ $posts_data_source === 'input' ? $post->permalink : get_permalink($post->ID) }}" class="card">
                            <div class="card-body">
                                @if (in_array('title', $posts_fields))
                                <h5 class="card-title">{!! apply_filters('the_title', $post->post_title) !!}</h5>
                                @endif

                                

                                @if (get_current_user_id() == get_post_field('post_author', $post->ID))
                                    <object>
                                        <a href="{{ $posts_data_source === 'input' ? $post->permalink . '#modal-edit-post' : get_permalink($post->ID) . '#modal-edit-post' }}" class="card-edit-btn">
                                            <i class="pricon pricon-pen pricon-pen-white"></i>
                                        </a>
                                    </object>
                                @endif

                                <div class="card-info">
                                    <span class="card-small-text">{{ get_post_meta($post->ID)["name_of_council_or_politician"][0] }}</span>
                                    <br>
                                    @if (in_array('date', $posts_fields) && $posts_data_source !== 'input')
                                        <time class="card-small-text">{{ apply_filters('Modularity/Module/Posts/Date', get_the_time('Y-m-d', $post->ID), $post->ID, $post->post_type)  }}</time>
                                    @endif
                                    
                                    <object><a href="{{ $posts_data_source === 'input' ? $post->permalink . '#comments': get_permalink($post->ID) . '#comments'}}" class="card-small-text card-comments-link"> Comments ({{ apply_filters('Modularity/Module/Posts/commentCount', $post->ID) }})</a></object>
                                    
                                </div>

                                @if (in_array('excerpt', $posts_fields))
                                    @if ($posts_data_source === 'input')
                                        {!! $post->post_content !!}
                                    @else
                                        <p>{!! isset(get_extended($post->post_content)['main']) ? apply_filters('the_excerpt', wp_trim_words(wp_strip_all_tags(get_extended($post->post_content)['main']), 30, null)) : '' !!}</p>
                                    @endif
                                @endif

                            </div>
                        </a>
                    </div>
                @endforeach
            @else

                <div class="grid-md-12">
                    <?php _e('No posts to show…', 'modularity'); ?>
                </div>

            @endif
        </div>
    </div>
</section>
