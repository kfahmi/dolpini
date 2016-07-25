<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
       <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} 

        @if($msg == 'danger')
        <i class="fa fa-remove"></i>
        @elseif($msg == 'info')
        <i class="fa fa-check"></i>
        @endif
         
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

      </p>
      @endif
    @endforeach
  </div> <!-- end .flash-message -->
