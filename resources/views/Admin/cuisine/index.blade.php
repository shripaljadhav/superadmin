@extends('layouts.admin')
@section('title', 'Cuisines')

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
							<h4>Cuisines</h4>
							<div class="mr_left_auto">
							
								<a class="btn btn-primary" href="{{route('admin.cuisine.create')}}">Add New</a>
							
							</div>
						</div>
						<div class="card-body p-0"> 
							<div class="table-responsive">
								<table class="table table-striped table-md">
									<thead>
										<tr>
										  <th>Name</th>
										  <th>Status</th>
										  <th>Action</th>
										</tr> 
									</thead>   
									@if(@$totalData !== 0)
									<tbody class="tdata">
										@foreach (@$lists as $list)
										<tr id="id_{{@$list->id}}"> 
										  <td>{{$list->title}}</td>
										  <td> 
											@if(@$list->status == 1)
											<div class="badge badge-success">Active</div>
											@else
											<div class="badge badge-danger">InActive</div>
											@endif
										  </td>
										  <td><a href="{{URL::to('/cuisine/edit/'.base64_encode(convert_uuencode(@$list->id)))}}" class="btn btn-primary"><i class="fa fa-edit"></i></a><a href="javascript:void(0);" onClick="deleteAction({{@$list->id}}, 'cuisines')" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
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