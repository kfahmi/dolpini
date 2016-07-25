@foreach($post->postTags as $tag)
	<span class="badge badge-primary"><i class="fa fa-hashtag"></i> {{$tag->tag->tag_name}}</span><br>
@endforeach