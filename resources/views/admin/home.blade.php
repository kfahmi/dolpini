@extends('layouts.app')

@section('content')

               <div class="breadcrumbs" id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home home-icon"></i>
                            <a href="{{url('/homeAdmin')}}">Home</a>

                            <span class="divider">
                                <i class="icon-angle-right arrow-icon"></i>
                            </span>
                        </li>
                    </ul><!--.breadcrumb-->

                    @include('layouts.search')
                </div>

                <div class="page-content">
                    <div class="page-header position-relative">
                        <h1>
                            Dashboard
                            <small>
                                <i class="icon-double-angle-right"></i>
                                overview &amp; stats
                            </small>
                        </h1>
                    </div><!--/.page-header-->

                    <div class="row-fluid">
                        <div class="span12">
                            <!--PAGE CONTENT BEGINS-->

                            <div class="alert alert-block alert-success">
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="icon-remove"></i>
                                </button>

                                <i class="icon-ok green"></i>

                                hi {{Auth::user()->real_name}} , Welcome to
                                <strong class="green">
                                    Dolpini
                                    <small>(v1.1.2)</small>
                                </strong>
                                
                                Admin Panel
                            </div>

                            <div class="space-6"></div>

                            <div class="row-fluid">
                                <div class="span12 infobox-container">
                                    <div class="infobox infobox-green  ">
                                        <div class="infobox-icon">
                                            <i class="icon-comments"></i>
                                        </div>

                                        <div class="infobox-data">
                                            <span class="infobox-data-number">{{App\Models\Post::all()->count()}}</span>
                                            <div class="infobox-content">Active Topics</div>
                                        </div>
                                        <div class="stat stat-success">8%</div>
                                    </div>

                                    <div class="infobox infobox-blue  ">
                                        <div class="infobox-icon">
                                            <i class="icon-comments"></i>
                                        </div>

                                        <div class="infobox-data">
                                            <span class="infobox-data-number">{{App\Models\ReplyKubu::all()->count()}}</span>
                                            <div class="infobox-content">Comments</div>
                                        </div>

                                        <div class="badge badge-success">
                                            +32%
                                            <i class="icon-arrow-up"></i>
                                        </div>
                                    </div>

                                    <div class="infobox infobox-pink  ">
                                        <div class="infobox-icon">
                                            <i class="icon-user"></i>
                                        </div>

                                        <div class="infobox-data">
                                            <span class="infobox-data-number">{{App\Models\User::where('level','user')->count()}}</span>
                                            <div class="infobox-content">Active Users</div>
                                        </div>
                                        <div class="stat stat-important">+4%</div>
                                    </div>

                                    <div class="infobox infobox-red  ">
                                        <div class="infobox-icon">
                                            <i class="icon-bell icon-bell-animated"></i>
                                        </div>

                                        <div class="infobox-data">
                                            <span class="infobox-data-number">{{App\Models\Notif::all()->count()}}</span>
                                            <div class="infobox-content">Notification Activities</div>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/row-->


                            <div class="hr hr32 hr-dotted"></div>

                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="widget-box transparent" id="recent-box">
                                        <div class="widget-header">
                                            <h4 class="lighter smaller">
                                                <i class="icon-rss orange"></i>
                                                Terbaru
                                            </h4>

                                            <div class="widget-toolbar no-border">
                                                <ul class="nav nav-tabs" id="recent-tab">
                                                     <li class="active">
                                                        <a data-toggle="tab" href="#member-tab">User</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#topik-tab">Topik</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#komentar-tab">Komentar</a>
                                                    </li>
                                                   

                                                    
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="widget-body">
                                            <div class="widget-main padding-4">
                                                <div class="tab-content padding-8 overflow-visible">
                                                    
                                                    <div id="member-tab" class="tab-pane active">
                                                        <div class="clearfix">

                                                            @include('admin.home_user')
                                                        
                                                        </div>

                                                        <div class="center">
                                                            <i class="icon-group icon-2x blue"></i>

                                                            &nbsp;
                                                            <a href="{{url('/user/admin')}}">
                                                                Lihat semua user &nbsp;
                                                                <i class="icon-arrow-right"></i>
                                                            </a>
                                                        </div>

                                                        <div class="hr hr-double hr8"></div>
                                                    </div><!--member-tab-->

                                                    <div id="topik-tab" class="tab-pane">
                                                        <div class="clearfix">

                                                            @include('admin.home_topik')
                                                        
                                                        </div>

                                                        <div class="center">
                                                            <i class="fa fa-comments fa-2x blue"></i>

                                                            &nbsp;
                                                            <a href="{{url('/post/admin')}}">
                                                                Lihat semua Topik &nbsp;
                                                                <i class="icon-arrow-right"></i>
                                                            </a>
                                                        </div>

                                                        <div class="hr hr-double hr8"></div>
                                                    </div><!--member-tab-->

                                                    <div id="komentar-tab" class="tab-pane">
                                                        <div class="comments">

                                                            @include('admin.home_komentar')
                                                        
                                                        </div>

                                                        <div class="center">
                                                            <i class="fa fa-comments fa-2x blue"></i>

                                                            &nbsp;
                                                            <a href="{{url('/post/reply/admin')}}">
                                                                Lihat semua komentar &nbsp;
                                                                <i class="icon-arrow-right"></i>
                                                            </a>
                                                        </div>

                                                        <div class="hr hr-double hr8"></div>
                                                    </div><!--member-tab-->

                                                    </div>
                                                </div>
                                            </div><!--/widget-main-->
                                        </div><!--/widget-body-->
                                    </div><!--/widget-box-->
                                </div><!--/span-->
                            </div><!--/row-->

                            <!--PAGE CONTENT ENDS-->
                        </div><!--/.span-->
                    </div><!--/.row-fluid-->
                </div><!--/.page-content-->

        



</div><!--/.main-content-->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>

        @include('library')
        @include('home_script')

        
@endsection
