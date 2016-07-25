@extends('layouts.app')

@section('content')

<div class="main-content-full">
                <div class="breadcrumbs" id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home home-icon"></i>
                            <a href="{{url('/login')}}">Login</a>

                            <span class="divider">
                                <i class="icon-angle-right arrow-icon"></i>
                            </span>
                        </li>
                        <li class="active">
                            Reset password
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
                                            <h4>Reset Password</h4>
                                        </div>
                                              <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                                                            {!! csrf_field() !!}

                                                <input type="hidden" name="token" value="{{ $token }}">
                                                <br>
                                                <div class="row uniform">
                                                    <div class="6u 12u$(xsmall)">
                                                     <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}">

                                                            @if ($errors->has('email'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                                </span>
                                                            @endif
                                                    </div>
                                                </div>
                                                <br>
                                                <h3>NEW PASSWORD</h3>
                                                <div class="row uniform">
                                                      <div class="6u 12u$(xsmall)">
                                                           <input type="password" class="form-control" placeholder="Type new password.." name="password">

                                                                    @if ($errors->has('password'))
                                                                        <span class="help-block">
                                                                            <strong>{{ $errors->first('password') }}</strong>
                                                                        </span>
                                                                    @endif
                                                    </div>

                                                      <div class="6u 12u$(xsmall)">
                                                       <input type="password" class="form-control" placeholder="Confirm password.." name="password_confirmation">

                                                                    @if ($errors->has('password_confirmation'))
                                                                        <span class="help-block">
                                                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                                        </span>
                                                                    @endif
                                                    </div>

                                                        <br>
                                                        <input type="submit" class="btn btn-primary" value="Send Password Reset Link" />
                                                </div>
                                            </form>
                                            </div>

                                </div>

                    </div>
    </div>
@endsection
