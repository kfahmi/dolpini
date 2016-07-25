
 <div class="nav-search" id="nav-search">
    <form class="form-search" action="{{url('/search')}}" method="post" onsubmit="submitForm()"/>
    {!! csrf_field() !!}
        <span class="input-icon">
            <input type="text" placeholder="Search using #..." class="input-small nav-search-input" id="nav-search-input" name="textSearch" autocomplete="off" />
            <i class="icon-search nav-search-icon"></i>
        </span>
    </form>
</div><!--#nav-search-->