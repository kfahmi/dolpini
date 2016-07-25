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

                        <li class="active"> <b>Pengaturan Topik</b></li>
                    </ul><!--.breadcrumb-->

                    @include('layouts.search')
                </div>


@include('layouts.flashmessage')

                <div class="page-content">
                    <div class="row-fluid">
                        <div class="span12">

                              <table id="post-datatable" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">Topik id</th>
                                        <th>Kategori</th>
                                        <th>Title</th>
                                        <th>Header Content</th>
                                        <th>Author</th>
                                        <th>Status</th>
                                        <th>Last Update</th>
                                        <th>Created</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach($topik as $t)
                                   <tr>
                                    <td>{{$t->id}}</td>
                                    <td>{{ucfirst($t->type)}}</td>
                                    <td>{{Helper::lessChar($t->title,100)}}</td>
                                    <td>{{Helper::lessChar($t->header_content,100)}}</td>
                                    <td>{{$t->user->real_name}}</td>
                                    <td>{{Helper::kontenStatus($t->id,'post','html')}}</td>
                                    <td>{{Helper::postDateFormat($t->updated_at)}}</td>
                                    <td>{{Helper::postDateFormat($t->created_at)}}</td>
                                    <td>
                                        <a href="{{url('post/detail',$t->id)}}" class="btn btn-mini btn-info">
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
        @include('admin.post.post_script')

        
@endsection
