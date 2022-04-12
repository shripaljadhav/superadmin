@extends('layouts.admin')
@section('title', 'Edit Cuisine')

@section('content')

<div class="main-content">
	<section class="section">
		<div class="section-body">
			{{ Form::open(array('url' => 'cuisine/edit', 'name'=>"add-assesment", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
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
							<h4>Cuisine Info</h4>
						</div> 
						<div class="card-body">  
							<div class="form-group">
								<label>Name</label>
								<input type="text" value="<?php echo @$fetchedData->title; ?>" name="title" data-valid="required" class="form-control"/>
								@if ($errors->has('title'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('title') }}</strong>
									</span> 
								@endif
							</div>
							
							<div class="form-group">
								<label>Description</label>
								<textarea id="editor1" name="description" placeholder="Description" class="summernote-simple"><?php echo @$fetchedData->description; ?></textarea>
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
							<a style="margin-right:5px;" href="{{route('admin.cuisine.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>  
							<button type="button" onClick="customValidate('add-assesment')" class="btn btn-success pull-right">Update</button>  
						</div> 
					</div> 
					
				</div> 
            </div>
			{{ Form::close() }}
		</div>
	</section> 
</div>

@endsection