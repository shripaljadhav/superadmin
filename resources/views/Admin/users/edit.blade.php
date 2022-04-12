@extends('layouts.admin')
@section('title', 'Edit User')

@section('content')


<div class="main-content">
	<section class="section">
		<div class="section-body">
			{{ Form::open(array('url' => 'admin/users/edit', 'name'=>"edit-user", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
			  {{ Form::hidden('id', @$fetchedData->id) }}
            <div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="server-error"> 
						@include('../Elements/flash-message')
					</div>
				</div>
				<div class="col-9 col-md-9 col-lg-9">
					<div class="card">
						<div class="card-header"> 
							<h4>Edit Users</h4>
						</div>
						<div class="card-body"> 
							<div class="row">
								<div class="col-6 col-md-6 col-lg-6">
									<div class="form-group">
										<label for="first_name">First Name</label>
										<input type="text" name="first_name" data-valid="required" class="form-control" value="<?php echo @$fetchedData->first_name; ?>"/>
										@if ($errors->has('first_name'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('first_name') }}</strong>
											</span> 
										@endif
									</div>
								</div>
								<div class="col-6 col-md-6 col-lg-6">
									<div class="form-group">
										<label for="last_name">Last Name</label>
										<input type="text" name="last_name" data-valid="required" class="form-control" value="<?php echo @$fetchedData->last_name; ?>"/>
										@if ($errors->has('last_name'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('last_name') }}</strong>
											</span> 
										@endif
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="text" name="email" data-valid="required email" class="form-control" value="<?php echo @$fetchedData->email; ?>"/>
								@if ($errors->has('email'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('email') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>User Password</label>
								<input type="password" name="password" data-valid="required" class="form-control"/>
								@if ($errors->has('password'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('password') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>Phone</label>
								<input type="text" name="phone" data-valid="required" class="form-control" value="<?php echo @$fetchedData->phone; ?>"/>
								@if ($errors->has('phone'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('phone') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label>Role</label>
								<select name="role" id="role" class="form-control">
									<option value="">Choose One...</option>
									@if(count(@$usertype) !== 0)
										@foreach (@$usertype as $ut)
											<option value="{{ @$ut->id }}" @if(@$fetchedData->role == $ut->id) selected  @endif  > {{ @$ut->name }}</option>
										@endforeach
									@endif		
								</select>		
								@if ($errors->has('role'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('role') }}</strong>
									</span> 
								@endif
							</div>					
						</div>
					</div>
				</div>
				<div class="col-3 col-md-3 col-lg-3">
					<div class="card">
						<div class="card-header"> 
							<h4>Publish</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group" style="margin-bottom:0px;">
								<label>Status</label>
								<select name="status" class="form-control">
									<option value="1" @if(@$fetchedData->status == 1) selected  @endif>Publish</option>
									<option value="0" @if(@$fetchedData->status == 0) selected  @endif>Draft</option>
								</select>
							</div>
						</div> 
						<div class="card-footer"> 
							<a style="margin-right:5px;" href="{{route('admin.users.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
							<button type="button" onClick="customValidate('edit-user')" class="btn btn-success pull-right">Update</button>
						</div>
					</div>
					<div class="card">
						<div class="card-header"> 
							<h4>Profile Image</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group" style="margin-bottom:0px;">
								<input type="hidden" id="old_profile_img" name="old_profile_img" value="{{@$fetchedData->profile_img}}" />
											
								<input type="file" name="profile_img" class="form-control" autocomplete="off" data-valid="required" />									
								<div class="show-uploded-img">	
									@if(@$fetchedData->profile_img != '')
										<img width="70" src="{{URL::to('/public/img/profile_imgs')}}/{{@$fetchedData->profile_img}}" class="img-avatar"/>
									@endif
								</div>							
															
								@if ($errors->has('profile_img'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('profile_img') }}</strong>
									</span> 
								@endif  
							</div>
						</div> 
					</div>
				</div> 
            </div>
			{{ Form::close() }}
		</div>
	</section> 
</div>

@endsection