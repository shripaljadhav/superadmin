@extends('layouts.admin')
@section('title', 'User Role')

@section('content')

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
							<h4>User Role</h4>
							<div class="mr_left_auto">
								<a class="btn btn-primary" href="{{route('admin.userrole.create')}}">Add New</a>
							</div>
						</div>
						<div class="card-body p-0">
							<div class="table-responsive">
								<table class="table table-striped table-md">
									<thead>
										<tr>
										  <th>User Role Type</th>
										  <th>Status</th>
										  <th>Action</th>
										</tr>
									</thead>
									@if(@$totalData !== 0)
										<?php /* $module_access = json_decode(@$list->module_access);
										$modu = implode(', ', $module_access); */
									?>
									<tbody class="tdata">
										@foreach (@$lists as $list)
										<tr id="id_{{@$list->id}}">
										 <td>{{ @$list->usertypedata->name == "" ? config('constants.empty') : str_limit(@$list->usertypedata->name, '50', '...') }}</td>
										  <td>
											<div class="badge badge-success">Active</div>
										  </td>
										  <td><a href="{{URL::to('/admin/userrole/edit/'.base64_encode(convert_uuencode(@$list->id)))}}" class="btn btn-primary"><i class="fa fa-edit"></i></a> <a href="javascript:void(0);" onClick="deleteAction({{@$list->id}}, 'user_roles')" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
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
						
					</div>
				</div>              
            </div>
		</div>
	</section> 
</div>

@endsection