<?php global $post; ?>
<div class="grid">
    <div class="grid-xs-12">
        <div class="post post-single">

            @include('partials.blog.post-header')

            @if ($settingItems['header_image'])
              <a class="header-image" style="
                        background-image: url({{$settingItems['site_url'] . '/wp-content' . explode('wp-content', $settingItems['header_image'])[1]}});
                        background-size: cover;
                        background-repeat: no-repeat;
                        background-position: center;
                      ">
              </a>
            @endif

            @if ($settingItems['gallery_images'])
              <ul class="image-gallery grid grid-gallery">
                @foreach ($settingItems['gallery_images'] as $gallery_image_url)
                  <li class="grid-md-3">
                    <a href="{{ $settingItems['site_url'] . '/wp-content' . explode('wp-content', $gallery_image_url)[1] }}" class="box lightbox-trigger"
                      style="
                        background-image: url({{$settingItems['site_url'] . '/wp-content' . explode('wp-content', $gallery_image_url)[1]}});
                        background-size: cover;
                        background-repeat: no-repeat;
                        background-position: center;
                      "
                    >
                    </a>
                  </li>
                @endforeach
              </ul>
            @endif

            @if (get_field('post_single_show_featured_image') === true)
                <img src="{{ municipio_get_thumbnail_source(null, array(700,700)) }}" alt="{{ the_title() }}">
            @endif

            <article class="u-mb-5" id="article">
                @if (post_password_required($post))
                    {!! get_the_password_form() !!}
                @else
                    @if (isset(get_extended($post->post_content)['main']) && !empty(get_extended($post->post_content)['main']) && isset(get_extended($post->post_content)['extended']) && !empty(get_extended($post->post_content)['extended']))

                        {!! apply_filters('the_lead', get_extended($post->post_content)['main']) !!}
                        {!! apply_filters('the_content', get_extended($post->post_content)['extended']) !!}

                    @else
                      {!! apply_filters('the_content', $post->post_content) !!}
                    @endif
                @endif
            </article>

            @if ($settingItems['attachments'])
              @foreach ($settingItems['attachments'] as $attachment_url)
                  <a class="link-item" href="{{ $settingItems['site_url'] . '/wp-content' . explode('wp-content', $attachment_url)[1] }}" download>
                    {{ explode('modularity-form-builder/', $attachment_url)[1] }}
                  </a>
              @endforeach
            @endif

            @if (is_single() && is_active_sidebar('content-area'))
                <div class="grid grid--columns sidebar-content-area sidebar-content-area-bottom">
                    <?php dynamic_sidebar('content-area'); ?>
                </div>
            @endif
        </div>
    </div>
</div>

@include('partials.blog.post-footer')
