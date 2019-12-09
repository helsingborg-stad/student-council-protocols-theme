<div class="{{ $classes }} u-text-center s-card-highlight">
    @if (!$hideTitle && !empty($post_title))
        <div class="c-card" href="{{ get_permalink($post->ID) }}">
            <div class="c-card__body">
                <h4 class="box-title u-text-uppercase">
                    <i class="pricon pricon-star u-pr-1 hidden-md hidden-sm"></i>
                    <span class="u-text-secondary">{!! apply_filters('the_title', $post_title) !!}</span>
                    <i class="pricon pricon-star u-pl-1 hidden-md hidden-sm"></i>
                </h4>
            </div>
        </div>
    @endif

    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <a class="c-card" href="{{ get_permalink($post->ID) }}">
                <div class="c-card__body">
                    {{-- Date --}}
                    <div class="c-card__time u-mb-2">
                        <time>
                            @php $date = apply_filters('Modularity/Module/Posts/Date', get_the_time('Y-m-d', $post->ID), $post->ID, $post->post_type) @endphp
                            {{ mysql2date('j F Y', $date, true) . ', ' . mysql2date('H:i', $date, true) }}
                        </time>
                    </div>
                    {{-- Title --}}

                    @if (!empty($post->post_title))
                        <h4 class="c-card__title">{{ $post->post_title }}</h4>
                    @endif

                    {{-- Location --}}
                    @if (get_post_meta($post->ID, 'location', true))
                        <span class="c-card__sub o-text-small">
                        <?php $location = get_post_meta($post->ID, 'location', true); ?>
                            {{ $location['title'] }}
                        </span>
                    @endif
                </div>
            </a>
        @endforeach
    @else
        <div class="c-card">
            <div class="c-card__body">
                <?php _e('No posts to show…', 'modularity'); ?>
            </div>
        </div>
    @endif
</div>