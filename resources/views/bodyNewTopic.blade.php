<div class="body" id="bodyNewTopic" style="margin-left:80px;">
    <div class="time">
        <i class="icon-time"></i>
        <span class="green">new</span>
    </div>

    <div class="name">
        <h4>
        <a href="#">Post New Topic</a>
        </h4>
    </div>
    
    @include('layouts.errorform')

    <div class="text">
        <form action="{{url('/post')}}" method="POST" id="post-form" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <hr>

            <div class="row-fluid">
                <div class="vspace"></div>
              <div class="span6">
                <div class="controls">
                    <select name="type" id="topicType">
                        <option value="debat">Debate</option>
                        <option value="rating">Rating</option>
                        <option value="artikel">Article</option>
                    </select>
                    @if ($errors->has('type'))
                        <span class="help-block">
                            <strong>{{ $errors->first('type') }}</strong>
                        </span>
                    @endif
                </div>


                    <div class="controls">
                        <input type="text" name="title" id="title" class="autosize-transition span12" placeholder="title" value="{{Input::old('title')}}">
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>

                <!-- <div class="wysiwyg-editor" id="editora1"></div> -->
                    <div class="controls">
                        <textarea type="text" name="header_content" id="form-field-11" placeholder="spread your words" class="autosize-transition span12" rows="10" value="{{Input::old('header_content')}}"></textarea>
                        @if ($errors->has('header_content'))
                            <span class="help-block">
                                <strong>{{ $errors->first('header_content') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="controls">
                        <input type="text" name="tags" id="form-field-tags"  class="autosize-transition span12" placeholder="Tags (#)">
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="put your hashtags" >?</span>
                    </div>
                     <hr>


                    <div id="kubu">
                       
                    </div>



                    <hr>
                </div>

                <!-- <div class="span6">
                    <div class="controls">
                       <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="add photo, youtube url" >?</span>
                       <a class="btn btn-app btn-primary btn-mini" id="addYoutube"><i class="icon-youtube"></i> </a>
                       <a class="btn btn-app btn-primary btn-mini" id="addImage"><i class="icon-camera"></i> </a>
                       <a class="btn btn-app btn-primary btn-mini" id="addUrl"> URL </a><br>
                    </div>
                    <hr>
                    <div class="controls" id="postDetailContainer">
                   </div>
                </div> -->

                <!-- <div class="span5 infobox-container"> -->
               <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="add photo, youtube url" >?</span>
                <div class="span5">
                    <div class="row-fluid">
                        <div class="span2">
                            <i class="icon-youtube icon-large"></i>
                            <a id="addYoutube"><i class="icon-plus-sign"></i> </a>
                       </div>
                       <div class="span10" id="youtubeContainer">
                       </div>
                    </div>
                    <hr>
                     <div class="row-fluid">
                        <div class="span2">
                            <i class="icon-camera"></i>
                            <a id="addImage"><i class="icon-plus-sign"></i> </a>
                       </div>
                       <div class="span10" id="imageContainer">
                       </div>
                    </div>
                     <hr>
                      <div class="row-fluid">
                        <div class="span2">
                            URL
                            <a id="addUrl"><i class="icon-plus-sign"></i> </a>
                       </div>
                       <div class="span10" id="urlContainer">
                       </div>

                    </div>
                   </div>

                </div>


            </div>



            <button type="submit" class="btn-block btn btn-small btn-success pull-right">
                <i class="fa fa-upload"></i>
                Done
            </button>
            <br>
            <hr>


        </form>
