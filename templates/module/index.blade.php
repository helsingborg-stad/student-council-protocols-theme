@include('partials.post-filters')

<div class="grid" data-equal-container>
    @if (!$hideTitle && !empty($post_title))
    <div class="grid-xs-12">
        <h4 class="box-title">{!! apply_filters('the_title', $post_title) !!}</h4>
    </div>
    @endif

    @foreach ($posts as $post)
        <?php 
        $postMeta = get_post_meta($post->ID);
        $targetGroup = $postMeta['target_group'][0]
        ?>
        @if($targetGroup == 'politician')
            <div class="{{ $posts_columns }}">
                <a href="{{ $posts_data_source === 'input' ? $post->permalink : get_permalink($post->ID) }}" class="c-card c-card--action">

                    @if ($post->thumbnail && in_array('image', $posts_fields))
                        <div class="c-card__image">
                            <?php if (isset($taxonomyDisplay['top'])) : foreach ($taxonomyDisplay['top'] as $taxonomy => $placement) : $terms = wp_get_post_terms($post->ID, $taxonomy); if (count($terms) > 0) : ?>
                                <ul class="tags-<?php echo $taxonomy; ?> pos-absolute-<?php echo $placement; ?>">
                                    <?php foreach ($terms as $term) : ?>
                                        <li class="tag tag-<?php echo $term->taxonomy; ?> tag-<?php echo $term->slug; ?>"><?php echo $term->name; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; endforeach; endif; ?>

                            <img src="{{ $post->thumbnail[0] }}" alt="{{ $post->post_title }}" class="box-image">
                        </div>
                    @endif

                    <div class="c-card__body">
                        @if (in_array('title', $posts_fields))
                        <h5 class="c-card__title">{{ apply_filters('the_title', $post->post_title) }}</h5>
                        @endif

                        <div class="c-card__sub">
                        @if (in_array('excerpt', $posts_fields))
                        {!! isset(get_extended($post->post_content)['main']) ? apply_filters('the_excerpt', wp_trim_words(wp_strip_all_tags(strip_shortcodes(get_extended($post->post_content)['main'])), 30, null)) : '' !!}
                        @endif
                        </div>
                    </div>

                    @if (isset($taxonomyDisplay['below']))
                        <div class="c-card__footer">
                        <?php foreach ($taxonomyDisplay['below'] as $taxonomy => $placement) : $terms = wp_get_post_terms($post->ID, $taxonomy); if (count($terms) > 0) : ?>
                        <ul class="tags tags-<?php echo $taxonomy; ?>">
                            <?php foreach ($terms as $term) : ?>
                                <li class="tag tag-<?php echo $term->taxonomy; ?> tag-<?php echo $term->slug; ?>"><?php echo $term->name; ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; endforeach; ?>
                        </div>
                    @endif
                </a>
            </div>
        @endif
    @endforeach

    @if ($posts_data_source !== 'input' && isset($archive_link) && $archive_link && $archive_link_url)
    <div class="grid-lg-12 u-text-center">
        <a class="btn btn-primary" href="{{ $archive_link_url }}?{{ http_build_query($filters) }}"><?php _e('Show more', 'modularity'); ?></a>
    </div>
    @endif
</div>
