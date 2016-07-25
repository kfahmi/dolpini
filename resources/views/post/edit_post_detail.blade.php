@if(count($post->postDetails) > 0)
	<div id="details_{{$post->id}}">
	<br>
		@if(count($post->postDetailsImage) > 0)
		<div class="span11">
			<div class="hr hr-dotted span12" style="margin:10px !important;"></div>
			<h4><i class="icon-camera"></i></h4>
			@foreach($post->postDetailsImage as $pd)
			<div class="pull-left" style="margin:5px;">
				<img class="editable" alt="image" src="{{ URL::asset('uploads/post/'.$pd->id.$pd->content) }}" width="450px" style="display: block;margin: 0 auto;"/>
				
				<a href="{{url('post/deleteDetail',$pd->id)}}" 
				onclick="if (!confirm('Hapus gambar ini ?')){return false;};"> 
					<i class="fa fa-trash"></i> Delete
				</a> 
			</div>
			@endforeach

		</div>
		@endif

		
		@if(count($post->postDetailsYoutube) > 0)
		<div class="span11">
			<div class="hr hr-dotted span12" style="margin:10px !important;"></div>
			<h4><i class="icon-youtube icon-large"></i></h4>
			@foreach($post->postDetailsYoutube as $pd)
			<div class="pull-left" style="margin:5px;">
				<iframe width="450" height="260" src="https://www.youtube.com/embed/{{$pd->content}}" frameborder="0" allowfullscreen></iframe>

				<a href="{{url('post/deleteDetail',$pd->id)}}"  
				onclick="if (!confirm('Hapus youtube ini ?')){return false;};"> 
					<i class="fa fa-trash"></i> Delete
				</a> 
			</div>
			@endforeach

		</div>
		@endif

		@if(count($post->postDetailsUrl) > 0)
		<div class="span11">
			<div class="hr hr-dotted span12" style="margin:10px !important;"></div>
			<h4><i class="fa fa-globe fa-spin"></i></h4>
			<?php $i=0;?>
			@foreach($post->postDetailsUrl as $pd)
			<div class="pull-left urlive-container" style="margin:5px;">
				<a href="{{$pd->content}}" class="urlData" target="_blank" style="display:none;">{{$pd->content}}</a>

					<a href="{{url('post/deleteDetail',$pd->id)}}" 
					onclick="if (!confirm('Hapus URL ini ?')){return false;};"> 
						<i class="fa fa-trash"></i> Delete
					</a> 
			</div>

			<div class="pureUrl">
				<i class="fa fa-spin fa-spinner"></i> Memuat Content... 
				<a href="{{$pd->content}}">{{$pd->content}}</a>
				
				<i class='fa fa-ellipsis-v'></i> 

				<a href="{{url('post/deleteDetail',$pd->id)}}" 
				onclick="if (!confirm('Hapus URL ini ?')){return false;};"> 
				<i class="fa fa-trash"></i> Delete
			   </a> 
			</div>

		
			<?php $i++;?>
			@endforeach
		</div>
		@endif
	</div>
@endif