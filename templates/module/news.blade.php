<?php $comments = get_comments(array('number' => 4)); ?>
@foreach($comments as $comment)

  @foreach($posts as $post)
    @if($post->ID == $comment->comment_post_ID)

    <a href="">
      <h3>{{$post->post_title}}</h3>
      <span>{{$comment->comment_author}}, </span><span>{{$comment->comment_date}}}</span>

      <p>{{$comment->$comment_content}}</p>
    </a>
    @endif
  @endforeach
@endforeach