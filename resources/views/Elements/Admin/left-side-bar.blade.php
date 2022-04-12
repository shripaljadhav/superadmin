<div class="main-sidebar sidebar-style-2">
	<aside id="sidebar-wrapper">  
		<div class="sidebar-brand">
			<a href="{{URL::to('/')}}">
				
				<span class="logo-name">Munch Hub</span>
			</a>
		</div>
		<?php 
		
		$userrole = \App\UserRole::where('usertype', Auth::user()->role)->first();		
		  $modules = json_decode(@$userrole->module_access);			
			?>
		<ul class="sidebar-menu">
			<li class="menu-header">Main</li>
			<li class="dropdown active">
				<a href="{{URL::to('/admin')}}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
			</li>
			@if(Auth::user()->role == 1)
			<li class="dropdown">
				<a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="pie-chart"></i><span>Restaurants</span></a>
				<ul class="dropdown-menu">
					<li><a class="nav-link" href="{{route('admin.restaurants.index')}}">All Restaurants</a></li>
					@if(Auth::user()->role == 1 || @in_array('company_management_add', $modules))
					<li><a class="nav-link" href="{{route('admin.restaurants.create')}}">Add Restaurant</a></li> 
				@endif
				</ul> 
			</li>
			@endif
			<li class="dropdown">
				<a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="pie-chart"></i><span>Cuisine</span></a>
				<ul class="dropdown-menu">
					<li><a class="nav-link" href="{{route('admin.cuisine.index')}}">All Cuisine</a></li>
					
					<li><a class="nav-link" href="{{route('admin.cuisine.create')}}">Add Cuisine</a></li> 
			
				</ul> 
			</li>
			<li class="dropdown">
				<a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="pie-chart"></i><span>Menu</span></a>
				<ul class="dropdown-menu">
					<li><a class="nav-link" href="{{route('admin.menus.index')}}">Menus</a></li>
					<li><a class="nav-link" href="{{route('admin.categories.index')}}">Categories</a></li>
					<li><a class="nav-link" href="{{route('admin.modifiers.index')}}">Modifiers</a></li>
					
				</ul> 
			</li>
			
			<li class="dropdown">
				<a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="pie-chart"></i><span>Settings</span></a>
				<ul class="dropdown-menu">
					<li><a class="nav-link" href="{{route('admin.country.index')}}">Country</a></li>
					<li><a class="nav-link" href="{{route('admin.state.index')}}">State</a></li>
				</ul> 
			</li>
		</ul>
	</aside>
</div>

 