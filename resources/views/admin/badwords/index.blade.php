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

                        <li class="active"> <b>Pengaturan Sensor Kata</b></li>
                    </ul><!--.breadcrumb-->

                    @include('layouts.search')
                </div>


@include('layouts.flashmessage')

                <div class="page-content">
                    <div class="row-fluid">
                        <div class="span12">

                            <a href="{{url('badwords/create')}}" class="btn btn-mini btn-info"> 
                                <i class="fa fa-plus"></i> 
                                Word</a>

                            <table id="badwords-datatable" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">Sensor id</th>
                                        <th>Kata</th>
                                        <th>Ubah Menjadi</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach($word as $w)
                                       <tr>
                                        <td>{{$w->id}}</td>
                                        <td>{{$w->word}}</td>
                                        <td>{{$w->replace_to}}</td>
                                        <td>
                                            <a href="{{url('badwords/edit',$w->id)}}" class="btn btn-mini btn-info">
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
        @include('admin.badwords.badwords_script')

        
@endsection
