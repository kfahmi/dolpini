






@extends('layouts.app')

@section('content')
<script type="text/javascript" src="{{ URL::asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/datepicker/datepicker3.css') }}" />
 <script>
    $('.datepicker').datepicker();
 </script>
<h3>REGISTRATION</h3>
<article class="post">

    <section>
        <h3>User Information</h3>
          <form role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}
            <div class="row uniform">
                <div class="6u 12u$(xsmall)">
                    <input type="text" name="real_name" placeholder="what is your real name?" value="{{ old('real_name') }}">
                    @if ($errors->has('real_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('real_name') }}</strong>
                        </span>
                    @endif
                </div>

              <div class="6u 12u$(xsmall)">
                 <input type="text" placeholder="What is your nick name?" name="nick_name" value="{{ old('nick_name') }}">
                    @if ($errors->has('nick_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nick_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="6u 12u$(xsmall)">
                    <input type="text" placeholder="Your mobile phone please?" name="mobile_phone" value="{{ old('mobile_phone') }}">
                        @if ($errors->has('mobile_phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('mobile_phone') }}</strong>
                            </span>
                        @endif
                </div>

                 <div class="6u 12u$(xsmall)">
                    <input type="text" placeholder="Your birth date?" class="datepicker" name="birth_date" value="{{ old('birth_date') }}">
                        @if ($errors->has('birth_date'))
                            <span class="help-block">
                                <strong>{{ $errors->first('birth_date') }}</strong>
                            </span>
                        @endif
                </div>
            </div>
                    <br>   <br>

                <h3>Login Credentials</h3>
                <div class="row uniform">
                  <div class="6u 12u$(xsmall)">
                     <input type="email" placeholder="Your valid email Address, please?" class="form-control" name="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                </div>

                   <div class="6u 12u$(xsmall)">
                      <input type="password" placeholder="Password for login credentials" class="form-control" name="password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                </div>

                   <div class="6u 12u$(xsmall)">
                       <input type="password" placeholder="Confirm your password" class="form-control" name="password_confirmation">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                </div>


                <div class="12u$">
                    <ul class="actions">
                        <li><input type="submit" value="Submit" /></li>
                        <li><input type="reset" value="Reset" /></li>
                    </ul>
                </div>
            </div>
        </form>
    </section>
</article>
@endsection
