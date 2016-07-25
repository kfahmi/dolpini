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

                        <li class="active"> <b>Pengaturan User</b></li>
                    </ul><!--.breadcrumb-->

                    @include('layouts.search')
                </div>


@include('layouts.flashmessage')

                <div class="page-content">
                    <div class="row-fluid">
                        <div class="span12">

                            <table id="user-datatable" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">user id</th>
                                        <th width="5%">Level</th>
                                        <th>Real name</th>
                                        <th>Nick name</th>
                                        <th>Email</th>
                                        <th>Join Date</th>
                                        <th>Status</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach($user as $u)


                                   <tr>
                                    <td>{{$u->id}}</td>
                                    <td>{{$u->level}}</td>
                                    <td>{{$u->real_name}}</td>
                                    <td>{{$u->nick_name}}</td>
                                    <td>{{$u->email}}</td>
                                    <td>{{$u->created_at}}</td>
                                    <td>{{Helper::userStatus($u->id,'html')}}</td>
                                    <td>
                                        <form method="post" action="{{url('user/deleteRestore')}}">
                                            {!! csrf_field() !!}

                                          

                                            <input type="hidden" name="id" value="{{$u->id}}">
                                            <!-- kalo blm dihapus -->
                                            @if(!isset($u->deleted_at))
                                               <a href="{{url('user/profile',$u->nick_name)}}" class="btn btn-mini btn-info">
                                                <i class="fa fa-search"></i>
                                             </a>

                                              <button type="submit" class="btn btn-mini btn-danger" onclick="if (!confirm('Hapus / Non Aktifkan user ini?'))
                                                {
                                                    return false;
                                                }
                                                ;"><i class="fa fa-trash"></i> </button> 
                                            @else
                                                <button type="submit" class="btn btn-mini btn-success" onclick="if (!confirm('Restore / Aktifkan user ini?'))
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
        @include('admin.user.user_script')

        
@endsection
