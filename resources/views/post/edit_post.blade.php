<form onsubmit="submitForm()" action="{{url('/post/edit',$post->id)}}" method="POST" id="post-form" enctype="multipart/form-data">
	{!! csrf_field() !!}
<div class="controls">
    <select name="type_show" id="topicType" disabled>
        <option value="debat" {{ $post->type == 'debat' ? '' : 'selected'}}>Debate</option>
        <option value="rating" {{ $post->type == 'rating' ? '' : 'selected'}}>Rating</option>
        <option value="artikel" {{ $post->type == 'artikel' ? '' : 'selected'}}>Article</option>
    </select>

     <input type="hidden" name="type" id="type" value="{{$post->getOriginal('type')}}" />
     
    @if ($errors->has('type'))
        <span class="help-block">
            <strong>{{ $errors->first('type') }}</strong>
        </span>
    @endif
</div>

    
    <div class="controls">
        <input type="text" name="title" id="title" class="autosize-transition span12" placeholder="title" value="{{$post->getOriginal('title')}}" />
        @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>

<!-- <div class="wysiwyg-editor" id="editora1"></div> -->
    <div class="controls">
        <textarea type="text" name="header_content" id="form-field-11" placeholder="spread your words" class="autosize-transition span12" rows="10">{{$post->getOriginal('header_content')}}</textarea>
        @if ($errors->has('header_content'))
            <span class="help-block">
                <strong>{{ $errors->first('header_content') }}</strong>
            </span>
        @endif
    </div>

 


    <hr>

<button type="submit" class="pull-left btn btn-small btn-success pull-right">
    <i class="fa fa-save"></i>
    Save Post
</button>
</form>