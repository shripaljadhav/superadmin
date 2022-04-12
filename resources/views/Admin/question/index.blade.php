@extends('layouts.admin')
@section('title', 'Question')

@section('content')
<?php 
	$userrole = \App\UserRole::where('usertype', Auth::user()->role)->first();		
	$modules = json_decode(@$userrole->module_access);			
			?>
<div class="main-content">
	<section class="section">
		<div class="section-body">
            <div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="server-error"> 
						@include('../Elements/flash-message')
						<span class="custom-error-msg"></span> 
					</div>
				</div>
				<div class="col-12 col-md-12 col-lg-12">
					<div class="card">
						<div class="card-header"> 
							<h4>Question</h4>
							<div class="mr_left_auto">
							@if(Auth::user()->role == 1 || @in_array('question_add', $modules))
								<a class="btn btn-primary" href="{{route('admin.question.create')}}">Add New</a>
							@endif
							</div>
						</div>
						<div class="card-body p-0">
							<div class="table-responsive">
								<table class="table table-striped table-md">
									<thead>
										<tr>
										  <th>Question Name</th>
										  <th>Question Type</th>
										  <th>Status</th>
										  <th>Action</th>
										</tr>
									</thead>    
									@if(@$totalData !== 0)
									<tbody class="tdata">
										@foreach (@$lists as $list)
										<tr id="id_{{@$list->id}}"> 
										  <td>{{ @$list->title == "" ? config('constants.empty') : str_limit(@$list->title, '50', '...') }}</td>
										  <td>{{ @$list->question_type == "" ? config('constants.empty') : str_limit(@$list->question_type, '50', '...') }}</td>
										  <td> 
											@if(@$list->status == 1)
											<div class="badge badge-success">Active</div>
											@else
											<div class="badge badge-danger">InActive</div>
											@endif
										  </td>
										  <td>@if(Auth::user()->role == 1 || @in_array('question_edit', $modules))<a href="{{URL::to('/admin/question/edit/'.base64_encode(convert_uuencode(@$list->id)))}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>@endif @if(Auth::user()->role == 1 || @in_array('question_delete', $modules))<a href="javascript:void(0);" onClick="deleteAction({{@$list->id}}, 'questions')" class="btn btn-danger"><i class="fa fa-trash"></i></a>@endif</td>
										</tr>   
										@endforeach 
									</tbody>
									@else
									<tbody>
										<tr>
											<td colspan="6">
												{{config('constants.no_data')}}
											</td>
										</tr>
									</tbody>
									@endif
								</table>
							</div>
						</div>
						{{ $lists->links() }}
					</div>
				</div>              
            </div>
		</div>
	</section> 
</div>

@endsection