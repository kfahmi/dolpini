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
                        <li class="active">{{Helper::showName($user->id)}}</li>
                    </ul><!--.breadcrumb-->

                    @include('layouts.search')
                </div>

@include('layouts.flashmessage')

				<div class="page-content">
					<div class="page-header position-relative">
						
					</div><!--/.page-header-->

					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							@if(Auth::user()->nick_name == $user->nick_name || Auth::user()->level == 'admin')

							<!-- EDIT -->
							<div class="clearfix editbtn">
								<div class="pull-left alert alert-success inline no-margin" id="editProfileBtn">
									<!-- <button type="button" class="close" data-dismiss="alert">
										<i class="icon-remove"></i>
									</button> -->

									<i class="icon-pencil bigger-120 blue"></i>
									Edit profile
								</div>
							</div>

							<div class="clearfix showbtn" style="display:none;">
								<div class="pull-left alert alert-success inline no-margin" id="showProfileBtn">
									<!-- <button type="button" class="close" data-dismiss="alert">
										<i class="icon-remove"></i>
									</button> -->

									<i class="icon-remove bigger-120 blue"></i>
									cancel edit
								</div>
							</div>
							<!-- END EDIT -->
							@include('layouts.errorform')
							<div class="hr dotted"></div>
							@endif



								@include('user.profile_edit')

								@include('user.profile_show')



							
						
							</div>
						</div><!--/.row-fluid-->
					</div><!--/.page-content-->
</div><!--/.main-content-->
        @include('library')


        <!-- KALAU PROFILE MILIK SENDIRI INI DI INCLUDE BUAT EDIT -->
        @if(Auth::user()->nick_name == $user->nick_name || Auth::user()->level == 'admin')
      	  @include('user.profile_own_script')
        @endif

@endsection	