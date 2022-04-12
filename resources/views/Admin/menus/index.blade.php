@extends('layouts.admin')
@section('title', 'Menus')

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
							<h4>Menus</h4>
							<div class="mr_left_auto">
								<a class="btn btn-primary" href="{{route('admin.menus.create')}}">Add New</a>
							</div>
						</div> 
						<div class="card-body p-0">
							<div class="table-responsive">
								<table class="table table-striped table-md">
									<thead>
										<tr>
										 
										  <th>Name</th>
										 
										</tr>
									</thead>
									@if(@$totalData !== 0)
									<tbody class="tdata">
										@foreach (@$lists as $list)
										<?php
										
										if($list->menu_hours != ''){
											$menuhour = unserialize(@$list->menu_hours);
											$a = array();
							for($s = 0; $s < count($menuhour); $s++){
								for($l = 0; $l < count($menuhour[$s]['weekdays']); $l++){
									$a[] = $menuhour[$s]['weekdays'][$l];
								}
							}
							//echo '<pre>'; print_r($a);
							//$r = reset($a);
							//$x = end($a);
							//$dowMap = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat','Sun');
										}
										?>
										<tr>
											<td><a href="{{URL::to('/menus/edit/'.base64_encode(convert_uuencode(@$list->id)))}}">{{$list->menu_name}}</a></td>
											
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