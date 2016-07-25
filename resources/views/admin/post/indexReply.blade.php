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

                        <li class="active"> <b>Pengaturan Komentar</b></li>
                    </ul><!--.breadcrumb-->

                    @include('layouts.search')
                </div>


@include('layouts.flashmessage')

                <div class="page-content">
                    <div class="row-fluid">
                        <div class="span12">

                              <table id="reply-datatable" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">Komentar id</th>
                                        <th width="15%">User</th>
                                        <th>Komentar</th>
                                        <th> @kubu - Topic </th>
                                        <th width="5%">Status</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach($replyKubu as $r)
                                   <tr>
                                    <td>{{$r->id}}</td>
                                    <td>{{$r->user->real_name}}</td>
                                    <td>{{$r->text}}</td>
                                    <td>@ {{$r->kubu->label}} - [{{$r->kubu->post->type}}] {{$r->kubu->post->title}}</td>
                                    <td>{{Helper::kontenStatus($r->id,'replyKubu','html')}}</td>
                                    <td>
                                        <!-- jika belom dihapus -->
                                        <form method="post" action="{{url('post/reply/deleteRestoreReply')}}">
                                            {!! csrf_field() !!}

                                            <a href="{{url('post/detail',$r->kubu->post->id)}}" class="btn btn-mini btn-info">
                                                    <i class="fa fa-search"></i>
                                            </a>

                                            <input type="hidden" name="id" value="{{$r->id}}">
                                            <!-- kalo blm dihapus -->
                                            @if(!isset($r->deleted_at))
                                              <button type="submit" class="btn btn-mini btn-danger" onclick="if (!confirm('Hapus / Non Aktifkan komentar ini?'))
                                                {
                                                    return false;
                                                }
                                                ;"><i class="fa fa-trash"></i> </button> 
                                            @else
                                                <button type="submit" class="btn btn-mini btn-success" onclick="if (!confirm('Restore / Aktifkan komentar ini?'))
                                                {
                                                    return false;
                                                }
                                                ;"><i class="fa fa-refresh"></i> </button> 

                                            @endif
                                        </form>
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
