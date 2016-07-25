
        <div class="main-container container-fluid">
            <a class="menu-toggler" id="menu-toggler" href="#">
                <span class="menu-text"></span>
            </a>

            <div class="sidebar" id="sidebar">
                <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                         <a href="{{url('post/admin')}}" class="btn btn-small btn-success">
                            <i class="icon-comments"></i>
                        </a>

                        <a href="{{url('post/reply/admin')}}" class="btn btn-small btn-info">
                            <i class="icon-comments"></i>
                        </a>

                        <a href="{{url('user/admin')}}" class="btn btn-small btn-warning">
                            <i class="icon-group"></i>
                        </a>

                        <a href="{{url('badwords/admin')}}" class="btn btn-small btn-danger">
                            <i class="fa fa-warning"></i>
                        </a>
                    </div>

                    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                        <span class="btn btn-success"></span>

                        <span class="btn btn-info"></span>

                        <span class="btn btn-warning"></span>

                        <span class="btn btn-danger"></span>
                    </div>
                </div><!--#sidebar-shortcuts-->

                <ul class="nav nav-list">
                    <li>
                        <a href="{{url('/')}}">
                            <i class="icon-dashboard"></i>
                            <span class="menu-text"> Dashboard </span>
                        </a>
                    </li>

                   

                    <li>
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-cog fa-spin icon-bigger"></i>
                            <span class="menu-text"> Administrator </span>

                            <b class="arrow icon-angle-down"></b>
                        </a>

                        <ul class="submenu">
                            <li>
                                <a href="{{url('/user/admin')}}">
                                    <i class="icon-double-angle-right"></i>
                                    <i class="fa fa-users"></i> 
                                    User
                                </a>
                            </li>

                            <li>
                                <a href="{{url('/post/admin')}}">
                                    <i class="icon-double-angle-right"></i>
                                        
                                    <i class="fa fa-comments"></i> 
                                    Topik
                                </a>
                            </li>

                            <li>
                                <a href="{{url('/post/reply/admin')}}">
                                    <i class="icon-double-angle-right"></i>
                                        
                                    <i class="fa fa-comments"></i> 
                                    Komentar
                                </a>
                            </li>

                            <li>
                                <a href="{{url('/badwords/admin')}}">
                                    <i class="icon-double-angle-right"></i>

                                    <i class="fa fa-warning"></i> 
                                    Sensor Kata
                                </a>
                            </li>

                            <li>
                                <a href="{{url('/tag/admin')}}">
                                    <i class="icon-double-angle-right"></i>

                                    <i class="fa fa-hashtag"></i> 
                                    Hashtag
                                </a>
                            </li>
                        </ul>
                    </li>

                    
                </ul><!--/.nav-list-->

                <div class="sidebar-collapse" id="sidebar-collapse">
                    <i class="icon-double-angle-left"></i>
                </div>
            </div>