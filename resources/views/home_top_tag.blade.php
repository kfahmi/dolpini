

<h4>Trending Hashtags</h4>

@if(count($topTags) > 0)

	@foreach($topTags->slice(0,Helper::limitData('limitTrendingTag')) as $t)

	<a href="{{url('home',$t->id)}}"><i class="fa fa-hashtag"></i>{{$t->tag_name}}</a> ({{$t->hasPostTag->count()}} Topic) <br>

	@endforeach
@else

<div class="alert alert-danger">Hashtag tidak ditemukan</div>
@endif