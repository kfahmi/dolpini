@extends('layouts.app')

@section('content')
<article class="post">
    <section>
        <h3>Reset password request</h3>
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {!! csrf_field() !!}

            <div class="row uniform">
                <div class="6u 12u$(xsmall)">
                      <input type="email" name="email" value="{{ old('email') }}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="12u$">
                    <ul class="actions">
                        <li><input type="submit" value="Send Password Reset Link" /></li>
                        <li><input type="reset" value="Reset" /></li>
                    </ul>
                </div>
            </div>
        </form>
    </section>
</article>
@endsection
