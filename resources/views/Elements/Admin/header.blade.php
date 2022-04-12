<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar sticky">
	<div class="form-inline mr-auto">
		<ul class="navbar-nav mr-3">
			<li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"><i data-feather="align-justify"></i></a></li>
		</ul> 
	</div> 
	<ul class="navbar-nav navbar-right">		
		<li class="dropdown dropdown-list-toggle">
			<a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg"><i data-feather="bell" class="bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
				<div class="dropdown-header">Notifications
					<div class="float-right">
					  <a href="#">Mark All As Read</a>
					</div>
				</div>
				<div class="dropdown-list-content dropdown-list-icons">
					<a href="#" class="dropdown-item dropdown-item-unread">
						<span class="dropdown-item-icon bg-primary text-white"><i class="fas fa-code"></i></span>
						<span class="dropdown-item-desc"> Template update is available now! <span class="time">2 Min Ago</span></span>
					</a>
					<a href="#" class="dropdown-item">
						<span class="dropdown-item-icon bg-info text-white"><i class="far fa-user"></i></span>
						<span class="dropdown-item-desc"> <b>You</b> and <b>Dedik Sugiharto</b> are now friends <span class="time">10 Hours Ago</span></span>
					</a>
					<a href="#" class="dropdown-item">
						<span class="dropdown-item-icon bg-success text-white"> <i class="fas fa-check"></i></span>
						<span class="dropdown-item-desc"> <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b> <span class="time">12 Hours Ago</span></span>
					</a>
					<a href="#" class="dropdown-item">
						<span class="dropdown-item-icon bg-danger text-white"> <i class="fas fa-exclamation-triangle"></i></span>
						<span class="dropdown-item-desc"> Low disk space. Let's clean it! <span class="time">17 Hours Ago</span></span>
					</a>
					<a href="#" class="dropdown-item">
						<span class="dropdown-item-icon bg-info text-white"> <i class="fas fa-bell"></i></span>
						<span class="dropdown-item-desc"> Welcome to Otika template! <span class="time">Yesterday</span></span>
					</a>
				</div>
				<div class="dropdown-footer text-center">
					<a href="#">View All <i class="fas fa-chevron-right"></i></a>
				</div>
            </div>   
		</li> 
		<li class="dropdown">
			<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
				@if(@Auth::user()->profile_img == '')
					<img src="{{ asset('/public/img/avatars/default_profile.jpg') }}" class="user-img-radious-style" />
				@else
					<img src="{{URL::to('/public/img/profile_imgs')}}/{{@Auth::user()->profile_img}}" class="user-img-radious-style"/>
				@endif
				<span class="d-sm-none d-lg-inline-block"></span>
			</a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
				<div class="dropdown-title">{{str_limit(Auth::user()->first_name.' '.Auth::user()->last_name, 150, '...')}}</div>
				<a href="{{URL::to('/my_profile')}}" class="dropdown-item has-icon"> <i class="far fa-user"></i> Profile</a>
				<a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>Settings</a>
				<div class="dropdown-divider"></div>
				<a href="{{route('admin.logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>Logout</a>
				 {{ Form::open(array('url' => 'logout', 'name'=>'admin_login', 'id' => 'logout-form')) }}
				{{ Form::close() }}
			</div>
		</li>
	</ul>
</nav>  
 
