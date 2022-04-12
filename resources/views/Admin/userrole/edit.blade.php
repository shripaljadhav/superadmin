@extends('layouts.admin')
@section('title', 'Create User Role')

@section('content')
<?php
$modules = json_decode(@$fetchedData->module_access);	
?>
<div class="main-content">
	<section class="section">
		<div class="section-body">
			{{ Form::open(array('url' => 'admin/userrole/edit', 'name'=>"add-company", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
            <div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="server-error"> 
						@include('../Elements/flash-message')
					</div>
				</div>
				<div class="col-9 col-md-9 col-lg-9">
					<div class="card">
						<div class="card-header"> 
							<h4>Add User Role</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group">
								<label>User Role Type</label>
								<select name="usertype" id="usertype" class="form-control" autocomplete="new-password" data-valid="required">
									<option value="">Choose One...</option>
									@if(count(@$usertype) !== 0)
										@foreach (@$usertype as $ut)
											<option value="{{ @$ut->id }}" @if($fetchedData->usertype == @$ut->id) selected @endif>{{ @$ut->name }}</option>
										@endforeach
									@endif		
								</select>
								@if ($errors->has('usertype'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('usertype') }}</strong>
									</span> 
								@endif
							</div> 
							<div class="form-group">
								<label>Add User Role</label>
								<ul>
									<li>
										<label for="" class="">User Management</label>
										
										<ul>
											<li>
												<label for="user_management_view" class=""><input @if(@in_array('user_management_view', $modules)) checked @endif class="" type="checkbox" name="module_access[]" id="user_management_view" value="user_management_view"> View</label>
											</li>
											<li>
												<label for="user_management_add" class=""><input @if(@in_array('user_management_add', $modules)) checked @endif class="" type="checkbox" name="module_access[]" id="user_management_add" value="user_management_add"> Add</label>
											</li>
											<li>
												<label for="user_management_edit" class=""><input @if(@in_array('user_management_edit', $modules)) checked @endif class="" type="checkbox" name="module_access[]" id="user_management_edit" value="user_management_edit"> Edit</label>
											</li>
											<li>
												<label for="user_management_delete" class=""><input @if(@in_array('user_management_delete', $modules)) checked @endif class="" type="checkbox" name="module_access[]" id="user_management_delete" value="user_management_delete"> Delete</label>
											</li>
										</ul>
									</li>
									
									<li>
										<label for="" class="">Company Management</label>
										
										<ul>
											<li>
												<label for="company_management_view" class=""><input @if(@in_array('company_management_view', $modules)) checked @endif class="" type="checkbox" name="module_access[]" id="company_management_view" value="company_management_view"> View</label>
											</li>
											<li>
												<label for="company_management_add" class=""><input @if(@in_array('company_management_add', $modules)) checked @endif class="" type="checkbox" name="module_access[]" id="company_management_add" value="company_management_add"> Add</label>
											</li>
											<li>
												<label for="company_management_edit" class=""><input @if(@in_array('company_management_edit', $modules)) checked @endif class="" type="checkbox" name="module_access[company_management_edit]" id="company_management_edit" value="company_management_edit"> Edit</label>
											</li>
											<li>
												<label for="company_management_delete" class=""><input @if(@in_array('company_management_delete', $modules)) checked @endif class="" type="checkbox" name="module_access[company_management_delete]" id="company_management_delete" value="company_management_delete"> Delete</label>
											</li>
										</ul>
									</li>
									
									<li>
										<label for="course_management_add" class=""> Course Management</label>
										
										<ul>
											<li>
												<label for="course_management_view" class=""><input @if(@in_array('course_management_view', $modules)) checked @endif class="" type="checkbox" name="module_access[]" id="course_management_view" value="course_management_view"> View</label>
											</li>
											<li>
												<label for="course_management_add" class=""><input @if(@in_array('course_management_add', $modules)) checked @endif class="" type="checkbox" name="module_access[]" id="course_management_add" value="course_management_add"> Add</label>
											</li>
											<li>
												<label for="course_management_edit" class=""><input @if(@in_array('course_management_edit', $modules)) checked @endif class="" type="checkbox" name="module_access[]" id="course_management_edit" value="course_management_edit"> Edit</label>
											</li>
											<li>
												<label for="course_management_delete" class=""><input @if(@in_array('course_management_delete', $modules)) checked @endif class="" type="checkbox" name="module_access[]" id="course_management_delete" value="course_management_delete"> Delete</label>
											</li>
										</ul>
									</li>
									
									<li>
										<label for="" class="">Learning Steps Management</label>
										
										<ul>
											<li>
												<label for="learning_view" class=""><input class="" @if(@in_array('learning_view', $modules)) checked @endif type="checkbox" name="module_access[]" id="learning_view" value="learning_view"> View</label>
											</li>
											<li>
												<label for="learning_add" class=""><input class="" @if(@in_array('learning_add', $modules)) checked @endif type="checkbox" name="module_access[]" id="learning_add" value="learning_add"> Add</label>
											</li>
											<li>
												<label for="learning_edit" class=""><input class="" @if(@in_array('learning_edit', $modules)) checked @endif type="checkbox" name="module_access[]" id="learning_edit" value="learning_edit"> Edit</label>
											</li>
											<li>
												<label for="learning_delete" class=""><input class="" @if(@in_array('learning_delete', $modules)) checked @endif type="checkbox" name="module_access[]" id="learning_delete" value="learning_delete"> Delete</label>
											</li>
										</ul>
									</li>
									
									<li>
										<label for="" class=""> Lessons</label>
										
										<ul>
											<li>
												<label for="lesson_view" class=""><input class="" @if(@in_array('lesson_view', $modules)) checked @endif type="checkbox" name="module_access[]" id="lesson_view" value="lesson_view"> View</label>
											</li>
											<li>
												<label for="lesson_add" class=""><input class="" @if(@in_array('lesson_add', $modules)) checked @endif type="checkbox" name="module_access[]" id="lesson_add" value="lesson_add"> Add</label>
											</li>
											<li>
												<label for="lesson_edit" class=""><input class="" @if(@in_array('lesson_edit', $modules)) checked @endif type="checkbox" name="module_access[]" id="lesson_edit" value="lesson_edit"> Edit</label>
											</li>
											<li>
												<label for="lesson_delete" class=""><input class="" @if(@in_array('lesson_delete', $modules)) checked @endif type="checkbox" name="module_access[]" id="lesson_delete" value="lesson_delete"> Delete</label>
											</li>
										</ul>
									</li>
									
									<li>
										<label for="" class=""> Assesment</label>
										
										<ul>
											<li>
												<label for="assesment_view" class=""><input class="" @if(@in_array('assesment_view', $modules)) checked @endif type="checkbox" name="module_access[]" id="assesment_view" value="assesment_view"> View</label>
											</li>
											<li>
												<label for="assesment_add" class=""><input class="" @if(@in_array('assesment_add', $modules)) checked @endif type="checkbox" name="module_access[]" id="assesment_add" value="assesment_add"> Add</label>
											</li>
											<li>
												<label for="assesment_edit" class=""><input class="s" @if(@in_array('assesment_edit', $modules)) checked @endif type="checkbox" name="module_access[]" id="assesment_edit" value="assesment_edit"> Edit</label>
											</li>
											<li>
												<label for="assesment_delete" class="s"><input class="s" @if(@in_array('assesment_delete', $modules)) checked @endif type="checkbox" name="module_access[]" id="assesment_delete" value="assesment_delete"> Delete</label>
											</li>
										</ul>
									</li>
									
									<li>
										<label for="" class="">Questions</label>
										
										<ul>
											<li>
												<label for="question_view" class=""><input class="" @if(@in_array('question_view', $modules)) checked @endif type="checkbox" name="module_access[]" id="question_view" value="question_view"> View</label>
											</li>
											<li>
												<label for="question_add" class=""><input class="" @if(@in_array('question_add', $modules)) checked @endif type="checkbox" name="module_access[]" id="question_add" value="question_add"> Add</label>
											</li>
											<li>
												<label for="question_edit" class=""><input class="" @if(@in_array('question_edit', $modules)) checked @endif type="checkbox" name="module_access[]" id="question_edit" value="question_edit"> Edit</label>
											</li>
											<li>
												<label for="question_delete" class=""><input class="" @if(@in_array('question_delete', $modules)) checked @endif type="checkbox" name="module_access[]" id="question_delete" value="question_delete"> Delete</label>
											</li>
										</ul>
									</li>
								</ul>
								
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
							<button type="button" onClick="customValidate('add-company')" class="btn btn-success pull-right">Submit</button>
						</div>
					</div>
				</div> 
            </div>
			{{ Form::close() }}
		</div>
	</section> 
</div>

@endsection