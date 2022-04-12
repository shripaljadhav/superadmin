@extends('layouts.admin')
@section('title', 'Add Category')

@section('content')

<div class="main-content">
	<section class="section">
		<div class="section-body">
			{{ Form::open(array('url' => 'categories/store', 'name'=>"add-learning", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
            <div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="server-error"> 
						@include('../Elements/flash-message')
					</div>
				</div>
				<div class="col-9 col-md-9 col-lg-9">
					<div class="card">
						<div class="card-header"> 
							<h4>Add Category</h4>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="restaurant">Restaurant</label>
								<input type="text" id="ser_res" class="form-control" placeholder="Search Restaurant Name.."/>
								<input type="hidden" id="reid" name="restaurant" data-valid="required" class="form-control"/>
								@if ($errors->has('restaurant'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('restaurant') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label for="title">Title</label>
								<input type="text" name="title" data-valid="required" class="form-control"/>
								@if ($errors->has('title'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('title') }}</strong>
									</span> 
								@endif
							</div>
							
							<div class="form-group">
								<label>Description</label>
								<textarea id="editor1" name="description" placeholder="Description" class="summernote-simple"></textarea>
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
									<option value="1">Publish</option>
									<option value="0">Draft</option>
								</select>
							</div>
						</div> 
						<div class="card-footer"> 
							<a style="margin-right:5px;" href="{{route('admin.categories.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
							<button type="button" onClick="customValidate('add-learning')" class="btn btn-success pull-right">Save</button>
						</div>
					</div>
					<div class="card">
						<div class="card-header"> 
							<h4>Image</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group" style="margin-bottom:0px;">
								<input type="file" name="image" class="form-control" data-valid="" />							
								@if ($errors->has('image'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('image') }}</strong>
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
@section('scripts')
<script>
$(function() {
    $("#ser_res").autocomplete({
        source: "{{URL::to('/search')}}",
        select: function( event, ui ) {
            event.preventDefault();
            $("#ser_res").val(ui.item.value);
            $("#reid").val(ui.item.id);
        }
    });
});
</script>
@endsection