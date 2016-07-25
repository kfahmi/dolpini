@extends('layouts.app')

@section('content')

                <div class="breadcrumbs" id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li class="active">
                            <i class="icon-home home-icon"></i>
                            <a href="{{url('/')}}">Home</a>

                            <span class="divider">
                                <i class="icon-angle-right arrow-icon"></i>
                            </span>
                        </li>

                        @if(count($tag) > 0)

                            <li class="active"><i class="blue fa fa-hashtag"></i><i><b>{{$tag->tag_name}}</b></i></li>

                        @endif


                    </ul><!--.breadcrumb-->

                    @include('layouts.search')
                </div>


@include('layouts.flashmessage')

                <div class="page-content">
                    <div class="row-fluid">
                        <div class="span12">
                            <!--PAGE CONTENT BEGINS-->

                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">

                                            @if(!isset($tag) && Request::segment(2) != 'tagNotFound')
                                            <li class="active">
                                                <a data-toggle="tab" href="#home">
                                                    <i class="blue icon-comments bigger-110"></i>


                                                    <b id="labelTabTopic">
                                                        @if(Request::segment(2) == NULL)
                                                            Semua Topik
                                                        @elseif(Request::segment(2) == 'subscribed')
                                                            Topik Diikuti
                                                        @elseif(Request::segment(2) == 'mostCommented')
                                                            Topik Paling Ditanggapi
                                                        @elseif(Request::segment(2) == 'mostSubscriber')
                                                            Topik Paling Diikuti    
                                                        @else
                                                            Topik {{ucfirst(Request::segment(2))}}
                                                        @endif
                                                    </b>
                                                       
                                                </a>
                                            </li>
                                             <li class="dropdown">
                                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                                    <b class="fa fa-sort-amount-desc"></b> 
                                                    <b class="caret"></b>
                                                </a>

                                                <ul class="dropdown-menu dropdown-info">
                                                    <li>
                                                        <a data-toggle="tab" href="#trendingTag"><i class="fa fa-hashtag"></i> Trending HashTags</a>
                                                    </li>

                                                    <li>
                                                        <a href="{{url('home')}}"><i class="fa fa-comments"></i> Semua Topik</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{url('home/subscribed')}}"><i class="fa fa-retweet"></i>Topik Diikuti</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{url('home/mostCommented')}}"><i class="fa fa-star"></i> Topik Paling Ditanggapi</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{url('home/mostSubscriber')}}"><i class="fa fa-star"></i> Topik Paling Diikuti</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{url('home/artikel')}}"><i class="fa fa-book"></i> Topik Artikel</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{url('home/debat')}}"><i class="fa fa-users"></i> Topik Debat</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{url('home/rating')}}"><i class="fa fa-sort-numeric-asc"></i> Topik Rating</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="dropdown">
                                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                                    <b class="icon-pencil"></b>
                                                    Buat Topic 
                                                    <b class="caret"></b>
                                                </a>

                                                <ul class="dropdown-menu dropdown-info">
                                                    <li>
                                                        <a data-toggle="tab" href="#dropdown2"><i class="icon-pencil"></i> Buat Topic</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            @elseif(isset($tag))
                                            <li class="active">
                                                <a data-toggle="tab" href="#home">
                                                    <i class="blue fa fa-hashtag"></i>
                                                    {{$tag->tag_name}} ({{$allPost->count()}})
                                                </a>
                                            </li>
                                            @else
                                            <li class="active">
                                                <a data-toggle="tab" href="#home">
                                                    <i class="blue fa fa-hashtag"></i>
                                                    {{Request::segment(2)}}
                                                </a>
                                            </li>
                                            @endif

                                        </ul>

                                        <div class="tab-content">
                                            <div id="home" class="tab-pane in active">
                                                @include('home_topic')
                                            </div>

                                            <div id="trendingTopic" class="tab-pane">
                                                trending topic
                                            </div>
                                            <div id="trendingTag" class="tab-pane">
                                                @include('home_top_tag')
                                            </div>

                                            <div id="dropdown2" class="tab-pane">
                                                <div class="position-relative">
                                                            <div class="itemdiv dialogdiv">
                                                                <div class="user">
                                                                 <a href="#" class="btn btn-app btn-primary btn-mini span1" id="btnNewTopic" data-rel="tooltip"
                                                                  title="Post Topic"  placeholder="Click" title="Hello Tooltip!" data-placement="bottom" >
                                                                    <i class="icon-pencil"></i>
                                                                 </a>

                                                                </div>

                                                                <!-- FORM TOPIC -->
                                                                @include('bodyNewTopic')
                                                                
                                                            </div>
                                                        
                                                    </div><!--/.page-header-->
                                            </div>
                                        </div>
                                    </div>
                                </div><!--/span-->

                                </div>
                            </div>
                        </div>
            </div><!--/.page-content-->




</div><!--/.main-content-->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>

        @include('library')
        @include('home_script')

        
@endsection
