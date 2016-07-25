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

                        <li class="active">
                            <a href="{{url('badwords/admin')}}">Pengaturan Sensor Kata</a>

                            <span class="divider">
                                <i class="icon-angle-right arrow-icon"></i>
                            </span>
                        </li>

                        <li class="active"> <b>Penambahan Sensor Kata</b></li>
                    </ul><!--.breadcrumb-->

                    @include('layouts.search')
                </div>


@include('layouts.flashmessage')

                <div class="page-content">
                    <div class="row-fluid">
                        <div class="span12">

                            <div class="span5">
                                        <div class="widget-box">
                                            <div class="widget-header">
                                                <h4>
                                                    <i class="fa fa-warning"></i>
                                                    Sensor Kata
                                                </h4>
                                            </div>

                                            <div class="widget-body">
                                                <div class="widget-main">
                                                   
                                                   <form action="{{url('badwords/create')}}" method="POST" id="badwords-form">

                                                    {!! csrf_field() !!}
                                                     <div class="controls">
                                                        <input type="text" name="word" id="word" class="autosize-transition span12" placeholder="Forbidden word" value="{{Input::old('word')}}">
                                                    </div>
                                                   <div class="controls">
                                                        <input type="text" name="replace_to" id="replace_to" class="autosize-transition span12" placeholder="Replacement word" value="{{Input::old('replace_to')}}">
                                                    </div>
                                                    <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


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
