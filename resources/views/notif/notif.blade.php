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
                        <li class="active">Notifications</li>
                    </ul><!--.breadcrumb-->

                    @include('layouts.search')
                </div>


@include('layouts.flashmessage')


                <div class="page-content">
                            <!--PAGE CONTENT BEGINS-->

                    <div class="row-fluid">
                        <div class="span12">

                            @if($type == 'followRequest')
                                @include('notif.followRequest')
                            @endif

                                    
                        </div><!--/span-->

                    </div>
                </div><!--/.page-content-->




</div><!--/.main-content-->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>

        @include('library')
        @include('home_script')

        
@endsection
