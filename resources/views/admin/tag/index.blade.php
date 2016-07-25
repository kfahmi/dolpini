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

                        <li class="active"> <b>Pengaturan Hashtag</b></li>
                    </ul><!--.breadcrumb-->

                    @include('layouts.search')
                </div>


@include('layouts.flashmessage')

                <div class="page-content">
                    <div class="row-fluid">
                        <div class="span12">

                            <table id="tag-datatable" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">id</th>
                                        <th><i class="fa fa-hashtag"></i> Hashtag</th>
                                        <th>Used in (post/topic)</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach($tag as $t)
                                       <tr>
                                        <td>{{$t->id}}</td>
                                        <td>{{$t->tag_name}}</td>
                                        <td>{{$t->hasPostTag->count()}}</td>
                                        <td>
                                            <a href="{{url('/home',$t->id)}}" class="btn btn-mini btn-info">
                                                <i class="fa fa-search"></i> 
                                            </a>
                                           

                                        </td>
                                       </tr>
                                   @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
            </div><!--/.page-content-->

</div><!--/.main-content-->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>

        @include('library')
        @include('admin.tag.tag_script')

        
@endsection
