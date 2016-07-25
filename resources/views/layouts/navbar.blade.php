<div class="navbar">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a href="{{url('/')}}" class="brand">
                     DOLPINI
                        <small style="font-size:50%">
                            <i class="icon-leaf"></i>
                          Speak the truth
                        </small>
                    </a><!--/.brand-->

                    <!-- SETELAH LOGIN MUNCULNYA -->
                    @if(Auth::check() && Auth::user()->level == 'user')
                        @include('layouts.navbar_menu')
                    @elseif(Auth::check() && Auth::user()->level == 'admin')
                        @include('layouts.navbar_menu_admin')
                    @endif
                </div><!--/.container-fluid-->
            </div><!--/.navbar-inner-->
        </div>
