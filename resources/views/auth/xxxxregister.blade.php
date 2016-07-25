@extends('layouts.app')

@section('content')
            <div class="main-content-full">
                <div class="breadcrumbs" id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home home-icon"></i>
                            <a href="{{url('/')}}">Login</a>

                            <span class="divider">
                                <i class="icon-angle-right arrow-icon"></i>
                            </span>
                        </li>
                        <li class="active">
                            Registration
                        </li>
                    </ul><!--.breadcrumb-->
                </div>

                <div class="page-content">
                    <div class="row-fluid">
                        <div class="span4 center" style="float:right;">
                        </div>
                        <div class="span4 center" style="float:right;">

                                    <div class="widget-box">
                                        <div class="widget-header">
                                            <h4>Registration</h4>
                                        </div>

                                        <div class="widget-body">
                                            <div class="widget-main">
                                              <form class="form-horizontal" id="registration-form"  role="form" method="POST" action="{{ url('/register') }}"/>
                                             {!! csrf_field() !!}
                                                   

                                                    <h4>User information</h4>
                                                    <hr>
                                                    <div class="control-group">
                                                        <label>Full name</label>
                                                        <div class="row-fluid">
                                                        <span class="input-icon">
                                                            <input class="input-xlarge" type="text" id="form-field-icon-1" id="real_name" name="real_name" value="{{ old('real_name') }}"/>
                                                            <i class="icon-user"></i>
                                                        </span>
                                                     
                                                        </div>
                                                           @if ($errors->has('real_name'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('real_name') }}</strong>
                                                            </span>
                                                             @endif
                                                    </div>

                                                    <div class="control-group">
                                                        <label>Nick name</label>
                                                        <div class="row-fluid input-append">
                                                        <span class="input-icon">
                                                            <input class="input-xlarge" type="text" id="form-field-icon-1" id="nick_name" name="nick_name" value="{{ old('nick_name') }}"/>
                                                            <i class="icon-user"></i>
                                                        </span>
                                                     
                                                        </div>
                                                           @if ($errors->has('nick_name'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('nick_name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <div class="control-group">
                                                        <label>Mobile Phone</label>
                                                        <div class="row-fluid input-prepend">
                                                            <span class="add-on">
                                                                <i class="icon-phone"></i>
                                                            </span>
                                                            <input class="input-xlarge" type="tel" id="mobile_phone" name="mobile_phone" value="{{ old('mobile_phone') }}" />
                                                        </div>

                                                        @if ($errors->has('mobile_phone'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('mobile_phone') }}</strong>
                                                                </span>
                                                            @endif
                                                    </div>

                                                    <div class="control-group">
                                                        <label>Gender</label>
                                                        <div class="row-fluid input-prepend">
                                                          <span class="add-on">
                                                                <i class="icon-user"></i>
                                                            </span>
                                                        <select class="" name="gender" id="gender">
                                                            <option value="">--Select Gender--</option>
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                        </select>
                                                        </div>
                                                        @if ($errors->has('gender'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('gender') }}</strong>
                                                                </span>
                                                            @endif
                                                    </div>

                                                    <div class="control-group">
                                                        <label>Date of Birth</label>
                                                        <div class="row-fluid input-prepend">
                                                         <span class="add-on">
                                                                <i class="icon-calendar"></i>
                                                            </span>
                                                            <input class="input-xlarge date-picker" id="birth_date" 
                                                            type="text" data-date-format="yyyy-mm-dd" name="birth_date" value="{{ old('birth_date') }}" />
                                                        </div>
                                                            @if ($errors->has('birth_date'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('birth_date') }}</strong>
                                                                </span>
                                                            @endif
                                                    </div>

                                                    <h4>Login Credentials</h4>
                                                    <hr>
                                                    <div class="control-group">
                                                        <label>Email</label>
                                                        <div class="row-fluid input-prepend">
                                                          <span class="add-on">
                                                                <i class="icon-envelope-alt"></i>
                                                            </span>
                                                            <input class="input-xlarge" id="email" 
                                                            type="text" name="email" value="{{ old('email') }}" />
                                                        </div>
                                                        @if ($errors->has('email'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                                </span>
                                                            @endif
                                                    </div>
                                                    <div class="control-group">
                                                        <label>Password</label>
                                                        <div class="row-fluid input-prepend">
                                                        <span class="add-on">
                                                                <i class="icon-lock"></i>
                                                            </span>
                                                            <input class="input-xlarge" id="password" 
                                                            type="password" name="password"  />
                                                        </div>
                                                        @if ($errors->has('password'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('password') }}</strong>
                                                                </span>
                                                            @endif
                                                    </div>
                                                    <div class="control-group">
                                                        <label>Confirm Password</label>
                                                        <div class="row-fluid input-prepend">
                                                          <span class="add-on">
                                                                <i class="icon-lock"></i>
                                                            </span>
                                                            <input class="input-xlarge" id="password_confirmation" 
                                                            type="password" name="password_confirmation"/>
                                                        </div>
                                                        @if ($errors->has('password_confirmation'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                                </span>
                                                            @endif
                                                    </div>

                                                    <div class="control-group">
                                                        <div class="row-fluid">
                                                            <label>
                                                                    <input name="agree" id="agree" type="checkbox" />
                                                                    <span class="lbl"> I accept the policy</span>
                                                                </label>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary" value="Submit">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                        </div><!--/.span-->
                    </div><!--/.row-fluid-->
                </div><!--/.page-content-->
            </div><!--/.main-content-->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>
        @include('auth.plugin.library')
        @include('auth.plugin.register')
@endsection