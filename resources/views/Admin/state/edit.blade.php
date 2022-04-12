@extends('layouts.admin')
@section('title', 'Edit State')

@section('content')

<div class="main-content">
	<section class="section">
		<div class="section-body">
			{{ Form::open(array('url' => 'state/edit', 'name'=>"add-assesment", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
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
							<h4>State Info</h4>
						</div> 
						<div class="card-body">  
							<div class="form-group">
								<label>Name</label>
								<input type="text" value="<?php echo @$fetchedData->name; ?>" name="name" data-valid="required" class="form-control"/>
								@if ($errors->has('name'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('name') }}</strong>
									</span> 
								@endif
							</div>
							
							<div class="form-group">
								<label>Country</label>
								<select id="course_id" name="country_id" class="form-control" data-valid="required">
									<option value="">Choose One...</option>
										@foreach ($countries as $cuid)
											<option value="{{ @$cuid->id }}" <?php if($cuid->id == $fetchedData->country_id){ echo 'selected'; } ?>>{{ @$cuid->name }}</option>
										@endforeach										
								</select>
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
							<a style="margin-right:5px;" href="{{route('admin.state.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>  
							<button type="button" onClick="customValidate('add-assesment')" class="btn btn-success pull-right">Submit</button>  
						</div> 
					</div> 
					
				</div> 
				
            </div>
			{{ Form::close() }}
		</div>
	</section> 
</div>

@endsection
@section('scripts')

@endsection