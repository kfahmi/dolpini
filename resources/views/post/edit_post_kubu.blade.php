@foreach($post->postKubu as $kubu)
	<span class="badge badge-primary"><i class="fa fa-comments"></i> {{$kubu->label}}</span><br>
@endforeach